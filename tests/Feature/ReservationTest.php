<?php

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

it('crée une réservation valide', function () {
    $car = Car::factory()->create([
        'price_per_day' => 200,
    ]);

    $response = $this->post('/reservations', [
        'car_id' => $car->id,
        'first_name' => 'Amine',
        'last_name' => 'Ben Salah',
        'email' => 'amine@example.com',
        'phone' => '+216000000',
        'pickup_location' => 'Aéroport Tunis-Carthage',
        'dropoff_location' => 'Centre-ville',
        'start_date' => Carbon::now()->addDay()->toDateString(),
        'end_date' => Carbon::now()->addDays(3)->toDateString(),
        'notes' => 'Siège bébé',
    ]);

    $response->assertSessionHas('status');
    $this->assertDatabaseCount('reservations', 1);

    $reservation = Reservation::first();
    expect((float) $reservation->total_price)->toBe(600.0);
});

