<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_id',
        'spot_id',
        'subscription_id',
        'start_time',
        'end_time',
        'status',
        'unit',
        'unit_value',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
