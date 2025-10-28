<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
    * @var array
    */
    protected $middleware = [
       // Global middlewares
       \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
    * The application's route middleware groups.
    *
    * @var array
    */
    protected $middlewareGroups = [
       'web' => [
          \Illuminate\Cookie\Middleware\EncryptCookies::class,
          \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
          \Illuminate\Session\Middleware\StartSession::class,
          \Illuminate\View\Middleware\ShareErrorsFromSession::class,
          \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
          \Illuminate\Routing\Middleware\SubstituteBindings::class,
       ],

       'api' => [
          'throttle:api',
          \Illuminate\Routing\Middleware\SubstituteBindings::class,
       ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
   protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

    // 👇 ESTA ES LA PARTE CLAVE
    'isAdmin' => \App\Http\Middleware\IsAdmin::class,
];

}
