<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;

use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminSettingComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserEditProfileComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\WishlistComponent;
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
Route::get('/checkout', CheckoutComponent::class)->name('checkout');

// Create Product Details Page
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');

// Products By Categories
Route::get('/product-category/{category_slug}/{scategory_slug?}', CategoryComponent::class)->name('product.category');

// Search Products
Route::get('/search', SearchComponent::class)->name('product.search');

// Show All Wishlisted Products
Route::get('/wishlist', WishlistComponent::class)->name('product.wishlist');

// For Thankyou
Route::get('/thank-you', ThankyouComponent::class)->name('thankyou');

// Create Contact Page
Route::get('/contact-us', ContactComponent::class)->name('contact');


// For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');

    // Show Orders and Order Details for User
    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}', UserOrderDetailsComponent::class)->name('user.orderdetails');
    Route::get('/user/review/{order_item_id}', UserReviewComponent::class)->name('user.review');

    // User Change Password
    Route::get('/user/change-password', UserChangePasswordComponent::class)->name('user.changepassword');

    // Create User Profile
    Route::get('/user/profile', UserProfileComponent::class)->name('user.profile');

    // Update User Profile
    Route::get('user/profile/edit', UserEditProfileComponent::class)->name('user.editprofile');
});



// For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    // Admin Category Page
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    // Admin Add New Category
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    // Admin Edit Category
    Route::get('/admin/category/edit/{category_slug}/{scategory_slug?}', AdminEditCategoryComponent::class)->name('admin.editcategory'); // + edit subcategories
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

    // Admin Create Coupons
    Route::get('/admin/coupons', AdminCouponsComponent::class)->name('admin.coupons');
    Route::get('/admin/coupon/add', AdminAddCouponComponent::class)->name('admin.addcoupon');
    Route::get('/admin/coupon/edit/{coupon_id}', AdminEditCouponComponent::class)->name('admin.editcoupon');

    // Admin Show Orders
    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.orders');

    //Admin Show Order Details
    Route::get('/admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderdetails');

    // Create Contact Page
    Route::get('admin/contact-us', AdminContactComponent::class)->name('admin.contact');

    // Admin Create Settings Page
    Route::get('admin/settings', AdminSettingComponent::class)->name('admin.settings');

});
