<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('admin user can visit the dashboard', function () {
    $admin = User::factory()->create([
        'email' => 'admin@coopac.pe',
    ]);

    $this->actingAs($admin);

    $this->get('/dashboard')->assertStatus(200);
});

test('non-admin users are redirected to acceso-denegado', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
    ]);

    $this->actingAs($user);

    $this->get('/dashboard')->assertRedirect(route('acceso.denegado'));
});
