<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\VehicleController;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'vehicles' => Vehicle::query()
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get(),
    ]);
})->name('home');

Route::get('/vehicles', [VehicleController::class, 'index'])
    ->name('vehicles.index');

Route::get('/vehicles/{vehicle:slug}', [VehicleController::class, 'show'])
    ->name('vehicles.show');

Route::get('/booking/{vehicle:slug}', [VehicleController::class, 'booking'])
    ->name('booking.create');

Route::post('/booking/{vehicle:slug}', [VehicleController::class, 'storeBooking'])
    ->name('booking.store');

Route::get('/booking-success/{booking}', function (Booking $booking) {
    return Inertia::render('BookingSuccess', [
        'booking' => $booking->load('vehicle'),
    ]);
})->name('booking.success');

Route::get('/contact', [ContactController::class, 'create'])
    ->name('contact.create');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/news', fn () => Inertia::render('News'))->name('news');
Route::get('/mission', fn () => Inertia::render('Mission'))->name('mission');