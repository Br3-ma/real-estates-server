<?php

namespace App\Http\Controllers;

use App\Models\PropertyPost;
use App\Http\Requests\StorePropertyPostRequest;
use App\Http\Requests\UpdatePropertyPostRequest;
use App\Models\PropertyAmenities;
use App\Models\User;
use App\Notifications\NewPostComment;
use App\Notifications\PostSuccessful;
use Illuminate\Http\JsonResponse;
use Termwind\Components\Raw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class PropertyPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the latest unhidden posts
        return response()->json(PropertyPost::where('status_id', 1)
            ->orderBy('created_at', 'desc') // Order by created_at in descending order
            ->get());
    }

    public function hot()
    {
        //Get all unhidden posts that are on bid 1
        return response()->json(PropertyPost::inRandomOrder()->where('status_id', 1)->where('on_bid', 1)->get());
    }

    public function hotx2()
    {
        // Get all unhidden posts that are on bid 1, ordered by bid_value descending
        return response()->json(PropertyPost::where('status_id', 1)
            ->where('on_bid', 1)
            ->orderBy('bid_value', 'desc')
            ->get());
    }


    public function featured()
    {
        //Get top bids featured unhidden posts
        return response()->json(PropertyPost::where('on_bid', true)->where('status_id', 1)->get());
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

        // Attempt to increase upload limits
        ini_set('upload_max_filesize', '50M'); // Set to 50 megabytes
        ini_set('post_max_size', '55M'); // Set slightly larger than upload_max_filesize
        ini_set('memory_limit', '256M'); // Increase memory limit if needed

        Log::info('Reached....!');

        try {
            $property = new PropertyPost($request->except(['images', 'video', 'amenities'])); // Exclude files initially
            $property->save();

            // Save amenities to PropertyAmenities model
            if ($request->filled('amenities')) {
                $amenities = explode(',', $request->amenities); // Split amenities by comma
                foreach ($amenities as $amenity) {
                    // Assuming you have a PropertyAmenities model that has 'property_id' and 'amenity_name' columns
                    PropertyAmenities::create([
                        'property_post_id' => $property->id,
                        'amenity_name' => trim($amenity),
                    ]);
                }
            }
            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('images');
                        $property->images()->create(['path' => $path]);
                    } else {
                        $property->images()->create(['path' => 'images/no-img.png']);
                        Log::warning('Invalid image file detected. Fake one has been added');
                    }
                }
            } else {
                $property->images()->create(['path' => 'images/no-img.png']);
                Log::info('No images uploaded. Fake one has been added');
            }

            // Send a Post success notification
            $user = User::where('id', $request->user_id)->first();
            $user->notify(new PostSuccessful(
                'Your property was posted successfully.',
                $user
            ));
            return response()->json(['property'=> $property, 'message' => 'Property post details created successfully.'], 201);

        } catch (\Throwable $th) {
            Log::error('Error storing property post: ' . $th->getMessage());
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function uploadvideo(Request $request)
    {
        // Attempt to increase upload limits
        ini_set('upload_max_filesize', '50M'); // Set to 50 megabytes
        ini_set('post_max_size', '55M'); // Set slightly larger than upload_max_filesize
        ini_set('memory_limit', '256M'); // Increase memory limit if needed

        Log::info('Reached....!');

        $property = PropertyPost::where('id', $request->input('post_id'))->first();
        // Handle video uploads
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            if ($video->isValid()) {
                $path = $video->store('videos');
                $property->videos()->create(['path' => $path]);
            } else {
                Log::warning('Invalid video file detected.');
            }
        } else {
            $property->videos()->create(['path' => 'video']);
        }

        return response()->json(['message' => 'Property post created successfully.'], 201);
    }

    public function completeUpload(Request $request)
    {
        $request->validate([
            'videoId' => 'required|string',
        ]);
        $videoId = $request->input('videoId');
        $tempDir = storage_path('app/public/uploads/' . $videoId);
        if (!file_exists($tempDir)) {
            return response()->json(['error' => 'Video chunks not found'], 404);
        }

        $files = scandir($tempDir);
        natsort($files); // Sort the files in natural order

        $videoPath = storage_path('app/public/uploads/' . $videoId . '.mp4');
        $output = fopen($videoPath, 'ab');

        foreach ($files as $file) {
            if (strpos($file, 'chunk_') === 0) {
                $chunkPath = $tempDir . '/' . $file;
                $chunkData = file_get_contents($chunkPath);
                fwrite($output, $chunkData);
                unlink($chunkPath);
            }
        }

        fclose($output);
        rmdir($tempDir);

        return response()->json(['message' => 'Video upload complete', 'videoPath' => $videoPath]);
    }

    public function toggleHidePost($propertyId)
    {
        try {
            // Find the property post by ID
            $property = PropertyPost::findOrFail($propertyId);

            // Toggle status_id between 0 and 1
            $property->status_id = $property->status_id == 1 ? 0 : 1;

            // Save changes
            $property->save();

            return response()->json(['message' => 'Property post status toggled successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to toggle property post status'], 500);
        }
    }

    public function bid(Request $request){

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
