<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    protected $table = 'spots';

    protected $fillable = [
        'parking_id',
        'spot_number',
        'status',
    ];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
