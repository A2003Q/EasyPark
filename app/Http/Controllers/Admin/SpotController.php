<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use Illuminate\Http\Request;
use App\Models\Parking;

class SpotController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'parking_id' => 'required|exists:parkings,id',
            'spot_number' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved',
        ]);

        Spot::create($data);

        return back()->with('success', 'Spot added.');
    }

    public function update(Request $request, Spot $spot)
    {
        $data = $request->validate([
            'spot_number' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved',
        ]);

        $spot->update($data);

        return back()->with('success', 'Spot updated.');
    }

    public function destroy(Spot $spot)
    {
        $spot->delete();
        return back()->with('success', 'Spot deleted.');
    }

    public function index(Parking $parking)
{
    return response()->json(
        $parking->spots()->orderBy('spot_number')->get()
    );
}
}
