<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Return all active categories
        $data = PropertyType::get();
        return response()->json(['message' => 'success', 'data' => $data ], 200);
    }


    // Store a new property type
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'icon_name' => 'nullable|string',
        ]);

        $type = PropertyType::create($request->all());

        return response()->json($type, 201);
    }

    public function show($id)
    {
        return response()->json(PropertyType::findOrFail($id));
    }

    // Update an existing property type
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'icon_name' => 'nullable|string',
        ]);

        $type = PropertyType::findOrFail($id);
        $type->update($request->all());

        return response()->json($type);
    }

    // Delete a property type
    public function destroy($id)
    {
        $type = PropertyType::findOrFail($id);
        $type->delete();

        return response()->json(['message' => 'Property type deleted successfully']);
    }
}
