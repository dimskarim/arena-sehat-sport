<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\KategoriController;
use App\Http\Controllers\Api\Admin\LapanganController;
use App\Http\Controllers\Api\Admin\GambarLapanganController;
use App\Http\Controllers\Api\Admin\SlotWaktuController;
use App\Http\Controllers\Api\Admin\OprationalWaktuController;
use App\Http\Controllers\Api\Admin\BookingController;
use App\Http\Controllers\Api\Admin\PaymentController;
use App\Http\Controllers\Api\Admin\UserController;

use App\Http\Middleware\CheckAdminRole;

Route::middleware(['auth:sanctum', CheckAdminRole::class])->prefix('admin')->group(function () {
    // Check if user is admin
        Route::apiResource('users', UserController::class);
        Route::apiResource('kategoris', KategoriController::class);
        Route::apiResource('lapangans', LapanganController::class);
        Route::apiResource('gambar-lapangans', GambarLapanganController::class);
        Route::apiResource('slot-waktus', SlotWaktuController::class);
        Route::apiResource('oprational-waktus', OprationalWaktuController::class);
        Route::apiResource('bookings', BookingController::class);
        Route::apiResource('payments', PaymentController::class);
});
