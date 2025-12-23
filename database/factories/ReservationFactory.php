<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('+1 day', '+10 days');
        $end = fake()->dateTimeBetween($start->format('Y-m-d') . ' +1 day', '+20 days');

        return [
            'car_id' => \App\Models\Car::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'pickup_location' => fake()->randomElement(['Aéroport Tunis-Carthage', 'Centre-ville Tunis', 'Hammamet', 'Sousse']),
            'dropoff_location' => fake()->randomElement(['Aéroport Tunis-Carthage', 'Centre-ville Tunis', 'Hammamet', 'Sousse']),
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => fake()->numberBetween(300, 1800),
            'status' => fake()->randomElement(['pending', 'confirmed']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
