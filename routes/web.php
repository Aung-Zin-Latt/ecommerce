<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;

use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
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

// Products By Categories
Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');

// Search Products
Route::get('/search', SearchComponent::class)->name('product.search');


// For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});
// For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    // Admin Category Page
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    // Admin Add New Category
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    // Admin Edit Category
    Route::get('/admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.editcategory');
    // Admin Product Page
    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');

    // Admin Add New Product
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.addproduct');
    // Admin Edit Product
    Route::get('/admin/product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.editproduct');

    // Admin Making Home Page Slider Dynamic
    Route::get('/admin/slider', AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('/admin/slider/add', AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
    Route::get('/admin/slider/edit/{slide_id}', AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    // Admin Show Product Categories On Homepage
    Route::get('/admin/home-categories', AdminHomeCategoryComponent::class)->name('admin.homecategories');

    // Admin Making On Sale Timer Working
    Route::get('/admin/sale', AdminSaleComponent::class)->name('admin.sale');

});
