<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStatusRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::with('car')->orderByDesc('created_at')->paginate(12);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function update(ReservationStatusRequest $request, Reservation $reservation): RedirectResponse
    {
        $reservation->update($request->validated());

        return back()->with('status', 'Statut mis à jour.');
    }
}


