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
        $request->validate([
        'nombre_completo'   => 'required|string|max:255',
        'dni'               => 'required|string|max:15',
        'celular'           => 'required|string|max:20',
        'monto_solicitado'  => 'required|numeric',
        'plazo_meses'       => 'required|integer',
        'tipo_credito'      => 'required|string|max:100',
        'agencia'           => 'required|string|max:255',
        ]);

        // 2. Guardar en la base de datos
        ProspectoCredito::create([
        'nombre_completo'   => $request->nombre_completo,
        'dni'               => $request->dni,
        'celular'           => $request->celular,
        'monto_solicitado'  => $request->monto_solicitado,
        'plazo_meses'       => $request->plazo_meses,
        'tipo_credito'      => $request->tipo_credito,
        'agencia'           => $request->agencia,   // <--- NUEVO
        'estado'            => 'nuevo', // estado inicial
        ]);

        // 3. Responder al usuario
        return redirect()
            ->back()
            ->with('success', 'Tu solicitud ha sido registrada. Un asesor te contactará por WhatsApp.');
    }
}
