<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Livewire\Customer\CustomerDashboardComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ShopComponent;
use App\Livewire\CartComponent;
use App\Livewire\CheckoutComponent;
use App\Livewire\DetailsComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\SearchComponent;
use App\Livewire\WishlistComponent;
use App\Livewire\ThankyouComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\ManageOrderDetailsComponent;
use App\Livewire\Admin\ManageOrderComponent;
use App\Livewire\Customer\CustomerOrderComponent;
use App\Livewire\Customer\CustomerReviewComponent;
use App\Livewire\ContactComponent;
use App\Livewire\AboutComponent;
use App\Livewire\Customer\CustomerOrderDetailsComponent;
use App\Http\Controllers\Auth\GoogleController;
use Laravel\Socialite\Facades\Socialite;







//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/orders', ManageOrderComponent::class)->name('admin.orders');
    Route::get('/orderdetails/{order_id}', ManageOrderDetailsComponent::class)->name('admin.orderdetails');
});





//Customer 
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', CustomerDashboardComponent::class)->name('customer.dashboard');
    Route::get('/order', CustomerOrderComponent::class)->name('customer.orders');
    Route::get('/review/{order_item_id}', CustomerReviewComponent::class)->name('customer.review');
    Route::get('/ordersdetails/{order_id}', CustomerOrderDetailsComponent::class)->name('customer.orderdetails');
});



Route::get('/', HomeComponent::class)->name('home');

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/cart', CartComponent::class)->name('cart');


Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Route::get('/details/{slug}', DetailsComponent::class)->name('details');


Route::get('product-category/{slug}', CategoryComponent::class)->name('product.category');

Route::get('/search-product', SearchComponent::class)->name('search');

Route::get('/wishlist', WishlistComponent::class)->name('wishlist');

Route::get('/thanhyou', ThankyouComponent::class)->name('thankyou');

Route::get('/contact', ContactComponent::class)->name('contact');

Route::get('/about', AboutComponent::class)->name('about');










Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');
Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);



















// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
