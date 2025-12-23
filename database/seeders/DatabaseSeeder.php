<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@carluxe.tn'],
            [
                'name' => 'Admin',
                'is_admin' => true,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );

        $cars = \App\Models\Car::factory(12)->create();

        \App\Models\Reservation::factory(6)->recycle($cars)->create([
            'email' => 'contact@carluxe.tn',
            'phone' => '+216 71 000 000',
        ]);

        User::factory(3)->create();
    }
}
