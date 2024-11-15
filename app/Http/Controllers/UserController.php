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

    public function info($id){
        $data = User::where('id', $id)->first();
        return response()->json(['message' => 'User information stored successfully', 'user' => $data ], 200);
    }

    public function update(Request $request)
    {
        try {
            $user = User::with('posts')->where('id', $request->input('user_id'))->first();
            switch ($request->input('segment')) {

                //Update password
                case 'password':
                    if ($request->has('password')) {
                        $user->password = Hash::make($request->input('password'));
                    }
                    $user->save();
                    break;

                //Update profile details
                case 'profile':
                    if ($request->filled('name')) $user->name = $request->input('name');
                    if ($request->filled('phone')) $user->phone = $request->input('phone');
                    if ($request->filled('email')) $user->email = $request->input('email');
                    if ($request->filled('bio')) $user->bio = $request->input('bio');
                    if ($request->filled('location')) $user->location = $request->input('location');
                    if ($request->filled('website')) $user->website = $request->input('website');
                    $user->save();
                break;

                //Upload profile picture
                case 'picture':
                    if ($request->hasFile('picture')) {
                        foreach ($request->file('picture') as $pic) {
                            $path = $pic->store('profile');
                            $user->picture = $path;
                        }
                    }else{
                        Log::info( 'No Profile Picture');
                    }
                    $user->save();
                    break;

                //Upload cover photo
                case 'cover':
                    if ($request->hasFile('picture')) {
                        foreach ($request->file('picture') as $pic) {
                            $path = $pic->store('profile');
                            $user->cover = $path;
                        }
                    }else{
                        Log::info( 'No Cover Picture');
                    }
                    $user->save();
                    break;
                default:
                break;
            };
            $data = $user;
            return response()->json(['message' => 'User information stored successfully', 'user' => $data ], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['message' => $th->getMessage(), 'user' => [] ], 500);
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete(); // Delete the user
            return response()->json(['success' => 'User deleted successfully']);
        }
        return response()->json(['error' => 'User not found'], 404);
    }
}
