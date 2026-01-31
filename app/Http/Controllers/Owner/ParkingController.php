<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\City;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function index()
    {
        $parkings = Parking::where('owner_id', auth()->id())->latest()->paginate(10);
        $cities = City::all();

        return view('admin.parkings.index', compact('parkings','cities'));
    }

    public function create()
    {
        $cities = City::all();
        return view('admin.parkings.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'total_spots' => 'required|integer|min:1',
            'available_spots' => 'required|integer|min:0',
            'price_per_hour' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        $data['owner_id'] = auth()->id(); // ✅ important

        Parking::create($data);

        return redirect()->route('owner.parkings.index')->with('success','Parking created.');
    }

    public function edit(Parking $parking)
    {
        $this->authorizeOwner($parking);

        $cities = City::all();
        return view('admin.parkings.edit', compact('parking','cities'));
    }

    public function update(Request $request, Parking $parking)
    {
        $this->authorizeOwner($parking);

        $data = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'total_spots' => 'required|integer|min:1',
            'available_spots' => 'required|integer|min:0',
            'price_per_hour' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        $parking->update($data);

        return redirect()->route('owner.parkings.index')->with('success','Parking updated.');
    }

    public function destroy(Parking $parking)
    {
        $this->authorizeOwner($parking);

        $parking->delete();
        return back()->with('success','Parking deleted.');
    }

    private function authorizeOwner(Parking $parking): void
    {
        if ($parking->owner_id !== auth()->id()) {
            abort(403);
        }
    }
}
