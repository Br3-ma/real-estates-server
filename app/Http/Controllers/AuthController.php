<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle user login with mobile number and OTP verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Attempt to find the user
        $user = User::where('email', $request->email)->first();

        if ($request->password != $user->password) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        // Generate a token (optional, for token-based auth)
        $token = $user->createToken('authToken')->plainTextToken;

        // Return the response with the token
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ], 200);

    }

    /**
     * Generate and send OTP to the provided mobile number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestOtp(Request $request)
    {
        // Generate OTP (for example, a 6-digit random code)
        $otp = mt_rand(100000, 999999);

        // Send OTP to the provided mobile number (you need to implement this)

        // For now, just return the OTP in the response for testing purposes
        return response()->json(['otp' => $otp], 200);
    }

    /**
     * Verify the provided OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOtp(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Check if OTP matches the one sent to the user
        $otp = $request->input('otp');
        $isOtpValid = true;

        return response()->json(['is_valid' => $isOtpValid], 200);
    }

    /**
     * Store user information after successful signup.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Store user information in the database
        // Example:
        $user = User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        return response()->json(['message' => 'User information stored successfully', 'user' => $user ], 200);
    }
}
