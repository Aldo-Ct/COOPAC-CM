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

        // Sólo permitimos al administrador con este email.
        if (! $user || $user->email !== 'admin@coopac.pe') {
            return redirect()->route('acceso.denegado');
        }

        return $next($request);
    }
}
