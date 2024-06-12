<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::get('dashboard', [DashboardController::class, 'dashboard']);
Route::get('infoAdmin', [DashboardController::class, 'infoAdmin'])-> name('infoAdmin');

Route::get('adminpage', [AdminController::class, 'adminpage'])->name('adminpage');
Route::post('approve/{id_booking}', [AdminController::class, 'approval'])->name('approve');


Route::get('/profile', [DashboardController::class, 'profilePage'])->name('profile')->middleware('auth');

Route::get('/booking', [BookController::class,'booking'])->name('book-time')->middleware('auth');
Route::post('/booking-store',[BookController::class,'store'])->name('book-store');

// Route::get('pembayaran', [PembayaranController::class, 'index'])->name('pembayaran_view');
Route::get('/pembayaran/{id_booking}', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

// Route::post('/approve/{id_booking}', [AdminController::class, 'approval'])->name('approve');

Route::get('/cart', [BookController::class, 'cart'])->name('cart')->middleware('auth');
Route::delete('/cart/{id}', [BookController::class, 'delete'])->name('booking.delete');