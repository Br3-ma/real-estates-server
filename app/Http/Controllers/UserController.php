<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function update(Request $request)
    {

        // Find the authenticated user
        $user = User::where('id', $request->input('user_id'))->first();

        // Update user information
        switch ($request->input('segment')) {
            case 'password':

                // Check if password is provided and update it if necessary
                if ($request->has('password')) {
                    $user->password = Hash::make($request->input('password'));
                }
                break;
            case 'profile':
                if ($request->filled('name')) $user->name = $request->input('name');
                if ($request->filled('phone')) $user->phone = $request->input('phone');
                if ($request->filled('email')) $user->email = $request->input('email');
                if ($request->filled('bio')) $user->boi = $request->input('bio');
                if ($request->filled('location')) $user->location = $request->input('location');
                if ($request->filled('website')) $user->website = $request->input('website');
            break;
            case 'picture':
                // Handle user picture upload/update
                if ($request->hasFile('picture')) {
                    foreach ($request->file('picture') as $pic) {
                        // Store the uploaded file and get its path
                        $path = $pic->store('profile',);

                        // Update user's picture field with the new path
                        $user->picture = $path;
                    }
                }
                break;
            default:
                # code...
            break;
        }


        // Save the updated user record
        $user->save();

        return response()->json(['user'=>$user,'message' => 'User information updated successfully'], 200);
    }
}
