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

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://api.easysendsms.app/bulksms',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => '',
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => 'POST',
        // CURLOPT_POSTFIELDS => 'username=bremnyelngez42024&password=xuQzJd7O&to=0772147755&from=test&text=HelloLooser%20world&type=0',
        // CURLOPT_HTTPHEADER => array(
        // 'Content-Type: application/x-www-form-urlencoded',
        // 'Cookie: ASPSESSIONIDASCQBARR=NKOHDCHDOFEOOALJIGDGGPAM'
        // ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Attempt to find the user
        $user = User::with('posts')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
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
            'password' => $request->input('password'),
            'bio' => 'No bio',
            'work' => 'No work',
            'location' => 'Not set',
            'website' => 'None',
            'gender' => 'Not set',
            'cover' => 'profile/no-cover.jpg',
            'picture' => 'profile/no-user.png'
        ]);

        //Send a welcome notification
        $user->notify(new WelcomeNotification(
            'Welcome to Square, login to get started on viewing wonderful houses and properties for rent and sale.',
            $user
        ));

        return response()->json(['message' => 'User information stored successfully', 'user' => $user ], 200);
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

            return response()->json(['resp' => true, ], 200);
        } else {
            return response()->json(['resp' => false], 401);
        }
    }

}
