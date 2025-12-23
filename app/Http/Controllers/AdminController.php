<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $cars = Car::orderByDesc('created_at')->take(8)->get();
        $reservations = Reservation::with('car')->orderByDesc('created_at')->take(10)->get();

        return view('admin.dashboard', [
            'cars' => $cars,
            'reservations' => $reservations,
        ]);
    }
}


