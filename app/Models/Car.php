<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
        'brand',
        'model',
        'year',
        'transmission',
        'fuel_type',
        'seats',
        'price_per_day',
        'image_url',
        'location',
        'available',
        'featured',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'available' => 'bool',
            'featured' => 'bool',
            'price_per_day' => 'decimal:2',
            'year' => 'int',
            'seats' => 'int',
        ];
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
