<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleGate
{
    /**
     * Roles admitidos por ruta. Si el usuario no cumple, redirige a acceso-denegado.
     * Roles soportados: admin, asesor, imagen, rrhh
     * Se evalúan por email usando variables de entorno para mantenerlo simple.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $email = strtolower((string) $user->email);

        // Mapear roles → listas de emails (env, separadas por coma)
        $map = [
            'admin'  => array_filter(array_map('trim', explode(',', (string) env('ADMIN_EMAIL', 'admin@coopac.pe')))),
            'asesor' => array_filter(array_map('trim', explode(',', (string) env('ASESOR_EMAILS', '')))),
            'imagen' => array_filter(array_map('trim', explode(',', (string) env('IMAGEN_EMAILS', '')))),
            'rrhh'   => array_filter(array_map('trim', explode(',', (string) env('RRHH_EMAILS', '')))),
        ];

        $authorized = false;
        foreach ($roles as $role) {
            $role = strtolower($role);
            if (! array_key_exists($role, $map)) continue;
            if (in_array($email, array_map('strtolower', $map[$role]), true)) {
                $authorized = true;
                break;
            }
        }

        if (! $authorized) {
            return redirect()->route('acceso.denegado');
        }

        return $next($request);
    }
}

