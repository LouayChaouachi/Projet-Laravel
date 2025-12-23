<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('permet de créer et supprimer une voiture en admin', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($admin);

    $this->post(route('admin.cars.store'), [
        'slug' => 'audi-q3-test',
        'brand' => 'Audi',
        'model' => 'Q3',
        'year' => 2022,
        'transmission' => 'Automatique',
        'fuel_type' => 'Essence',
        'seats' => 5,
        'price_per_day' => 200,
        'image_url' => 'https://example.com/audi.jpg',
        'location' => 'Tunis',
        'available' => true,
        'featured' => false,
    ])->assertRedirect(route('admin.cars.index'));

    $this->assertDatabaseHas('cars', ['slug' => 'audi-q3-test']);

    $carId = \App\Models\Car::where('slug', 'audi-q3-test')->first()->id;

    $this->delete(route('admin.cars.destroy', $carId))
        ->assertRedirect(route('admin.cars.index'));

    $this->assertDatabaseMissing('cars', ['slug' => 'audi-q3-test']);
});


