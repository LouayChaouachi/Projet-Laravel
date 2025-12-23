<?php

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('affiche la page d accueil avec la flotte', function () {
    Car::factory()->count(3)->create([
        'brand' => 'Tesla',
        'model' => 'Model S',
    ]);

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('CarLuxe');
    $response->assertSee('Tesla');
});



