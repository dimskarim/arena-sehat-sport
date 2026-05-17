<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LapanganController;
use App\Http\Controllers\Admin\GambarLapanganController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SlotWaktuController;
use App\Http\Controllers\Admin\OprationalWaktuController;
use App\Http\Controllers\Admin\TimeController;

use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/lapangan', [FrontController::class, 'lapanganIndex'])->name('lapangan.index');
Route::get('/lapangan/{id}', [FrontController::class, 'lapanganShow'])->name('lapangan.show');
Route::get('/booking/create', [FrontController::class, 'bookingCreate'])->name('booking.create');
Route::get('/booking/payment', [FrontController::class, 'bookingPayment'])->name('booking.payment');
Route::get('/booking/riwayat', [FrontController::class, 'bookingRiwayat'])->name('booking.riwayat');
Route::get('/profile', [FrontController::class, 'profile'])->name('profile.index');
Route::get('/login', [FrontController::class, 'login'])->name('front.login');
Route::get('/register', [FrontController::class, 'register'])->name('front.register');
Route::get('/support', [FrontController::class, 'support'])->name('support');
use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.web')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('kategoris', KategoriController::class);
        Route::resource('users', UserController::class);
        Route::resource('lapangans', LapanganController::class);
        Route::resource('gambar-lapangans', GambarLapanganController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('notifications', NotificationController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('slot-waktus', SlotWaktuController::class);
        Route::resource('oprational-waktus', OprationalWaktuController::class);
        Route::get('/time', [TimeController::class, 'index'])->name('time.index');
    });
});
