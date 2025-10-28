<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ResetAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * --email defaults to admin@coopac.pe
     * --password defaults to 12345678
     */
    protected $signature = 'coopac:reset-admin {--email=admin@coopac.pe} {--password=12345678}';

    /**
     * The console command description.
     */
    protected $description = 'Create or reset the admin account (email and password).';

    public function handle(): int
    {
        $email = $this->option('email');
        $password = $this->option('password');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $user = User::create([
                'name' => 'Administrador',
                'email' => $email,
                'password' => $password, // model cast will hash
            ]);

            $this->info("Usuario admin creado: {$email}");
        } else {
            $user->password = $password; // use model setter so cast 'hashed' applies
            $user->save();

            $this->info("Contraseña del admin actualizada: {$email}");
        }

        $this->info('Hecho. El admin puede iniciar sesión con la contraseña proporcionada.');

        return Command::SUCCESS;
    }
}
