<?php

namespace App\Http\Controllers;

use App\Models\PropertyPost;
use App\Http\Requests\StorePropertyPostRequest;
use App\Http\Requests\UpdatePropertyPostRequest;
use Illuminate\Http\JsonResponse;
use Termwind\Components\Raw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        try {
            // Log the incoming request
            // Log::info( $request->all());
            if ($request->hasFile('images')) {
                Log::info( 'true');
            }else{
                Log::info( 'false');
            }

            $property = new PropertyPost($request->toArray());
            $property->save();
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images');
                    $property->images()->create(['path' => $path]);
                }
            }
            return response()->json($property, 201);
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
    // public function destroy(PropertyPost $propertyPost)
    public function destroy($id)
    {
        try {
            // Retrieve the property post with its associated images
            $propertyPost = PropertyPost::with('images')->findOrFail($id);

            // Begin a transaction to ensure both property and images are deleted
            DB::beginTransaction();

            Log::info($propertyPost);

            // Delete associated images from storage
            // if (!empty($propertyPost->images)) {
            //     foreach ($propertyPost->images as $image) {
            //         // Storage::delete($image->path);
            //         $image->delete();
            //     }
            // }

            // Delete the property post
            $propertyPost->delete();

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Property post deleted successfully'], 200);
        } catch (\Throwable $th) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            Log::info($th->getMessage());
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


}
