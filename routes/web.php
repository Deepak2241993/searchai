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
use App\Http\Controllers\OrderRecordsController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AadhaarOCRController;
use App\Http\Controllers\AadhaarController;



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
Route::get('/about-us', [HomeController::class, 'AboutUs'])->name('aboutus');

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


Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');


// Checkout Routes
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/payment/create-order', [PaymentController::class, 'createOrder'])->name('payment.createOrder');

// Payment Routes
Route::get('/pay/{order}', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::post('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');



Route::get('/clear-cart', function () {
    session()->forget('cart');
    return 'Cart cleared';
});

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');




// aadhar_card 
Route::get('/aadhaar-ocr', [AadhaarOCRController::class, 'performOCR']);



Route::get('/aadhaar-form', function () {
    return view('aadhaar_form');
});
Route::get('/aadhaar-form-verify', function () {
    return view('aadhaar_verify');
});


Route::get('/aadhaar/form', [AadhaarController::class, 'showForm'])->name('aadhaar.form');
Route::post('/aadhaar/generate', [AadhaarController::class, 'generateOtp'])->name('aadhaar.generate');
Route::get('/aadhaar/verify', [AadhaarController::class, 'showVerifyForm'])->name('aadhaar.verify');
Route::post('/aadhaar/submit', [AadhaarController::class, 'submitOtp'])->name('aadhaar.submit');
Route::get('/aadhaar/success', [AadhaarController::class, 'success'])->name('aadhaar.success');





Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [RegisterController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [RegisterController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [RegisterController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [RegisterController::class, 'settings'])->name('settings');
    Route::put('/updatePassword', [RegisterController::class, 'updatePassword'])->name('updatePassword');


    //cart

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');


    Route::get('/my-orders', [RegisterController::class, 'orders'])->name('orders');
    Route::get('admin/token/{id}', [RegisterController::class, 'show'])->name('admin.token.show');
    // Route::get('/User/token/{id}', [TokenController::class, 'show'])->name('token.show');

    Route::get('/token-views', [TokenController::class, 'tokenList'])->name('token.index');

    //  For CCRV Service
    Route::get('/ccrv', [TokenController::class, 'CCRV'])->name('new-token.index');
    Route::get('/all-ccrv-report', [TokenController::class, 'AllCCRVReport'])->name('all-ccrv-report');
    Route::post('/ccrv-report', [TokenController::class, 'CCRVReport'])->name('ccrv-report');
    Route::get('/download-pdf/{id}', [TokenController::class, 'downloadPdf'])->name('download.pdf');
    Route::get('/download-report/{id}', [TokenController::class, 'ReportGenerate'])->name('reportgenerate');

    // For Background And CCRV 
    Route::get('/ccrv-and-background-verification', [TokenController::class, 'CcrvAndBackgroundVerification'])->name('ccrv-and-background-verification');
    Route::post('/background-otpgeneration', [TokenController::class, 'BackgroundVerificationOtp'])->name('background-otpgeneration');
    Route::post('/background-kyc-otp', [TokenController::class, 'KycOtpSubmit'])->name('kyc-otp');
    Route::post('/ccrv-report-generation', [TokenController::class, 'CcrvReportGeneration'])->name('ccrv-report-generation');

    // Checkout Routes
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/payment/create-order', [PaymentController::class, 'createOrder'])->name('payment.createOrder');
});



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
        Route::get('/admin/get-slug', [ServiceController::class, 'getSlug'])->name('getslug');
        //blog
        Route::resource('blog', BlogController::class);

        // aadhar_card 
        Route::post('/aadhaar-ocr', [AadhaarOCRController::class, 'performOCR']);

        Route::get('/orders-details', [OrderRecordsController::class, 'ordersDetails'])->name('ordersDetails');
        Route::get('/orders/{id}', [OrderRecordsController::class, 'show'])->name('orders.show');
        Route::get('/tokens', [OrderRecordsController::class, 'ordersDetails'])->name('ordersDetails');
    });
});
Route:: view('deepak','pdf.ccrv_report');