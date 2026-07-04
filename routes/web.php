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
Route::middleware('auth')->group(function () {
    Route::get('/booking/create', [FrontController::class, 'bookingCreate'])->name('booking.create');
    Route::post('/booking/store', [FrontController::class, 'bookingStore'])->name('booking.store');
    Route::get('/booking/payment', [FrontController::class, 'bookingPayment'])->name('booking.payment');
    Route::get('/booking/riwayat', [FrontController::class, 'bookingRiwayat'])->name('booking.riwayat');
    Route::get('/profile', [FrontController::class, 'profile'])->name('profile.index');
    Route::post('/profile', [FrontController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [FrontController::class, 'updatePassword'])->name('profile.password');
    Route::get('/notifications/{id}/read', [FrontController::class, 'readNotification'])->name('front.notifications.read');
});

Route::get('/login', [FrontController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\Front\AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [FrontController::class, 'register'])->name('front.register');
Route::post('/register', [\App\Http\Controllers\Front\AuthController::class, 'register'])->name('front.register.submit');
Route::post('/logout', [\App\Http\Controllers\Front\AuthController::class, 'logout'])->name('front.logout');
Route::get('/lapangan/{id}/slots', [FrontController::class, 'getSlotWaktu'])->name('lapangan.slots');
Route::get('/support', [FrontController::class, 'support'])->name('support');
use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.web')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Profile Routes
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
        
        // Admin Only Routes
        Route::middleware('admin.only')->group(function () {
            Route::resource('kategoris', KategoriController::class);
            Route::resource('users', UserController::class);
            Route::patch('users/{id}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
            Route::patch('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        });

        Route::resource('lapangans', LapanganController::class);
        Route::resource('gambar-lapangans', GambarLapanganController::class);
        Route::resource('payments', PaymentController::class);
        Route::get('notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
        Route::resource('notifications', NotificationController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('slot-waktus', SlotWaktuController::class);
        Route::patch('slot-waktus/{id}/toggle-status', [SlotWaktuController::class, 'toggleStatus'])->name('slot-waktus.toggle-status');
        Route::resource('oprational-waktus', OprationalWaktuController::class);
        Route::get('/time', [TimeController::class, 'index'])->name('time.index');
        Route::post('fasilitas', [\App\Http\Controllers\Admin\FasilitasController::class, 'store'])->name('fasilitas.store');
    });
});
