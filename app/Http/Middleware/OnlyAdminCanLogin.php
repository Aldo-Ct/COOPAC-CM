<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyAdminCanLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Solo protegemos el intento de login (POST /login).
        // Si es GET /login dejamos que vea el formulario normal.
        if ($request->isMethod('POST')) {

            $emailIngresado = $request->input('email');

            // <- AQUI va el correo oficial del administrador
            $correoAdminOficial = 'admin@coopac.pe';

            // Si no es el correo autorizado -> mostramos la vista bloqueada
            if ($emailIngresado !== $correoAdminOficial) {
                // Importante: NO hacemos redirect, devolvemos directamente la respuesta
                return response()
                    ->view('acceso-denegado', [], 403); // 403 = Forbidden
            }
        }

        // Si sí es el correo admin, continúa el flujo normal de login
        return $next($request);
    }
}
