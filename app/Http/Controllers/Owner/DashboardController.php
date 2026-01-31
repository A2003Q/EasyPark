<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\Reservation;
use App\Models\AdminRevenue;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();

        // Owner parkings
        $parkingsQuery = Parking::where('owner_id', $ownerId);

        $parkingsCount = $parkingsQuery->count();

        // Active reservations for owner parkings
        $activeReservations = Reservation::where('status', 'active')
            ->whereHas('parking', fn($q) => $q->where('owner_id', $ownerId))
            ->count();

        // Reservations status counts (for chart)
        $reservationStatusCounts = Reservation::whereHas('parking', fn($q) => $q->where('owner_id', $ownerId))
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Parking availability (available vs reserved) across owner spots
        // (We derive from parkings table available_spots & total_spots)
        $totalSpots = (int) $parkingsQuery->sum('total_spots');
        $availableSpots = (int) $parkingsQuery->sum('available_spots');
        $occupiedSpots = max(0, $totalSpots - $availableSpots);

        $parkingAvailability = [
            'Available' => $availableSpots,
            'Occupied'  => $occupiedSpots,
        ];

        // Owner revenue totals (optional, but safe)
        $totalRevenue = AdminRevenue::where('source', 'parking_fee')
            ->whereHas('reservation.parking', fn($q) => $q->where('owner_id', $ownerId))
            ->sum('amount');

        // monthly revenue cards/charts are admin-only in blade, but we define them anyway
        $monthlyRevenue = AdminRevenue::where('source', 'parking_fee')
            ->whereHas('reservation.parking', fn($q) => $q->where('owner_id', $ownerId))
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        // monthly revenue by month (chart) - safe default for owner (and blade only shows for admin anyway)
        $monthlyRevenueByMonth = [];

        // Admin-only variables (set safe defaults)
        $usersCount = 0;
        $activeSubscriptions = 0;

        return view('admin.dashboard', compact(
            'usersCount',
            'activeSubscriptions',
            'parkingsCount',
            'activeReservations',
            'monthlyRevenue',
            'totalRevenue',
            'reservationStatusCounts',
            'parkingAvailability',
            'monthlyRevenueByMonth'
        ));
    }
}
