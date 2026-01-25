<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\Reservation;
use App\Models\Spot;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AdminRevenue;


class SubscriptionFrontController extends Controller
{
    public function index(Request $request)
    {
        $active = $request->user()->subscriptions()->where('status','active')->latest()->first();

        $plans = [
            'basic' => ['price' => 10, 'hours_limit' => 60,  'days_limit' => 0],
            'premium' => ['price' => 25, 'hours_limit' => 200, 'days_limit' => 12],
        ];

        return view('user.subscriptions.index', compact('active','plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:basic,premium',
        ]);

        $plan = $request->plan;

        $plans = [
            'basic' => ['price' => 10, 'hours_limit' => 60,  'days_limit' => 0],
            'premium' => ['price' => 25, 'hours_limit' => 200, 'days_limit' => 12],
        ];

        // اقفل أي اشتراك قديم
        $request->user()->subscriptions()->where('status','active')->update(['status'=>'expired']);

        $start = Carbon::today();
        $end   = Carbon::today()->addDays(30);

        $subscription = Subscription::create([
            'user_id' => $request->user()->id,
            'plan' => $plan,
            'price' => $plans[$plan]['price'],
            'hours_limit' => $plans[$plan]['hours_limit'],
            'days_limit' => $plans[$plan]['days_limit'],
            'hours_used' => 0,
            'days_used' => 0,
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'active',
        ]);
        AdminRevenue::create([
            'source' => 'subscription',
            'amount' => $plans[$plan]['price'],
            'parking_id' => null,
            'reservation_id' => null,
                     ]);


        // ✅ إذا في حجز معلّق (جاي من زر Reserve) نفّذه تلقائيًا
        if ($request->session()->has('pending_reservation')) {
            $pending = $request->session()->get('pending_reservation');

            $unit = $pending['unit'];
            $value = (int) $pending['value'];

            // basic ما يسمح days
            if ($unit === 'days' && $subscription->plan === 'basic') {
                $request->session()->forget('pending_reservation');
                return redirect($request->session()->get('url.intended', route('user.parkings.show')))
                    ->with('error','Basic plan supports hourly reservations only.');
            }

            $remainingHours = max(0, (int)$subscription->hours_limit - (int)$subscription->hours_used);
            $remainingDays  = max(0, (int)$subscription->days_limit - (int)$subscription->days_used);

            if ($unit === 'hours' && $value > $remainingHours) {
                $request->session()->forget('pending_reservation');
                return redirect($request->session()->get('url.intended', route('user.parkings.show')))
                    ->with('error', "Not enough hours left. Remaining: {$remainingHours}");
            }
            if ($unit === 'days' && $value > $remainingDays) {
                $request->session()->forget('pending_reservation');
                return redirect($request->session()->get('url.intended', route('user.parkings.show')))
                    ->with('error', "Not enough days left. Remaining: {$remainingDays}");
            }

            $startAt = Carbon::now();
            $endAt   = $unit === 'hours' ? $startAt->copy()->addHours($value) : $startAt->copy()->addDays($value);

            return DB::transaction(function () use ($request, $subscription, $pending, $unit, $value, $startAt, $endAt) {
                $user = $request->user();

                $spot = Spot::lockForUpdate()->findOrFail($pending['spot_id']);
                $parking = Parking::lockForUpdate()->findOrFail($pending['parking_id']);

                $conflict = Reservation::query()
                    ->where('spot_id', $spot->id)
                    ->where('status','active')
                    ->where(function($q) use ($startAt,$endAt){
                        $q->whereBetween('start_time', [$startAt,$endAt])
                          ->orWhereBetween('end_time', [$startAt,$endAt])
                          ->orWhere(function($qq) use ($startAt,$endAt){
                              $qq->where('start_time','<=',$startAt)->where('end_time','>=',$endAt);
                          });
                    })
                    ->exists();

                if ($conflict) {
                    $request->session()->forget('pending_reservation');
                    return redirect($request->session()->get('url.intended', route('user.parkings.index')))
                        ->with('error','This spot is not available anymore.');
                }

                Reservation::create([
                    'user_id' => $user->id,
                    'parking_id' => $parking->id,
                    'spot_id' => $spot->id,
                    'subscription_id' => $subscription->id,
                    'start_time' => $startAt,
                    'end_time' => $endAt,
                    'status' => 'active',
                    'unit' => $unit,
                    'unit_value' => $value,
                ]);

                $spot->status = 'reserved';
                $spot->save();

                $parking->available_spots = $parking->spots()->where('status','available')->count();
                $parking->save();

                if ($unit === 'hours') $subscription->hours_used += $value;
                if ($unit === 'days')  $subscription->days_used  += $value;
                $subscription->save();

                // نظف السيشن
                $request->session()->forget('pending_reservation');

                // رجّعه على صفحة السبوتس ويشوف اللون متغير + نجاح
                return redirect()
                    ->route('user.parkings.show', $parking->id)
                    ->with('success','Reservation completed!');
            });
        }

        // إذا ما في حجز معلّق: رجعه للبروفايل
        return redirect()->intended(route('user.profile'))
            ->with('success','Subscription activated!');
    }
}

