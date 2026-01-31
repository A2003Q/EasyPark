<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    // ✅ JSON list for modal
    public function list(Parking $parking)
    {
        $this->authorizeOwnerParking($parking);

        return response()->json(
            $parking->spots()->orderBy('spot_number')->get(['id','spot_number','status'])
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'parking_id' => 'required|exists:parkings,id',
            'spot_number' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved',
        ]);

        $parking = Parking::findOrFail($data['parking_id']);
        $this->authorizeOwnerParking($parking);

        Spot::create([
            'parking_id' => $parking->id,
            'spot_number' => $data['spot_number'],
            'status' => $data['status'],
        ]);

        // لو Ajax
        if ($request->ajax()) return response()->json(['ok'=>true]);

        return back()->with('success','Spot added.');
    }

    public function update(Request $request, Spot $spot)
    {
        $data = $request->validate([
            'spot_number' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved',
        ]);

        $parking = Parking::findOrFail($spot->parking_id);
        $this->authorizeOwnerParking($parking);

        $spot->update($data);

        if ($request->ajax()) return response()->json(['ok'=>true]);

        return back()->with('success','Spot updated.');
    }

    public function destroy(Request $request, Spot $spot)
    {
        $parking = Parking::findOrFail($spot->parking_id);
        $this->authorizeOwnerParking($parking);

        $spot->delete();

        if ($request->ajax()) return response()->json(['ok'=>true]);

        return back()->with('success','Spot deleted.');
    }

    private function authorizeOwnerParking(Parking $parking): void
    {
        if ((int)$parking->owner_id !== (int)auth()->id()) {
            abort(403);
        }
    }
}
