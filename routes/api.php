<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HandshakeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PropertyPostController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\SearchEngineController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route for user signup with mobile number
Route::post('/signup/user-info', [AuthController::class, 'userInfo']);
Route::post('/signup/request-otp', [AuthController::class, 'requestOtp']);
Route::post('/signup/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Route for user login with mobile number and OTP verification
Route::post('/signin', [AuthController::class, 'login']);
Route::post('/google-signin', [AuthController::class, 'google']);

//Preset Information
Route::get('property-types', [PropertyTypeController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('locations', [LocationController::class, 'index']);

//Posts
Route::get('featured-list-posts', [PropertyPostController::class, 'featured']);
Route::get('hot-list-posts', [PropertyPostController::class, 'hot']);

Route::get('property-posts', [PropertyPostController::class, 'index']);
Route::get('hot-property-posts', [PropertyPostController::class, 'hot']);

Route::get('my-property-posts/{user_id}', [PropertyPostController::class, 'mine']);
Route::post('post', [PropertyPostController::class, 'store']);
Route::post('upload-video', [PropertyPostController::class, 'uploadvideo']);
Route::put('update-post', [PropertyPostController::class, 'update']);
Route::delete('delete-post/{item}', [PropertyPostController::class, 'destroy']);
Route::post('toggle-hide-post/{property_id}', [PropertyPostController::class, 'toggleHidePost']);
Route::post('bid-top-post/{property_id}', [PropertyPostController::class, 'Bid']);

//Payment
Route::post('/pay-w-broadpay', [PaymentController::class, 'store']);

//Search Engine
Route::post('search', [SearchEngineController::class, 'index']);
Route::get('search-all', [SearchEngineController::class, 'index2']);

//Button actions
Route::post('add-favourite', [FavouriteController::class, 'store']);
Route::post('remove-favourite', [FavouriteController::class, 'destroy']);

//Comments and Reply Threads
Route::get('post-comments/{post_id}', [CommentController::class, 'index']);
Route::post('comment-reply', [CommentController::class, 'store']);
Route::put('comments/{comment}', [CommentController::class, 'update']);
Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

// User
Route::post('update-profile', [UserController::class, 'update']);

//Notifications
Route::get('notify/{user_id}', [NotificationController::class, 'index']);
Route::post('/connectx', [HandshakeController::class, 'connect']);



// Protected route to retrieve user information after successful authentication
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

