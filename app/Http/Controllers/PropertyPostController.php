<?php

namespace App\Http\Controllers;

use App\Models\PropertyPost;
use App\Http\Requests\StorePropertyPostRequest;
use App\Http\Requests\UpdatePropertyPostRequest;

class PropertyPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PropertyPost::all());
    }



    public function mine($user_id){
        return response()->json(PropertyPost::where('user_id', $user_id)->get());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyPostRequest $request)
    {
        try {
            // Store uploaded images
            // $images = [];
            // foreach ($request->file('images') as $image) {
            //     $imageName = $image->getClientOriginalName();
            //     $image->move(public_path('images'), $imageName);
            //     $images[] = $imageName;
            // }

            $response = PropertyPost::create($request->toArray());
            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyPost $propertyPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyPost $propertyPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyPostRequest $request, PropertyPost $propertyPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyPost $propertyPost)
    {
        //
    }
}
