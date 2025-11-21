<?php

namespace App\Http\Controllers;

use App\Models\ProspectoCredito;
use Illuminate\Http\Request;

class ProspectoCreditoController extends Controller
{
    // GET /simulador
    // Muestra la vista con el simulador y el formulario
    public function showForm()
    {
        return view('simulador');
    }

    // POST /simulador
    // Guarda el prospecto en la base de datos
    public function store(Request $request)
    {
        // 1. Validar datos del formulario
        $data = $request->validate([
            'nombre_completo'   => ['required','string','max:150'],
            'dni'               => ['required','digits:8'],
            'celular'           => ['required','digits:9'],
            'monto_solicitado'  => ['required','numeric','min:1'],
            // Evita plazos absurdos que rompen la fórmula (NaN/overflow)
            'plazo_meses'       => ['required','integer','min:1','max:120'],
            'agencia'           => ['required','string','max:100'],
            'tipo_credito'      => ['nullable','string','max:100'],
            'cuota_estimada'    => ['nullable','numeric'], // viene del hidden
        ]);

        // Si te mandaron la cuota desde el JS la usamos; igual la recalculamos por seguridad:
        $tea  = 0.4092;
        $tem  = pow(1 + $tea, 1/12) - 1;
        $monto= (float)$data['monto_solicitado'];
        $plazo= (int)$data['plazo_meses'];

        // Si por alguna razón llega un plazo demasiado grande, lo acotamos a evitar NaN/Infinity
        if ($plazo < 1) { $plazo = 1; }
        if ($plazo > 120) { $plazo = 120; }

        $factor = pow(1+$tem, $plazo);
        $denom  = $factor - 1;
        $cuotaSrv = $denom > 0
            ? $monto * ( $tem * $factor ) / $denom
            : 0;
        $cuotaSrv = round($cuotaSrv, 2);

        // --- Generador de Amortización ---
        $schedule = [];
        $saldo = round($monto, 2);
        $totalIntereses = 0.00;
        $totalAmortizacion = 0.00;

        for ($i = 1; $i <= $plazo; $i++) {
            $interes = round($saldo * $tem, 2);
            $amort   = round($cuotaSrv - $interes, 2);

            // Ajuste en la última cuota para evitar saldos residuales por redondeo
            if ($i === (int)$plazo) {
                $amort = $saldo;
                $cuotaFinal = round($interes + $amort, 2);
            } else {
                $cuotaFinal = $cuotaSrv;
            }

            $saldo = round($saldo - $amort, 2);

            $schedule[] = [
                'n'            => $i,
                'cuota'        => $cuotaFinal,
                'interes'      => $interes,
                'amortizacion' => $amort,
                'saldo'        => max($saldo, 0),
            ];

            $totalIntereses    += $interes;
            $totalAmortizacion += $amort;
        }

        $resumen = ['cuota' => $cuotaSrv, 'total_intereses' => round($totalIntereses, 2), 'total_amortizacion' => round($totalAmortizacion, 2), 'total_pagado' => round($totalIntereses + $totalAmortizacion, 2), 'plazo' => $plazo];
        // --- Fin del Generador ---

        // 2. Guardar en la base de datos
        ProspectoCredito::create([
            'nombre_completo'   => $data['nombre_completo'],
            'dni'               => $data['dni'],
            'celular'           => $data['celular'],
            'monto_solicitado'  => $monto,
            'plazo_meses'       => $plazo,
            'agencia'           => $data['agencia'],
            'cuota_estimada'    => $cuotaSrv,
            'tipo_credito'      => $data['tipo_credito'],
            'estado'            => 'nuevo', // estado inicial
        ]);

        // 3. Responder al usuario
        return redirect()
            ->back()
            ->with('success', 'Tu cuota estimada es S/ '.number_format($cuotaSrv,2) . '. Un asesor te contactará pronto.')
            ->with('tabla_pagos', $schedule)
            ->with('resumen_pagos', $resumen);
    }
}
