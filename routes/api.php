<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoostController;
use App\Http\Controllers\Callback\PaymentCallbackController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HandshakeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
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
Route::get('property-posts', [PropertyPostController::class, 'index']);
Route::get('hot-property-posts', [PropertyPostController::class, 'hot']);
Route::get('hot-property-posts-x2', [PropertyPostController::class, 'hotx2']);

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
Route::get('notify-count/{user_id}', [NotificationController::class, 'count']);
Route::post('/connectx', [HandshakeController::class, 'connect']);


// User
Route::post('/v1/submit-mobile-payment', [PaymentController::class, 'deposit']);
Route::post('deposit-callback', [PaymentCallbackController::class, 'deposit']);


Route::get('/categories/{id}', [CategoryController::class, 'show']); // Fetch a single category
Route::post('/categories', [CategoryController::class, 'store']); // Create a new category
Route::put('/categories/{id}', [CategoryController::class, 'update']); // Update an existing category
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); // Delete a category
// In web.php or api.php

Route::get('/property-types/{id}', [PropertyTypeController::class, 'show'])->name('property-types.show');
Route::post('/property-types', [PropertyTypeController::class, 'store'])->name('property-types.store');
Route::put('/property-types/{id}', [PropertyTypeController::class, 'update'])->name('property-types.update');
Route::delete('/property-types/{id}', [PropertyTypeController::class, 'destroy'])->name('property-types.destroy');

// Route for creating a new location
Route::post('/locations', [LocationController::class, 'store']);
Route::get('/locations/{id}', [LocationController::class, 'show']);
Route::put('/locations/{id}', [LocationController::class, 'update']);
Route::delete('/locations/{id}', [LocationController::class, 'destroy']);

// Subscription Plan API Routes
Route::get('plans/{id}', [PlanController::class, 'show']); // Get a single plan by ID
Route::post('plans', [PlanController::class, 'store']); // Create a new plan
Route::put('plans/{id}', [PlanController::class, 'update']); // Update a plan
Route::delete('plans/{id}', [PlanController::class, 'destroy']); // Delete a plan

// Boost Plan API Routes
Route::get('boostplans/{id}', [BoostController::class, 'show']); // Get a single plan by ID
Route::post('boostplans', [BoostController::class, 'store']); // Create a new plan
Route::put('boostplans/{id}', [BoostController::class, 'update']); // Update a plan
Route::delete('boostplans/{id}', [BoostController::class, 'destroy']); // Delete a plan


// Protected route to retrieve user information after successful authentication
// Route::middleware('auth:sanctum')->group(function () {
// });

