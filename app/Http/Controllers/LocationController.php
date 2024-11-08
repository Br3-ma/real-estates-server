<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Location::get();
            return response()->json(['message' => 'success', 'data' => $data ], 200);
        } catch (\Throwable $th) {
            $data = [];
            return response()->json(['message' => $th->getMessage(), 'data' => $data ], 200);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'icon_name' => 'nullable|string|max:255',
        ]);

        $location = Location::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'icon_name' => $request->icon_name,
        ]);

        return response()->json(['message' => 'Location created successfully', 'data' => $location], 201);
    }

    // Get a single location by ID
    public function show($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        return response()->json($location);
    }

    // Update a location
    public function update(Request $request, $id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'icon_name' => 'nullable|string|max:255',
        ]);

        $location->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'icon_name' => $request->icon_name,
        ]);

        return response()->json(['message' => 'Location updated successfully', 'data' => $location]);
    }

    // Delete a location
    public function destroy($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        $location->delete();

        return response()->json(['message' => 'Location deleted successfully']);
    }
}
