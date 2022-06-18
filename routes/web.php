<?php

// use App\Http\Livewire\User\UserDashboardComponent;
// use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Home Page or base.blade.php
Route::get('/', HomeComponent::class);

// Shop, Cart and Checkout Pages
Route::get('/shop', ShopComponent::class);
// Shopping Cart
Route::get('/cart', CartComponent::class)->name('product.cart');
Route::get('/checkout', CheckoutComponent::class);

// Create Product Details Page
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');

// Admin & User Authentication
// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', App\Http\Livewire\User\UserDashboardComponent::class)->name('user.dashboard');
});
// For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.dashboard');
});
