<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'vehicle_id',
        'name',
        'email',
        'phone',
        'booking_date',
        'start_time',
        'duration_hours',
        'price_per_hour',
        'service_fee',
        'total_price',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'price_per_hour' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}