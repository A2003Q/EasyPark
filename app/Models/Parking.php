<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'total_spots',
        'available_spots',
        'price_per_hour',
        'image_url',
        'is_active',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function spots()
    {
        return $this->hasMany(Spot::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
