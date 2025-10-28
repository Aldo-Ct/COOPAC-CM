<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\ProspectoCreditoController;

// página principal pública
Route::get('/', function () {
    return view('welcome');
})->name('home');

// simulador público
Route::get('/simulador', [ProspectoCreditoController::class, 'showForm'])
    ->name('simulador');

Route::post('/simulador', [ProspectoCreditoController::class, 'store'])
    ->name('simulador.store');

// pantalla bonita de acceso denegado
Route::view('/acceso-denegado', 'acceso-denegado')
    ->name('acceso.denegado');

// dashboard (solo admin)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', \App\Http\Middleware\IsAdmin::class])
    ->name('dashboard');

// Módulo: Simulaciones (scaffold)
Route::get('simulaciones', \App\Livewire\Modules\Simulaciones::class)
    ->middleware(['auth', 'verified'])
    ->name('simulaciones');

// Exportar simulaciones filtradas a CSV
use Illuminate\Http\Request;
use App\Models\Simulacion;

Route::get('simulaciones/export', function (Request $request) {
    $query = Simulacion::query()->latest();

    // Si se pasó un parámetro 'ids' (exportar seleccionados), filtrar por ellos
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

    $filename = 'simulaciones_' . now()->format('Ymd_His') . '.csv';

    // Encabezados legibles para export
    $columns = ['ID','Nombre','DNI','Celular','Monto (S/)','Plazo (meses)','Tipo de crédito','Agencia','Estado','Creado'];

    // Elegir formato: 'xls' (HTML que Excel abre) o 'pdf'. Por defecto 'xls'.
    $format = strtolower($request->query('format', 'xls'));

    // Helper: generar HTML de tabla (devuelve string)
    $generateTableHtml = function () use ($query, $columns) {
        $sanitize = function ($value) {
            if (is_null($value)) return '';
            $v = (string) $value;
            $v = strip_tags($v);
            $v = preg_replace("/\r\n|\r|\n/", ' ', $v);
            $v = trim(preg_replace('/\s+/', ' ', $v));
            return $v;
        };

        $html = '';
        $html .= '<table border="1" style="border-collapse:collapse;width:100%;">';
        $html .= '<thead><tr>';
        foreach ($columns as $col) {
            $html .= '<th style="font-weight:bold;padding:6px 8px;background:#fff9c2;">' . htmlspecialchars($col) . '</th>';
        }
        $html .= '</tr></thead><tbody>';

        $query->chunk(200, function ($items) use (&$html, $sanitize) {
            foreach ($items as $item) {
                $monto = '';
                if (isset($item->monto_solicitado) && is_numeric($item->monto_solicitado)) {
                    $monto = number_format($item->monto_solicitado, 2, ',', '.');
                }

                $plazo = $sanitize($item->plazo_meses);
                $tipo = $sanitize($item->tipo_credito);
                if ($tipo !== '') $tipo = ucfirst(str_replace('_', ' ', $tipo));
                $estado = $sanitize($item->estado);
                if ($estado !== '') $estado = ucfirst(str_replace('_', ' ', $estado));

                $created = '';
                if ($item->created_at) {
                    try {
                        $created = $item->created_at->format('d/m/Y H:i');
                    } catch (\Throwable $e) {
                        $created = $sanitize($item->created_at);
                    }
                }

                $html .= '<tr>';
                $html .= '<td style="padding:6px 8px;">' . $sanitize($item->id) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($sanitize($item->nombre)) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $sanitize($item->dni) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $sanitize($item->celular) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $monto . '</td>';
                $html .= '<td style="padding:6px 8px;">' . $plazo . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($tipo) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($sanitize($item->agencia)) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($estado) . '</td>';
                $html .= '<td style="padding:6px 8px;">' . htmlspecialchars($created) . '</td>';
                $html .= '</tr>';
            }
        });

        $html .= '</tbody></table>';
        return $html;
    };

    // Exportar como XLS (HTML que Excel abre)
    if (in_array($format, ['xls', 'excel'])) {
        $filenameX = 'simulaciones_' . now()->format('Ymd_His') . '.xls';
        $callback = function () use ($generateTableHtml) {
            // BOM
            echo "\xEF\xBB\xBF";
            echo $generateTableHtml();
        };

        return response()->streamDownload($callback, $filenameX, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }

    // Exportar como PDF: requiere dompdf o barryvdh/laravel-dompdf instalado
    if ($format === 'pdf') {
        $filenamePdf = 'simulaciones_' . now()->format('Ymd_His') . '.pdf';
        $html = "\xEF\xBB\xBF" . $generateTableHtml();

        // Si está disponible la facade PDF (barryvdh)
        if (class_exists('\\Barryvdh\\DomPDF\\Facade\\Pdf') || class_exists('PDF')) {
            try {
                if (class_exists('PDF')) {
                    return PDF::loadHtml($html)->download($filenamePdf);
                }
                return \Barryvdh\DomPDF\Facade\Pdf::loadHtml($html)->download($filenamePdf);
            } catch (\Throwable $e) {
                return response('Error generando PDF: ' . $e->getMessage(), 500);
            }
        }

        // Si está dompdf instalado (sin facade)
        if (class_exists('Dompdf\\Dompdf')) {
            try {
                $dompdf = new \Dompdf\Dompdf();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'landscape');
                $dompdf->render();
                $dompdf->stream($filenamePdf);
                return response('', 200);
            } catch (\Throwable $e) {
                return response('Error generando PDF: ' . $e->getMessage(), 500);
            }
        }

        return response('Para exportar a PDF instala barryvdh/laravel-dompdf o dompdf/dompdf (composer require barryvdh/laravel-dompdf)', 500);
    }

    $callback = function () use ($query, $columns) {
        // Escribir BOM UTF-8 para compatibilidad con Excel en Windows
        echo "\xEF\xBB\xBF";

        $handle = fopen('php://output', 'w');

        // Sanitizador simple: eliminar saltos de línea y etiquetas HTML
        $sanitize = function ($value) {
            if (is_null($value)) return '';
            $v = (string) $value;
            // remover etiquetas HTML
            $v = strip_tags($v);
            // reemplazar saltos de línea por espacio
            $v = preg_replace("/\r\n|\r|\n/", ' ', $v);
            // normalizar espacios
            $v = trim(preg_replace('/\s+/', ' ', $v));
            return $v;
        };

        // Usar punto y coma (;) como separador para mejor compatibilidad en locales que usan coma decimal
        $delimiter = ';';

        // Escribir cabecera
        fputcsv($handle, $columns, $delimiter);

        $query->chunk(200, function ($items) use ($handle, $sanitize, $delimiter) {
            foreach ($items as $item) {
                // Formateos legibles
                $monto = '';
                if (isset($item->monto_solicitado) && is_numeric($item->monto_solicitado)) {
                    // Usar formato local: separador de miles '.' y decimal ','
                    $monto = number_format($item->monto_solicitado, 2, ',', '.');
                }

                $plazo = $sanitize($item->plazo_meses);
                if ($plazo !== '') $plazo = $plazo;

                $tipo = $sanitize($item->tipo_credito);
                if ($tipo !== '') $tipo = ucfirst(str_replace('_', ' ', $tipo));

                $estado = $sanitize($item->estado);
                if ($estado !== '') $estado = ucfirst(str_replace('_', ' ', $estado));

                $created = '';
                if ($item->created_at) {
                    try {
                        $created = $item->created_at->format('d/m/Y H:i');
                    } catch (\Throwable $e) {
                        $created = $sanitize($item->created_at);
                    }
                }

                fputcsv($handle, [
                    $sanitize($item->id),
                    $sanitize($item->nombre),
                    $sanitize($item->dni),
                    $sanitize($item->celular),
                    $monto,
                    $plazo,
                    $tipo,
                    $sanitize($item->agencia),
                    $estado,
                    $created,
                ], $delimiter);
            }
        });

        fclose($handle);
    };

    return response()->streamDownload($callback, $filename, [
        'Content-Type' => 'text/csv',
        'Cache-Control' => 'no-cache, must-revalidate',
    ]);
})->middleware(['auth','verified'])->name('simulaciones.export');


// ajustes de usuario autenticado (igual solo los vería el admin real ahora)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// rutas de login/logout de breeze-livewire
require __DIR__.'/auth.php';
