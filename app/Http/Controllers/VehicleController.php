<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Inertia\Inertia;
use App\Models\Booking;
use Illuminate\Http\Request;

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

    public function storeBooking(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration_hours' => ['required', 'integer', 'min:1', 'max:8'],
        ]);

        $serviceFee = 1;
        $pricePerHour = $vehicle->price_per_hour;
        $totalPrice = ($pricePerHour * $validated['duration_hours']) + $serviceFee;

        $booking = Booking::create([
            'vehicle_id' => $vehicle->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'booking_date' => $validated['booking_date'],
            'start_time' => $validated['start_time'],
            'duration_hours' => $validated['duration_hours'],
            'price_per_hour' => $pricePerHour,
            'service_fee' => $serviceFee,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.success', $booking);
    }
}
