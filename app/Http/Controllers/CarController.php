<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    public function __invoke(Request $request): View
    {
        $search = trim((string) $request->input('q', ''));
        $transmission = trim((string) $request->input('transmission', ''));
        $fuel = trim((string) $request->input('fuel', ''));

        $cars = Car::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('brand', 'like', '%' . $search . '%')
                        ->orWhere('model', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%');
                });
            })
            ->when($transmission, fn ($query) => $query->where('transmission', $transmission))
            ->when($fuel, fn ($query) => $query->where('fuel_type', $fuel))
            ->when($request->integer('seats'), fn ($query, int $seats) => $query->where('seats', '>=', $seats))
            ->when($request->integer('max_price'), fn ($query, int $price) => $query->where('price_per_day', '<=', $price))
            ->orderByDesc('featured')
            ->orderBy('price_per_day')
            ->get();

        $featured = Car::where('featured', true)->take(3)->get();

        return view('welcome', [
            'cars' => $cars,
            'featuredCars' => $featured,
        ]);
    }
}

