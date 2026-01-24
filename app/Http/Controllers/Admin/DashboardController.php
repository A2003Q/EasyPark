<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Parking;
use App\Models\Subscription;
use App\Models\Reservation;
use App\Models\AdminRevenue;

class DashboardController extends Controller
{
    public function index()
    {
        // Cards Data
        $usersCount = User::count();
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        $parkingsCount = Parking::count();
        $activeReservations = Reservation::where('status', 'active')->count();
        $totalRevenue = AdminRevenue::sum('amount');
        $monthlyRevenue = AdminRevenue::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        // -------------------------------
        // Charts Data from DB
        // -------------------------------

        // 1️⃣ Monthly Revenue by Month (last 6 months)
       $monthlyRevenueByMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyRevenueByMonth[$month->format('M')] = AdminRevenue::whereMonth('created_at', $month->month)
               ->whereYear('created_at', $month->year)
                ->sum('amount');
          }

        // 2️⃣ Reservations Status Counts
        $reservationStatusCounts = [
            'Active' => Reservation::where('status', 'active')->count(),
            'Completed' => Reservation::where('status', 'completed')->count(),
            'Cancelled' => Reservation::where('status', 'cancelled')->count(),
        ];

        // 3️⃣ Parking Availability
       $parkingAvailability = [
    'Available' => Parking::where('is_active', 1)->count(),
    'Occupied'  => Parking::where('is_active', 0)->count(),
];

        // Return view with all data
        return view('admin.dashboard', compact(
            'usersCount',
            'activeSubscriptions',
            'parkingsCount',
            'activeReservations',
            'monthlyRevenue',
            'totalRevenue',
            'monthlyRevenueByMonth',
            'reservationStatusCounts',
            'parkingAvailability'
        ));
    }
}



