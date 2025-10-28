<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Password extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        // Por motivos de seguridad operativa, la contraseña solo puede
        // modificarse desde el código (seeders / comandos artisan).
        // Evitamos que la interfaz web actualice la contraseña.
        abort(403, 'El cambio de contraseña solo puede realizarse desde código.');
    }
}
