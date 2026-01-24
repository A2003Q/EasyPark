<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'parking'])->paginate(10); // eager load for efficiency

        return view('admin.reservations.index', compact('reservations'));
    }
}

