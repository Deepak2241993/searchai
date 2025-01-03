<?php
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\GiftCouponController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ServiceController;
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

// Route::get('/', function () {
//     return view('welcom');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');

// register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login 
Route::get('login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('login', [RegisterController::class, 'login']);
Route::post('logout', [RegisterController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('forgot-password', [RegisterController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [RegisterController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('reset-password/{token}', [RegisterController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [RegisterController::class, 'reset'])->name('password.update');


// KYC Verification Pages
Route::get('/kyc-verification', function () {
    return view('frontend.kyc-verification');
})->name('kyc.verification');

Route::get('/kyc-criminal-verification', function () {
    return view('frontend.kyc-criminal-verification');
})->name('kyc.criminal-verification');

// Services
Route::get('/services', [TokenController::class, 'services'])->name('services');

// Cart
Route::post('/cart', [TokenController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [TokenController::class, 'viewCart'])->name('cart');

// Checkout
Route::get('/checkout', [TokenController::class, 'showCheckoutForm'])
    ->name('checkout');
    // Protect with authentication

Route::post('/checkout', [TokenController::class, 'processCheckout'])
    ->name('checkout.process');


// Payment
Route::post('/payment', [TokenController::class, 'processPayment'])
    ->name('payment.process')
    ->middleware('auth');


Route::prefix('admin')->name('admin.')->group(function () {

    // Public Routes (Login and Logout)
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Routes (Requires Admin Authentication)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        // User 
        Route::get('/user-list', [AuthController::class, 'userList'])->name('user-list');
        Route::get('/user-edit/{id}', [AuthController::class, 'userEdit'])->name('user.edit');
        Route::put('/user-update/{id}', [AuthController::class, 'userUpdate'])->name('user.update');
        Route::delete('/user-delete/{id}', [AuthController::class, 'userDelete'])->name('user.delete');

        //Coupon
        Route::get('/coupon-list', [GiftCouponController::class, 'couponList'])->name('coupon.list');
        Route::get('/coupon-create', [GiftCouponController::class, 'couponCreate'])->name('coupon.create');
        Route::post('/coupon-store', [GiftCouponController::class, 'couponStore'])->name('coupon.store');
        Route::get('/coupon-edit/{id}', [GiftCouponController::class, 'couponEdit'])->name('coupon.edit');
        Route::put('/coupon-update/{id}', [GiftCouponController::class, 'couponUpdate'])->name('coupon.update');
        Route::delete('/coupon-delete/{id}', [GiftCouponController::class, 'couponDelete'])->name('coupon.delete');

        // faqs
        Route::resource('faq', FaqController::class);
        //banner
        Route::resource('banner', BannerController::class);
        // service
        Route::resource('service', ServiceController::class);
        //blog
        Route::resource('blog', BlogController::class);
    });

});