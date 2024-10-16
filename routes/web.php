<?php

use App\Http\Controllers\Legal\PrivacyPolicyPageController;
use App\Livewire\Dashboard\CustomersView;
use App\Livewire\Dashboard\DashboardView;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/privacy-policy', [PrivacyPolicyPageController::class, 'index'])->name('privacy-policy');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'),])->group(function () {
    
    Route::get('/dashboard', DashboardView::class)->name('dashboard');
    Route::get('/customers', CustomersView::class)->name('customers');

});
