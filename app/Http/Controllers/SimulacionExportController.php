<?php

namespace App\Http\Controllers;

use App\Models\Simulacion;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SimulacionExportController extends Controller
{
    /**
     * Handle the export of simulations.
     *
     * @param Request $request
     * @return StreamedResponse|\Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $query = $this->buildQuery($request);

        $format = strtolower($request->query('format', 'csv'));

        if (in_array($format, ['xls', 'excel'])) {
            return $this->exportXls($query);
        }

        return $this->exportCsv($query);
    }

    /**
     * Build the query for simulations based on request filters.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function buildQuery(Request $request)
    {
        $query = Simulacion::query()->latest();

        if ($request->filled('ids')) {
            $ids = array_filter(explode(',', $request->query('ids')));
            if (!empty($ids)) {
                $query->whereIn('id', $ids);
            }
        }

        if ($request->filled('agencia')) {
            $query->where('agencia', $request->query('agencia'));
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->query('estado'));
        }

        if ($request->filled('tipo_credito')) {
            $query->where('tipo_credito', $request->query('tipo_credito'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->query('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->query('date_to'));
        }

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('dni', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    /**
     * Export data as an XLS file (HTML table).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return StreamedResponse
     */
    private function exportXls($query)
    {
        $filename = 'simulaciones_' . now()->format('Ymd_His') . '.xls';

        $callback = function () use ($query) {
            echo "\xEF\xBB\xBF"; // BOM
            echo $this->generateTableHtml($query);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }

    /**
     * Export data as a CSV file.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return StreamedResponse
     */
    private function exportCsv($query)
    {
        $filename = 'simulaciones_' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($query) {
            echo "\xEF\xBB\xBF"; // BOM

            $handle = fopen('php://output', 'w');
            $delimiter = ';';

            fputcsv($handle, $this->getColumns(), $delimiter);

            $query->chunk(200, function ($items) use ($handle, $delimiter) {
                foreach ($items as $item) {
                    fputcsv($handle, $this->formatRowForCsv($item), $delimiter);
                }
            });

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }

    private function getColumns(): array
    {
        return ['ID','Nombre','DNI','Celular','Monto (S/)','Plazo (meses)','Tipo de crédito','Agencia','Estado','Creado'];
    }

    private function sanitize($value): string
    {
        if (is_null($value)) return '';
        $v = (string) $value;
        $v = strip_tags($v);
        $v = preg_replace("/\r\n|\r|\n/", ' ', $v);
        return trim(preg_replace('/\s+/', ' ', $v));
    }

    private function formatRowForCsv($item): array
    {
        $monto = (isset($item->monto_solicitado) && is_numeric($item->monto_solicitado))
            ? number_format($item->monto_solicitado, 2, ',', '.')
            : '';

        $tipo = $this->sanitize($item->tipo_credito);
        if ($tipo !== '') $tipo = ucfirst(str_replace('_', ' ', $tipo));

        $estado = $this->sanitize($item->estado);
        if ($estado !== '') $estado = ucfirst(str_replace('_', ' ', $estado));

        $created = $item->created_at ? $item->created_at->format('d/m/Y H:i') : '';

        return [
            $this->sanitize($item->id),
            $this->sanitize($item->nombre),
            $this->sanitize($item->dni),
            $this->sanitize($item->celular),
            $monto,
            $this->sanitize($item->plazo_meses),
            $tipo,
            $this->sanitize($item->agencia),
            $estado,
            $created,
        ];
    }

    private function generateTableHtml($query): string
    {
        $columns = $this->getColumns();

        $html = '';
        $html .= '<table border="1" style="border-collapse:collapse;width:100%;">';
        $html .= '<thead><tr>';
        foreach ($columns as $col) {
            $html .= '<th style="font-weight:bold;padding:6px 8px;background:#fff9c2;">' . htmlspecialchars($col) . '</th>';
        }
        $html .= '</tr></thead><tbody>';

        $query->chunk(200, function ($items) use (&$html) {
            foreach ($items as $item) {
                $monto = '';
                if (isset($item->monto_solicitado) && is_numeric($item->monto_solicitado)) {
                    $monto = number_format($item->monto_solicitado, 2, ',', '.');
                }

                $plazo = $this->sanitize($item->plazo_meses);

                $tipo = $this->sanitize($item->tipo_credito);
                if ($tipo !== '') $tipo = ucfirst(str_replace('_', ' ', $tipo));

                $estado = $this->sanitize($item->estado);
                if ($estado !== '') $estado = ucfirst(str_replace('_', ' ', $estado));

                $created = '';
                if ($item->created_at) {
                    try {
                        $created = $item->created_at->format('d/m/Y H:i');
                    } catch (\Throwable $e) {
                        $created = $this->sanitize((string)$item->created_at);
                    }
                }

                $html .= '<tr>';
                $html .= '<td style="padding:6px 8px;">' . $this->sanitize($item->id) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($this->sanitize($item->nombre), ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $this->sanitize($item->dni) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $this->sanitize($item->celular) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $monto . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $plazo . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($tipo) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($this->sanitize($item->agencia)) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($estado) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $created . '</td>';
                $html .= '</tr>';
            }
        });

        $html .= '</tbody></table>';
        return $html;
    }
}
