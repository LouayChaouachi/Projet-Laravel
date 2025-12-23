<?php

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

it('met à jour le statut d une réservation', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
        'password' => Hash::make('password'),
    ]);

    $reservation = Reservation::factory()->create([
        'car_id' => Car::factory(),
        'status' => 'pending',
        'start_date' => Carbon::now()->addDay(),
        'end_date' => Carbon::now()->addDays(2),
        'total_price' => 100,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.reservations.update', $reservation), [
            'status' => 'confirmed',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('reservations', [
        'id' => $reservation->id,
        'status' => 'confirmed',
    ]);
});


