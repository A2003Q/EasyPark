<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Parking;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParkingBrowseController extends Controller
{
    public function index(Request $request)
    {
        $this->completeExpiredReservations();

        $cities = City::orderBy('name')->get();

        $cityId = $request->input('city_id');
        $place  = trim((string) $request->input('place'));

        $query = Parking::query()->with('city')->where('is_active', true);

        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        if ($place !== '') {
            $query->where(function ($q) use ($place) {
                $q->where('name', 'like', "%{$place}%")
                  ->orWhere('address', 'like', "%{$place}%");
            });
        }

        if (!$cityId && $place === '') {
            $query->inRandomOrder();
        }

        $parkings = $query->paginate(9)->withQueryString();

        $markers = $parkings->map(fn ($p) => [
            'id' => $p->id,
            'name' => $p->name,
            'address' => $p->address,
            'lat' => (float) $p->latitude,
            'lng' => (float) $p->longitude,
            'available' => (int) $p->available_spots,
            'price_per_hour' => (float) $p->price_per_hour,
            'details_url' => route('user.parkings.show', $p->id),
        ])->values();

        return view('user.parkings.index', compact('cities','parkings','markers','cityId','place'));
    }

    public function show(Parking $parking)
    {
        $this->completeExpiredReservations();

        $parking->load(['city', 'spots' => fn($q) => $q->orderBy('spot_number')]);

        $now = Carbon::now();
        $activeReservations = Reservation::query()
            ->where('parking_id', $parking->id)
            ->where('status', 'active')
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->get()
            ->keyBy('spot_id');

        return view('user.parkings.show', compact('parking','activeReservations'));
    }

    private function completeExpiredReservations(): void
    {
        $now = Carbon::now();

        DB::transaction(function () use ($now) {
            $expired = Reservation::query()
                ->where('status', 'active')
                ->where('end_time', '<', $now)
                ->lockForUpdate()
                ->get();

            foreach ($expired as $res) {
                $res->status = 'completed';
                $res->save();

                $hasActiveNow = Reservation::query()
                    ->where('spot_id', $res->spot_id)
                    ->where('status', 'active')
                    ->where('start_time', '<=', $now)
                    ->where('end_time', '>=', $now)
                    ->exists();

                if (!$hasActiveNow && $res->spot) {
                    $spot = $res->spot()->lockForUpdate()->first();
                    $spot->status = 'available';
                    $spot->save();

                    $parking = $res->parking()->lockForUpdate()->first();
                    if ($parking) {
                        $parking->available_spots = $parking->spots()->where('status','available')->count();
                        $parking->save();
                    }
                }
            }
        });
    }
}
