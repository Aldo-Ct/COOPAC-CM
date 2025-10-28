<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Define las credenciales del administrador
        $adminEmail = 'admin@coopac.pe';
        $adminPassword = '12345678'; // cámbiala si deseas

        // Verificamos si ya existe
        $user = User::where('email', $adminEmail)->first();

        if (!$user) {
            // Al crear, dejamos la contraseña en texto plano para que el cast
            // `password => 'hashed'` en el modelo User la hashee automáticamente.
            User::create([
                'name' => 'Administrador',
                'email' => $adminEmail,
                'password' => $adminPassword,
            ]);
        } else {
            // Si ya existe el usuario, actualizamos la contraseña usando el
            // setter del modelo para que también se aplique el cast y no
            // terminemos con un doble-hash.
            $user->password = $adminPassword;
            $user->save();
        }
    }
}
