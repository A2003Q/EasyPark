<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRevenue;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index()
    {
        // إجمالي
        $total = AdminRevenue::sum('amount');

        // اشتراكات
        $subscriptions = AdminRevenue::where('source','subscription')->sum('amount');

        // مواقف
        $parkingFees = AdminRevenue::where('source','parking_fee')->sum('amount');

        // شهري (للشارت)
        $monthly = AdminRevenue::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

               $revenues = AdminRevenue::with(['reservation.user'])
            ->latest()
            ->paginate(10);
        return view('admin.revenue.index', compact('revenues'));
    }
}


