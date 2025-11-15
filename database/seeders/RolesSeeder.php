<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin','asesor','imagen','rrhh'] as $name) {
            Role::findOrCreate($name);
        }

        $permissions = [
            'simulaciones.ver',
            'anuncios.gestionar',
            'noticias.gestionar',
            'rrhh.gestionar',
        ];

        foreach ($permissions as $perm) {
            Permission::findOrCreate($perm);
        }

        $assignments = [
            'asesor' => ['simulaciones.ver'],
            'imagen' => ['anuncios.gestionar', 'noticias.gestionar'],
            'rrhh'   => ['rrhh.gestionar'],
            'admin'  => $permissions,
        ];

        foreach ($assignments as $roleName => $perms) {
            if ($role = Role::where('name', $roleName)->first()) {
                $role->givePermissionTo($perms);
            }
        }
    }
}
