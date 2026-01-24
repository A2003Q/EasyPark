<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AdminRevenue extends Model
{
    use HasFactory;

    protected $table = 'admin_revenues';

    protected $fillable = [
        'source',
        'amount',
        'parking_id',
        'reservation_id',
    ];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

