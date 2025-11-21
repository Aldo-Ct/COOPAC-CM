<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProspectoCreditoController;
use App\Models\Anuncio;
use App\Http\Controllers\Admin\AnuncioController;
use App\Http\Controllers\Admin\NoticiaController as AdminNoticiaController;

// página principal pública
Route::get('/', function () {
    $anuncios = App\Models\Anuncio::vigentes()->orderBy('orden')->get()
      ->map(fn($a)=>[
          'img'  => $a->imagen_url,
          'alt'  => $a->titulo,
          'href' => $a->url
      ])
      ->all();

    $anuncios_modal = App\Models\Anuncio::vigentes()->orderBy('orden')->get();

    return view('welcome', compact('anuncios', 'anuncios_modal'));
})->name('home');

// Noticias page
Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias');
Route::get('/buscar', [NoticiaController::class, 'search'])->name('buscar');
// Quiénes somos: página única con secciones + compatibilidad de rutas antiguas
Route::view('/quienes', 'Nosotros')->name('quienes');
Route::get('/quienes/historia', fn () => redirect('/quienes#historia'))->name('quienes.historia');
Route::get('/quienes/mision-vision', fn () => redirect('/quienes#mision-vision'))->name('quienes.mision');
Route::get('/quienes/valores', fn () => redirect('/quienes#valores'))->name('quienes.valores');

// simulador público
Route::get('/simulador', [ProspectoCreditoController::class, 'showForm'])
    ->name('simulador');

Route::post('/simulador', [ProspectoCreditoController::class, 'store'])
    ->name('simulador.store');

// pantalla bonita de acceso denegado
Route::view('/acceso-denegado', 'acceso-denegado')
    ->name('acceso.denegado');

// Acceso privado inteligente (envía según rol)
Route::get('/panel', function() {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    $u = auth()->user();
    if ($u->hasRole('admin') || $u->hasRole('asesor')) {
        return redirect()->route('dashboard');
    }
    if ($u->hasRole('imagen')) {
        return redirect()->route('admin.anuncios.index');
    }
    if ($u->hasRole('rrhh')) {
        return redirect()->route('rrhh.asesores.index');
    }
    return redirect()->route('acceso.denegado');
})->name('panel');

// dashboard (asesor o admin)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'role_or_permission:asesor|admin|simulaciones.ver'])
    ->name('dashboard');


// Módulo: Contenidos (Noticias/Anuncios) – con roles o permisos
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::middleware('role_or_permission:imagen|admin|anuncios.gestionar')->group(function () {
        Route::post('anuncios/{anuncio}/toggle', [App\Http\Controllers\Admin\AnuncioController::class, 'toggle'])->name('anuncios.toggle');
        Route::resource('anuncios', App\Http\Controllers\Admin\AnuncioController::class)->except(['show']);
    });

    Route::middleware('role_or_permission:imagen|admin|noticias.gestionar')->group(function () {
        Route::patch('noticias/{noticia}/toggle', [AdminNoticiaController::class, 'toggle'])->name('noticias.toggle');
        Route::resource('noticias', AdminNoticiaController::class)->except(['show']);
    });
});

// Módulo: Simulaciones – Asesor o Admin
Route::get('simulaciones', App\Livewire\Modules\Simulaciones::class)
    ->middleware(['auth', 'role_or_permission:asesor|admin|simulaciones.ver'])
    ->name('simulaciones');

// Exportar simulaciones filtradas a CSV
use App\Http\Controllers\SimulacionExportController;
Route::get('simulaciones/export', [SimulacionExportController::class, 'export'])
    ->middleware(['auth','role_or_permission:asesor|admin|simulaciones.ver'])
    ->name('simulaciones.export');

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

// Servicios (página unificada + compatibilidad)
Route::redirect('/servicios', '/servicios/ahorro')->name('servicios');
Route::view('/servicios/ahorro', 'servicios.ahorro')->name('servicios.ahorro');
Route::get('/servicios/creditos', fn () => redirect('/servicios/ahorro#creditos'))->name('servicios.creditos');
Route::get('/servicios/complementarios', fn () => redirect('/servicios/ahorro#servicios-complementarios'))->name('servicios.complementarios');
Route::get('/servicios/beneficios', fn () => redirect('/servicios/ahorro#beneficios-socio'))->name('servicios.beneficios');
Route::view('/agencias', 'agencias')->name('agencias');
Route::view('/transparencia', 'transparencia')->name('transparencia');

// RR.HH. · Gestión de Asesores (solo rrhh o admin)
use App\Http\Controllers\Rrhh\AsesorController as RrhhAsesorController;
Route::middleware(['auth','role_or_permission:rrhh|admin|rrhh.gestionar'])
    ->name('rrhh.')
    ->prefix('rrhh')
    ->group(function(){
        Route::resource('asesores', RrhhAsesorController::class)->except(['show']);
    });



// Admin · Gestión de Usuarios/Roles
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('usuarios', \App\Http\Controllers\Admin\UserRoleController::class)->only(['index','edit','update']);
});




