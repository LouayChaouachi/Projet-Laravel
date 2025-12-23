<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function store(ReservationStoreRequest $request): RedirectResponse
    {
        $car = Car::findOrFail($request->integer('car_id'));

        $start = Carbon::parse($request->date('start_date'));
        $end = Carbon::parse($request->date('end_date'));
        $days = max($start->diffInDays($end) + 1, 1);

        Reservation::create([
            ...$request->validated(),
            'total_price' => $days * (float) $car->price_per_day,
        ]);

        return back()->with('status', 'Votre réservation a bien été enregistrée. Nous vous contacterons sous peu.');
    }
}

