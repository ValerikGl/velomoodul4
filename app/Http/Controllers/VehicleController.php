<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Inertia\Inertia;

class VehicleController extends Controller
{
    public function index()
    {
        return Inertia::render('Vehicles/Index', [
            'vehicles' => Vehicle::query()
                ->where('is_active', true)
                ->latest()
                ->get(),
        ]);
    }

    public function booking(Vehicle $vehicle)
    {
        return Inertia::render('BookingView', [
            'vehicle' => $vehicle,
        ]);
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('images');

        return Inertia::render('Vehicles/Show', [
            'vehicle' => $vehicle,
        ]);
    }
}
