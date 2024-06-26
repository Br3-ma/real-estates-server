<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        // Validate request data
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     // Add more validation rules as needed
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 422);
        // }

        // // Store user information in the database
        // // Example:
        // $user = User::create([
        //     'name' => $request->input('name'),
        //     'phone' => $request->input('phone'),
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password')
        // ]);

        return response()->json(['message' => 'User information stored successfully' ], 200);
    }
}
