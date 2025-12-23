<?php

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('la page affiche au moins une voiture', function () {
    Car::factory()->create([
        'brand' => 'Audi',
        'model' => 'Q5',
    ]);

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Audi');
});
