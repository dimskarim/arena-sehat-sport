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

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
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
});
