<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCarController extends Controller
{
    public function index(): View
    {
        $cars = Car::orderByDesc('created_at')->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    public function store(CarStoreRequest $request): RedirectResponse
    {
        Car::create($request->validated());

        return redirect()->route('admin.cars.index')->with('status', 'Voiture ajoutée.');
    }

    public function edit(Car $car): View
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(CarUpdateRequest $request, Car $car): RedirectResponse
    {
        $car->update($request->validated());

        return redirect()->route('admin.cars.index')->with('status', 'Voiture mise à jour.');
    }

    public function destroy(Car $car): RedirectResponse
    {
        $car->delete();

        return redirect()->route('admin.cars.index')->with('status', 'Voiture supprimée.');
    }
}


