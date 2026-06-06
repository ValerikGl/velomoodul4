<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Vehicle;
use App\Http\Controllers\ContactController;

Route::get('/', fn() => Inertia::render('Home'))->name('home');

Route::get('/vehicles', [VehicleController::class, 'index'])
    ->name('vehicles.index');

Route::get('/vehicles/{vehicle:slug}', [VehicleController::class, 'show'])
    ->name('vehicles.show');

Route::get('/news', fn() => Inertia::render('News'))->name('news');
Route::get('/mission', fn() => Inertia::render('Mission'))->name('mission');

Route::get('/', function () {
    return Inertia::render('Home', [
        'vehicles' => Vehicle::query()
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get(),
    ]);
})->name('home');

Route::get('/booking/{vehicle:slug}', [VehicleController::class, 'booking'])
    ->name('booking.create');

Route::get('/contact', [ContactController::class, 'create'])
    ->name('contact.create');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
