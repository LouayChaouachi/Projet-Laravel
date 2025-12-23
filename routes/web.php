<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', CarController::class)->name('home');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('cars', AdminCarController::class)->except(['show']);
    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::patch('reservations/{reservation}', [AdminReservationController::class, 'update'])->name('reservations.update');
});
