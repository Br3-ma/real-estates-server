<?php

namespace App\Http\Controllers;

use App\Mail\OTPVerificationCode;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            return response()->json(['message' => $validator->errors(),'errors' => $validator->errors()], 422);
        }

        // Attempt to find the user
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password','error' => 'Invalid email or password'], 401);
        }

        // Generate a token (optional, for token-based auth)
        $token = $user->createToken('authToken')->plainTextToken;

        // Return the response with the token
        return response()->json([
            'message' => 'success',
            'token' => $token,
            'user' => $user
        ], 200);

    }

    public function google(Request $request)
    {
        // dd($request);
        try {
            // Validate request data (ensure required fields from Google data are present)
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors(), 'request'=>$request], 422);
            }

            // Check if the user already exists by Google sub ID or email
            $user = User::where('email', $request->input('email'))
                        ->orWhere('google_id', $request->input('sub'))
                        ->first();

            if ($user) {
                // If user exists, return user data

            return response()->json(['message' => 'Already LoggedIn', 'user' => $user], 200);
            }

            // Create a new user if they don't exist
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'google_id' => $request->input('sub'), // Store Google sub as google_id
                'email_verified_at' => now(),
                'bio' => 'No bio',
                'work' => 'No work',
                'location' => 'Not set',
                'website' => 'None',
                'gender' => 'Not set',
                'cover' => 'profile/no-cover.jpg',
                'picture' => $request->input('picture', 'profile/no-user.png'), // Use Google profile picture if available
                'google_pic' => $request->input('picture', 'profile/no-user.png'), // Use Google profile picture if available
                'password' => 'password777' // Generate a random password, as it's not needed for Google users
            ]);

            // Send a welcome notification
            $user->notify(new WelcomeNotification(
                'Welcome to Square, login to get started on viewing wonderful houses and properties for rent and sale.',
                $user
            ));

            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed', 'error' => $th->getMessage()], 500);
        }
    }

    public function facebook(Request $request){

        return response()->json(['message' => 'worked'], 200);
    }

    /**
     * Generate and send OTP to the provided mobile number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestOtp(Request $request)
    {
        // Generate OTP (for example, a 4-digit random code)
        $otp = mt_rand(1000, 9999);

        // Send OTP to the provided mobile number (you need to implement this)
        $user = User::where('email', $request->input('email'))->first();
        $user->otp = $otp;
        $user->save();

        $data = [
            'name' => $user->name,
            'email' => $request->input('email'),
            'message' => $otp
        ];

        Mail::to($request->input('email'))->send(new OTPVerificationCode($data));

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
        $user = User::where('email', $request->input('email'))->first();

        if ($otp == $user->otp) {
            return response()->json(['is_valid' => true], 200);
        }else{
            return response()->json(['is_valid' => false], 200);
        }
    }

    /**
     * Store user information after successful signup.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(Request $request)
    {

        try {
            // Validate request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:15|unique:users',
            ]);

            // If validation fails, return an error response
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'error' => $validator->errors()], 422);
            }


            // Hash the password before storing it
            $hashedPassword = Hash::make($request->input('password'));

            // Store user information in the database
            $user = User::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'password' => $hashedPassword, // Save the hashed password
                'bio' => 'No bio',
                'work' => 'No work',
                'location' => 'Not set',
                'website' => 'None',
                'gender' => 'Not set',
                'cover' => 'profile/no-cover.jpg',
                'picture' => 'profile/no-user.png',
                'isSub' => 0,
                'is_plan_id',
            ]);

            //Send a welcome notification
            $user->notify(new WelcomeNotification(
                'Welcome to Square, login to get started on viewing wonderful houses and properties for rent and sale.',
                $user
            ));

            return response()->json(['message' => 'success', 'user' => $user ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'failed', 'error' => $th->getMessage() ], 200);
        }
    }


    /**
     * Reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the user by email
        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            // Update the user's password
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return response()->json(['resp' => true, 'user' => $user, 'message'=>'Updated successfully'], 200);
        } else {
            return response()->json(['resp' => false, 'user' => [], 'message'=>'Account with this email does not exit, Please sign up'], 401);
        }
    }

}
