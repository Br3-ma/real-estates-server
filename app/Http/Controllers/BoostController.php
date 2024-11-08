<?php

namespace App\Http\Controllers;

use App\Models\Boost;
use App\Http\Requests\StoreBoostRequest;
use App\Http\Requests\UpdateBoostRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class BoostController extends Controller
{
    public function show($id)
    {
        return response()->json(Boost::findOrFail($id));
    }

    public function store(Request $request)
    {
        dd($request);
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'icon' => 'nullable|string',
            'duration' => 'required|numeric',
            'duration_type' => 'required|string',
        ]);

        $boost = Boost::create($data);

        return response()->json(['message' => 'Boost Plan Created Successfully', 'data' => $boost], 201);
    }

    public function update(Request $request, $id)
    {
        $boost = Boost::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'icon' => 'nullable|string',
            'duration' => 'required|numeric',
            'duration_type' => 'required|string',
        ]);

        $boost->update($data);

        return response()->json(['message' => 'Boost Plan Updated Successfully', 'data' => $boost]);
    }

    public function destroy($id)
    {
        Boost::destroy($id);
        return response()->json(['message' => 'Boost Plan Deleted Successfully']);
    }
}
