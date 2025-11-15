<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Aliases de middleware (asegura que 'role' exista en Laravel 11/12)
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            // Alias alterno para la compatibilidad con el middleware propio
            'rolegate' => \App\Http\Middleware\RoleGate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Redirigir los errores de autorización de Spatie a la vista bonita
        $exceptions->render(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            return redirect()->route('acceso.denegado');
        });
    })->create();
