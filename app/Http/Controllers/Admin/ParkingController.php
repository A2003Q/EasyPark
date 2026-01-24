<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\City;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function index(Request $request)
{
    $cities = City::all(); // For the dropdown filter

    $query = Parking::query();

    // Filter by city
    if ($request->filled('city_id')) {
        $query->where('city_id', $request->city_id);
    }

    // Filter by active status
    if ($request->filled('is_active')) {
        $query->where('is_active', $request->is_active);
    }

    $parkings = $query->paginate(5)->withQueryString(); // Keep filters on pagination

    return view('admin.parkings.index', compact('parkings', 'cities'));
}


    public function create()
    {
        $cities = City::all();
        return view('admin.parkings.create', compact('cities'));
    }

    public function store(Request $request)
{
    $request->validate([
        'city_id' => 'required|exists:cities,id',
        'name' => 'required',
        'address' => 'required',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'total_spots' => 'required|integer|min:1',
        'available_spots' => 'required|integer|min:0',
        'price_per_hour' => 'required|numeric|min:0',
        'image_url' => 'nullable|string|max:500',
        'is_active' => 'required|boolean',
    ]);

    Parking::create([
        'city_id' => $request->city_id,
        'name' => $request->name,
        'address' => $request->address,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'total_spots' => $request->total_spots,
        'available_spots' => $request->available_spots,
        'price_per_hour' => $request->price_per_hour,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.parkings.index')
        ->with('success', 'Parking created successfully');
}

    public function edit(Parking $parking)
    {
        $cities = City::all();
        return view('admin.parkings.edit', compact('parking', 'cities'));
    }

    public function update(Request $request, Parking $parking)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'total_spots' => 'required|integer|min:1',
            'available_spots' => 'required|integer|min:0',
            'price_per_hour' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:500',
            'is_active' => 'required|boolean',
        ]);

        $parking->update([
            ...$request->all(),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.parkings.index')
            ->with('success', 'Parking updated successfully');
    }

    public function destroy(Parking $parking)
    {
        $parking->delete();

        return redirect()->route('admin.parkings.index')
            ->with('success', 'Parking deleted successfully');
    }
}

