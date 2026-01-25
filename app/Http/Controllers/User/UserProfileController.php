<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $activeSub = $user->subscriptions()->where('status','active')->latest()->first();

        $reservations = $user->reservations()
            ->with(['spot.parking.city','parking.city'])
            ->latest()
            ->paginate(10);

        $now = Carbon::now();

        $subscription = $user->subscriptions()
        ->where('status','active')
        ->where('end_date','>=', now())
        ->latest()
        ->first();

        return view('user.profile.index', compact('user','activeSub','reservations','now','subscription'));
    }
}
