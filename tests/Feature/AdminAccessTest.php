<?php

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('permet à un admin de voir le dashboard', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'is_admin' => true,
        'password' => Hash::make('password'),
    ]);

    Car::factory()->create();

    $this->post('/login', [
        'email' => $admin->email,
        'password' => 'password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->get('/admin')->assertOk()->assertSee('Dashboard');
});

it('refuse l’accès admin à un utilisateur classique', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->get('/admin')->assertForbidden();
});

it('redirige un invité vers la page de connexion', function () {
    $this->get('/admin')->assertRedirect(route('login'));
});


