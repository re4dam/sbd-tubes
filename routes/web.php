<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;

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
//     return view('index');
// });

Route::get('/', [PelangganController::class, 'landingPage'])-> name('home');

// ini login
Route::get('/login', [LoginController::class, 'loginPage'])-> name('login');
Route::post('/login-store', [LoginController::class, 'login'])-> name('login-store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ini register
Route::get('/register', [PelangganController::class, 'registerPage'])-> name('register');
Route::post('/register-store', [PelangganController::class, 'pelangganCreate'])-> name('register-store');
// Route::get('',)

Route::get('dashboard', [DashboardController::class, 'dashboard']);

Route::get('/profile', [DashboardController::class, 'profilePage'])->name('profile')->middleware('auth');

Route::get('/booking', [BookController::class,'booking'])->name('book-time')->middleware('auth');
Route::post('/booking-store',[BookController::class,'store'])->name('book-store');

Route::get('pembayaran', [PembayaranController::class, 'index'])->name('pembayaran_view');