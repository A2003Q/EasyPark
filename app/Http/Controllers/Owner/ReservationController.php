<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user','parking'])
            ->whereHas('parking', fn($q)=>$q->where('owner_id', auth()->id()))
            ->latest()
            ->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }
}
