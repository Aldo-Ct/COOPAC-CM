<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdditionalRoleUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure roles exist
        foreach (['imagen','rrhh'] as $r) {
            try { Role::findOrCreate($r); } catch (\Throwable $e) {}
        }

        // Imagen
        $imagen = User::firstOrCreate(
            ['email' => 'imagen@coopac.pe'],
            ['name' => 'Imagen', 'password' => '12345678']
        );
        try { $imagen->forceFill(['email_verified_at' => now()])->save(); } catch (\Throwable $e) {}
        try { $imagen->assignRole('imagen'); } catch (\Throwable $e) {}

        // RRHH
        $rrhh = User::firstOrCreate(
            ['email' => 'rrhh@coopac.pe'],
            ['name' => 'Recursos Humanos', 'password' => '12345678']
        );
        try { $rrhh->forceFill(['email_verified_at' => now()])->save(); } catch (\Throwable $e) {}
        try { $rrhh->assignRole('rrhh'); } catch (\Throwable $e) {}
    }
}
