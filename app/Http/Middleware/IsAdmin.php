<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $adminEmail = env('ADMIN_EMAIL', 'admin@coopac.pe');
        // Sólo permitimos al administrador con este email configurado
        if (! $user || $user->email !== $adminEmail) {
            return redirect()->route('acceso.denegado');
        }

        return $next($request);
    }
}
