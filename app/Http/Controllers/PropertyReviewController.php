<?php

namespace App\Http\Controllers;

use App\Models\PropertyFile;
use App\Models\PropertyPost;
use App\Notifications\PropertyApproval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PropertyReviewController extends Controller
{

    public function approvePost(Request $request, $post_id){
        try {

            $post = PropertyPost::where('id', $post_id)->first();
            $post->verified_status = 1; // Assuming 1 is approved status
            $post->reviewed_by = 1;
            $post->reviewed_at = Carbon::now();
            $post->review_notes = $request?->input('reviewNotes');
            $post->save();

            // You might want to notify the property owner
            // $post?->user?->notify(new PropertyApproval($post));
            // Redirect to property list or stay on page based on your needs
            return response()->json(['success'=>true, 'message'=>'Property has been approved successfully'],200);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(['success'=>false, 'message'=>$e->getMessage()],500);
        }
    }

    public function holdPost(Request $request, $post_id){
        try {
            $post = PropertyPost::where('id', $post_id)->first();
            $post->verified_status = 2;
            $post->reviewed_by = 1;
            $post->reviewed_at = Carbon::now();
            $post->review_notes = $request?->input('reviewNotes');
            $post->save();

            // You might want to notify the property owner
            // $this->post->user->notify(new PropertyOnHold($this->post));
            return response()->json(['success'=>true, 'message'=>'Property has been stalled successfully'],200);

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to put property on hold. ' . $e->getMessage());
        }
    }


    public function declinePost(Request $request, $post_id){
        try {
            $post = PropertyPost::where('id', $post_id)->first();
            $post->verified_status = 3;
            $post->reviewed_by = 1;
            $post->reviewed_at = Carbon::now();
            $post->review_notes = $request?->input('reviewNotes');
            $post->save();

            // You might want to notify the property owner
            // $this->post->user->notify(new PropertyOnHold($this->post));
            return response()->json(['success'=>true, 'message'=>'Property has been declined successfully'],200);

        } catch (\Exception $e) {
            dd($e);
            session()->flash('error', 'Failed to put property on hold. ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'property_id' => 'required|integer|exists:property_posts,id',
                'deed' => 'required|file',
                'id' => 'required|file',
                'self' => 'required|file',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
            ]);

            // Store files
            $deedPath = $request->file('deed')->store('docs');
            $idPath = $request->file('id')->store('docs');
            $selfPath = $request->file('self')->store('docs');

            // Save deed file
            PropertyFile::create([
                'name' => 'Deed',
                'path' => $deedPath,
                'property_post_id' => $request->property_id,
            ]);

            // Save ID file
            PropertyFile::create([
                'name' => 'ID',
                'path' => $idPath,
                'property_post_id' => $request->property_id,
            ]);

            // Save self file
            PropertyFile::create([
                'name' => 'Self',
                'path' => $selfPath,
                'property_post_id' => $request->property_id,
            ]);

            return response()->json([
                'message' => 'Documents uploaded successfully.',
            ]);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
        }
    }


}
