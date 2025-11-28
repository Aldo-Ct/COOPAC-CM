<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{
    // Lista usuarios con buscador para elegir a quién ajustar roles/permisos.
    public function index(Request $request): View
    {
        $q = trim((string) $request->input('q'));
        $users = User::query()
            ->when($q !== '', fn($qq)=>$qq->where(fn($x)=>$x
                ->where('name','like',"%$q%")
                ->orWhere('email','like',"%$q%")
            ))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();
        return view('admin.usuarios.index', compact('users','q'));
    }

    // Muestra el formulario con roles y permisos disponibles para el usuario.
    public function edit(User $usuario): View
    {
        $roles = Role::query()->orderBy('name')->pluck('name')->all();
        $perms = Permission::query()->orderBy('name')->pluck('name')->all();
        return view('admin.usuarios.edit', [
            'usuario' => $usuario,
            'roles' => $roles,
            'perms' => $perms,
        ]);
    }

    // Sincroniza roles y permisos enviados desde el formulario.
    public function update(Request $request, User $usuario): RedirectResponse
    {
        $data = $request->validate([
            'roles' => ['array'],
            'roles.*' => ['string'],
            'perms' => ['array'],
            'perms.*' => ['string'],
        ]);

        $roles = $data['roles'] ?? [];
        $perms = $data['perms'] ?? [];

        // Proteger al admin principal de perder rol admin
        if ($usuario->email === 'admin@coopac.pe' && !in_array('admin', $roles, true)) {
            $roles[] = 'admin';
        }

        try {
            $usuario->syncRoles($roles);
            $usuario->syncPermissions($perms);
        } catch (\Throwable $e) {
            return back()->with('err', 'No se pudo actualizar: '.$e->getMessage());
        }

        return redirect()->route('admin.usuarios.index')->with('ok', 'Roles y permisos actualizados');
    }
}
