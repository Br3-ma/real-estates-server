<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::get();
        return response()->json($plans);
    }
    // Get a single subscription plan by ID
    public function show($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Subscription Plan not found'], 404);
        }

        return response()->json($plan);
    }

    // Store a new subscription plan
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'duration' => 'required|integer', // e.g., duration in months
        ]);

        $plan = Plan::create($request->all());

        return response()->json(['message' => 'Subscription Plan created successfully', 'data' => $plan], 201);
    }

    // Update an existing subscription plan
    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Subscription Plan not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
        ]);

        $plan->update($request->all());

        return response()->json(['message' => 'Subscription Plan updated successfully', 'data' => $plan]);
    }

    // Delete a subscription plan
    public function destroy($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Subscription Plan not found'], 404);
        }

        $plan->delete();

        return response()->json(['message' => 'Subscription Plan deleted successfully']);
    }
}
