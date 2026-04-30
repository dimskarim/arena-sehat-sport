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

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Middleware\CheckAdminRole;

/*
|--------------------------------------------------------------------------
| CONTOH DOKUMENTASI REQUEST API
|--------------------------------------------------------------------------
|
| Semua request (kecuali login) WAJIB menggunakan header:
| Accept: application/json
| Authorization: Bearer <token_kamu>
|
| 1. LOGIN (POST /api/login)
|    Body (JSON):
|    {
|        "email": "aadmin@arena.id",
|        "password": "password"
|    }
|
| 2. GET PROFILE (GET /api/me)
|    Headers: Accept, Authorization
|
| 3. LOGOUT (POST /api/logout)
|    Headers: Accept, Authorization
|
| 4. ADMIN: GET SEMUA KATEGORI (GET /api/admin/kategoris)
|    Headers: Accept, Authorization
|
| 5. ADMIN: TAMBAH KATEGORI (POST /api/admin/kategoris)
|    Headers: Accept, Authorization
|    Body (JSON):
|    {
|        "nama": "Futsal",
|        "deskripsi": "Lapangan futsal"
|    }
|
| 6. ADMIN: UBAH KATEGORI (PUT /api/admin/kategoris/{id})
|    Headers: Accept, Authorization
|    Body (JSON):
|    {
|        "nama": "Futsal Indoor"
|    }
|
| 7. ADMIN: HAPUS KATEGORI (DELETE /api/admin/kategoris/{id})
|    Headers: Accept, Authorization
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

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
