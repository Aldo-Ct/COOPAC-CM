<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class AsesorController extends Controller
{
    public function index(): View
    {
        // Listar usuarios con rol 'asesor' (Spatie)
        $asesores = User::role('asesor')
            ->orderBy('name')
            ->paginate(12);

        return view('rrhh.asesores.index', compact('asesores'));
    }

    public function create(): View
    {
        $asesor = new User();
        return view('rrhh.asesores.create', compact('asesor'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required','string','max:150'],
            'email' => ['required','email','max:150','unique:users,email'],
            'password' => ['required','string','min:8'],
            'agencia' => ['nullable','string','max:150'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'agencia' => $data['agencia'] ?? null,
        ]);
        // Verificar correo inmediatamente para permitir acceso (evita middleware 'verified')
        try { $user->forceFill(['email_verified_at' => now()])->save(); } catch (\Throwable $e) {}
        try { $user->assignRole('asesor'); } catch (\Throwable $e) {}

        return redirect()->route('rrhh.asesores.index')
            ->with('ok', 'Asesor creado y habilitado.');
    }

    public function edit(User $asesor): View
    {
        return view('rrhh.asesores.edit', compact('asesor'));
    }

    public function update(Request $request, User $asesor): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required','string','max:150'],
            'email' => ['required','email','max:150','unique:users,email,'.$asesor->id],
            'password' => ['nullable','string','min:8'],
            'agencia' => ['nullable','string','max:150'],
        ]);

        $asesor->name = $data['name'];
        $asesor->email = $data['email'];
        if (!empty($data['password'])) {
            $asesor->password = $data['password'];
        }
        $asesor->agencia = $data['agencia'] ?? null;
        $asesor->save();

        try { if (! $asesor->hasRole('asesor')) $asesor->assignRole('asesor'); } catch (\Throwable $e) {}

        return redirect()->route('rrhh.asesores.index')->with('ok', 'Asesor actualizado.');
    }

    public function destroy(User $asesor): RedirectResponse
    {
        try {
            $asesor->syncRoles([]);
            $asesor->delete();
        } catch (\Throwable $e) {
            return redirect()->route('rrhh.asesores.index')
                ->with('err', 'No se pudo eliminar al asesor.');
        }

        return redirect()->route('rrhh.asesores.index')->with('ok', 'Asesor eliminado.');
    }

    // eliminamos sincronización con .env; usamos roles en base de datos
}
