<?php
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Auth\RegisterController;


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


Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])
            ->name('admin.dashboard');
    
    });



});