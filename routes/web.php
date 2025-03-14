<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\Legal\PrivacyPolicyPageController;
use App\Livewire\AccountRemoval;
use App\Livewire\Dashboard\BoosterView;
use App\Livewire\Dashboard\CategoryView;
use App\Livewire\Dashboard\CustomersView;
use App\Livewire\Dashboard\DashboardView;
use App\Livewire\Dashboard\LocationView;
use App\Livewire\Dashboard\PlansView;
use App\Livewire\Dashboard\PostReview;
use App\Livewire\Dashboard\PostView;
use App\Livewire\Dashboard\PropertyTypeView;
use App\Livewire\Payments\PaymentView;
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
Route::get('/ads', [AdController::class, 'index'])->name('ads');
Route::get('/delete-account', AccountRemoval::class)->name('delete-account');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),])->group(function () {

    Route::get('/dashboard', DashboardView::class)->name('dashboard');
    Route::get('/categories', CategoryView::class)->name('customers');
    Route::get('/property-types', PropertyTypeView::class)->name('types');
    Route::get('/locations', LocationView::class)->name('locations');
    Route::get('/plans', PlansView::class)->name('plans');
    Route::get('/customers', CustomersView::class)->name('customers');
    Route::get('/boost-plans', BoosterView::class)->name('boost-plans');
    Route::get('/payment-test', PaymentView::class)->name('payments');
    Route::get('/posts', PostView::class)->name('posts');
    Route::get('/posts-review', PostReview::class)->name('post-review');
});
