<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'type',
        'battery',
        'range_km',
        'price_per_hour',
        'location',
        'speed_kmh',
        'is_active',
    ];

    protected $casts = [
        'price_per_hour' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class);
    }
}
