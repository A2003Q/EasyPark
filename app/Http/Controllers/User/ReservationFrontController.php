<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\Reservation;
use App\Models\Spot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationFrontController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'parking_id' => 'required|exists:parkings,id',
            'spot_id' => 'required|exists:spots,id',
            'unit' => 'required|in:hours,days',
            'value' => 'required|integer|min:1|max:168',
        ]);

        $user = $request->user();

        $subscription = $user->subscriptions()
            ->where('status','active')
            ->where('end_date','>=', Carbon::now()->startOfDay())
            ->latest()
            ->first();

        // ✅ إذا ما عنده اشتراك: خزّن الحجز وبعدين وديه على الاشتراكات
        if (!$subscription) {
            $request->session()->put('pending_reservation', [
                'parking_id' => (int)$request->parking_id,
                'spot_id'    => (int)$request->spot_id,
                'unit'       => $request->unit,
                'value'      => (int)$request->value,
            ]);

            // نخزن وين كان عشان نرجعه على نفس صفحة السبوتس
           $request->session()->put('url.intended', route('user.parkings.show', $request->parking_id));


            return redirect()->route('user.subscriptions.index')
                ->with('error','Please choose a plan before reserving.');
        }

        $unit = $request->unit;
        $value = (int) $request->value;

        if ($unit === 'days' && $subscription->plan === 'basic') {
            return back()->with('error','Basic plan supports hourly reservations only.');
        }

        $remainingHours = max(0, (int)$subscription->hours_limit - (int)$subscription->hours_used);
        $remainingDays  = max(0, (int)$subscription->days_limit - (int)$subscription->days_used);

        if ($unit === 'hours' && $value > $remainingHours) {
            return back()->with('error', "Not enough hours left. Remaining: {$remainingHours}");
        }
        if ($unit === 'days' && $value > $remainingDays) {
            return back()->with('error', "Not enough days left. Remaining: {$remainingDays}");
        }

        $start = Carbon::now();
        $end   = $unit === 'hours' ? $start->copy()->addHours($value) : $start->copy()->addDays($value);

        return DB::transaction(function () use ($request, $user, $subscription, $start, $end, $unit, $value) {
            $spot = Spot::lockForUpdate()->findOrFail($request->spot_id);
            $parking = Parking::lockForUpdate()->findOrFail($request->parking_id);

            $conflict = Reservation::query()
                ->where('spot_id', $spot->id)
                ->where('status','active')
                ->where(function($q) use ($start,$end){
                    $q->whereBetween('start_time', [$start,$end])
                      ->orWhereBetween('end_time', [$start,$end])
                      ->orWhere(function($qq) use ($start,$end){
                          $qq->where('start_time','<=',$start)->where('end_time','>=',$end);
                      });
                })
                ->exists();

            if ($conflict) {
                return back()->with('error','This spot is not available for the selected time.');
            }

         $reservation = Reservation::create([
                'user_id' => $user->id,
                'parking_id' => $parking->id,
                'spot_id' => $spot->id,
                'subscription_id' => $subscription->id,
                'start_time' => $start,
                'end_time' => $end,
                'status' => 'active',
                'unit' => $unit,
                'unit_value' => $value,
            ]);
            \App\Models\AdminRevenue::create([
                   'source' => 'parking_fee',
                   'amount' => ($subscription->plan === 'premium' ? 0.20 : 0.10) *
             ($unit === 'days'
                   ? ($parking->price_per_hour * ($value * 24))
                   : ($parking->price_per_hour * $value)),
                   'parking_id' => $parking->id,
                   'reservation_id' => $reservation->id,
]);


            $spot->status = 'reserved';
            $spot->save();

            $parking->available_spots = $parking->spots()->where('status','available')->count();
            $parking->save();

            if ($unit === 'hours') $subscription->hours_used += $value;
            if ($unit === 'days')  $subscription->days_used  += $value;
            $subscription->save();

            return redirect()
                ->route('user.parkings.show', $parking->id)
                ->with('success','Reservation completed!');
        });
    }
}

