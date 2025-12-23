<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cars = [
            [
                'brand' => 'Tesla',
                'model' => 'Model 3',
                'image' => 'https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=1200&q=80',
                'fuel_type' => 'Électrique',
                'transmission' => 'Automatique',
            ],
            [
                'brand' => 'BMW',
                'model' => 'Serie 3',
                'image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&w=1200&q=80',
                'fuel_type' => 'Essence',
                'transmission' => 'Automatique',
            ],
            [
                'brand' => 'Mercedes',
                'model' => 'GLC',
                'image' => 'https://images.unsplash.com/photo-1502877828070-33b167ad6860?auto=format&fit=crop&w=1200&q=80',
                'fuel_type' => 'Diesel',
                'transmission' => 'Automatique',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Golf 8',
                'image' => 'https://images.unsplash.com/photo-1471478331149-c72f17e33c73?auto=format&fit=crop&w=1200&q=80',
                'fuel_type' => 'Essence',
                'transmission' => 'Manuelle',
            ],
            [
                'brand' => 'Kia',
                'model' => 'Sportage',
                'image' => 'https://images.unsplash.com/photo-1489515217757-5fd1be406fef?auto=format&fit=crop&w=1200&q=80',
                'fuel_type' => 'Hybride',
                'transmission' => 'Automatique',
            ],
        ];

        $car = fake()->randomElement($cars);
        $slug = str($car['brand'] . '-' . $car['model'] . '-' . fake()->unique()->randomNumber(5))->slug();

        return [
            'slug' => $slug,
            'brand' => $car['brand'],
            'model' => $car['model'],
            'year' => fake()->numberBetween(2018, 2025),
            'transmission' => $car['transmission'],
            'fuel_type' => $car['fuel_type'],
            'seats' => fake()->randomElement([4, 5, 7]),
            'price_per_day' => fake()->numberBetween(120, 450),
            'image_url' => $car['image'],
            'location' => fake()->randomElement(['Tunis', 'Sousse', 'Hammamet', 'Sfax']) . ', Tunisie',
            'available' => true,
            'featured' => fake()->boolean(30),
            'description' => fake()->sentences(3, true),
        ];
    }
}
