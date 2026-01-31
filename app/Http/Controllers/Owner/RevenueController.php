<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\AdminRevenue;

class RevenueController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();

        $revenues = AdminRevenue::with(['reservation.user'])
            ->whereHas('reservation.parking', fn($q) => $q->where('owner_id', $ownerId))
            ->latest()
            ->paginate(10);

        return view('admin.revenue.index', compact('revenues'));
    }
}
