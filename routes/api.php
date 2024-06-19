<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HandshakeController;
use App\Http\Controllers\PropertyPostController;
use App\Http\Controllers\SearchEngineController;

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
Route::post('/connectx', [HandshakeController::class, 'connect']);

// Route for user login with mobile number and OTP verification
Route::post('/signin', [AuthController::class, 'login']);

//Preset Information
Route::get('categories', [CategoryController::class, 'index']);

//Posts
Route::get('property-posts', [PropertyPostController::class, 'index']);
Route::get('my-property-posts/{user_id}', [PropertyPostController::class, 'mine']);
Route::post('post', [PropertyPostController::class, 'store']);
Route::put('update-post', [PropertyPostController::class, 'update']);
Route::delete('delete-post/{item}', [PropertyPostController::class, 'destroy']);

//Search Engine
Route::post('search', [SearchEngineController::class, 'index']);

//Button actions
Route::post('add-favourite', [FavouriteController::class, 'store']);
Route::post('remove-favourite', [FavouriteController::class, 'destroy']);

//Comments and Reply Threads
Route::get('post-comments/{post_id}', [CommentController::class, 'index']);
Route::post('comment-reply', [CommentController::class, 'store']);
Route::put('comments/{comment}', [CommentController::class, 'update']);
Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

// Protected route to retrieve user information after successful authentication
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

