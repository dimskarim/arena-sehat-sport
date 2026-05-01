<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Api\Admin\KategoriController;
use App\Http\Controllers\Api\Admin\LapanganController;
use App\Http\Controllers\Api\Admin\GambarLapanganController;
use App\Http\Controllers\Api\Admin\SlotWaktuController;
use App\Http\Controllers\Api\Admin\OprationalWaktuController;
use App\Http\Controllers\Api\Admin\BookingController;
use App\Http\Controllers\Api\Admin\PaymentController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\NotifikasiController;

// User Controllers
use App\Http\Controllers\Api\User\BookingController as UserBookingController;
use App\Http\Controllers\Api\User\PaymentController as UserPaymentController;
use App\Http\Controllers\Api\User\NotifikasiController as UserNotifikasiController;

// Auth Controller
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Middleware\CheckAdminRole;

/*
|--------------------------------------------------------------------------
| DOKUMENTASI REQUEST API - Arena Sehat Sport
|--------------------------------------------------------------------------
|
| Semua request (kecuali login & register) WAJIB menggunakan header:
| Accept: application/json
| Authorization: Bearer <token_kamu>
|
|--------------------------------------------------------------------------
| AUTH ENDPOINTS (Public)
|--------------------------------------------------------------------------
|
| 1. REGISTER (POST /api/register)
|    Body (JSON):
|    {
|        "name": "John Doe",
|        "email": "john@example.com",
|        "phone": "081234567890",
|        "password": "password",
|        "password_confirmation": "password"
|    }
|
| 2. LOGIN (POST /api/login)
|    Body (JSON):
|    {
|        "email": "admin@arena.id",
|        "password": "password"
|    }
|
| 3. LUPA PASSWORD (POST /api/forgot-password)
|    Body (JSON):
|    {
|        "email": "john@example.com"
|    }
|
| 4. RESET PASSWORD (POST /api/reset-password)
|    Body (JSON):
|    {
|        "token": "<reset_token>",
|        "email": "john@example.com",
|        "password": "newpassword",
|        "password_confirmation": "newpassword"
|    }
|
|--------------------------------------------------------------------------
| AUTH ENDPOINTS (Authenticated)
|--------------------------------------------------------------------------
|
| 5. GET PROFILE (GET /api/me)
|    Headers: Accept, Authorization
|
| 6. UPDATE PROFILE (POST /api/profile)
|    Headers: Accept, Authorization
|    Body (form-data): name, phone, foto_profile (file)
|
| 7. GANTI PASSWORD (POST /api/change-password)
|    Headers: Accept, Authorization
|    Body (JSON):
|    {
|        "current_password": "oldpassword",
|        "password": "newpassword",
|        "password_confirmation": "newpassword"
|    }
|
| 8. LOGOUT (POST /api/logout)
|    Headers: Accept, Authorization
|
|--------------------------------------------------------------------------
| USER ENDPOINTS (Authenticated - role: user)
|--------------------------------------------------------------------------
|
| 9.  GET HISTORY BOOKING (GET /api/user/bookings?status=pending&date=2026-05-01)
| 10. CREATE BOOKING (POST /api/user/bookings)
| 11. DETAIL BOOKING (GET /api/user/bookings/{id})
| 12. GET PAYMENTS (GET /api/user/payments)
| 13. CREATE PAYMENT (POST /api/user/payments)
| 14. DETAIL PAYMENT (GET /api/user/payments/{id})
| 15. GET NOTIFIKASI (GET /api/user/notifikasis)
| 16. DETAIL NOTIFIKASI (GET /api/user/notifikasis/{id})
|
|--------------------------------------------------------------------------
| ADMIN ENDPOINTS (Authenticated - role: admin)
|--------------------------------------------------------------------------
|
| Admin memiliki full CRUD (index, store, show, update, destroy) untuk:
| - /api/admin/users           (manage user)
| - /api/admin/kategoris       (manage kategori)
| - /api/admin/lapangans       (manage lapangan)
| - /api/admin/gambar-lapangans (manage foto lapangan)
| - /api/admin/slot-waktus     (manage jadwal)
| - /api/admin/oprational-waktus (manage jam operasional)
| - /api/admin/bookings        (manage history booking)
| - /api/admin/payments        (manage pembayaran)
| - /api/admin/notifikasis     (manage notifikasi)
|
| Filter tersedia pada masing-masing endpoint:
| - users: ?search=&role=&per_page=
| - lapangans: ?search=&kategori_id=&status=&per_page=
| - bookings: ?status=&user_id=&date=&per_page=
| - payments: ?status=&booking_id=&per_page=
| - gambar-lapangans: ?lapangan_id=&per_page=
| - slot-waktus: ?lapangan_id=&per_page=
| - oprational-waktus: ?lapangan_id=&per_page=
| - notifikasis: ?user_id=&per_page=
|
*/

// =====================================================================
// PUBLIC ROUTES (no authentication required)
// =====================================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// =====================================================================
// AUTHENTICATED ROUTES (require auth:sanctum)
// =====================================================================
Route::middleware(['auth:sanctum'])->group(function () {

    // --- Auth / Profile ---
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- USER ROUTES (role: user) ---
    Route::prefix('user')->group(function () {
        // Booking (history booking + create)
        Route::get('/bookings', [UserBookingController::class, 'index']);
        Route::post('/bookings', [UserBookingController::class, 'store']);
        Route::get('/bookings/{id}', [UserBookingController::class, 'show']);

        // Payment (pembayaran)
        Route::get('/payments', [UserPaymentController::class, 'index']);
        Route::post('/payments', [UserPaymentController::class, 'store']);
        Route::get('/payments/{id}', [UserPaymentController::class, 'show']);

        // Notifikasi
        Route::get('/notifikasis', [UserNotifikasiController::class, 'index']);
        Route::get('/notifikasis/{id}', [UserNotifikasiController::class, 'show']);
    });

    // --- ADMIN ROUTES (role: admin) ---
    Route::middleware([CheckAdminRole::class])->prefix('admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('kategoris', KategoriController::class);
        Route::apiResource('lapangans', LapanganController::class);
        Route::apiResource('gambar-lapangans', GambarLapanganController::class);
        Route::apiResource('slot-waktus', SlotWaktuController::class);
        Route::apiResource('oprational-waktus', OprationalWaktuController::class);
        Route::apiResource('bookings', BookingController::class);
        Route::apiResource('payments', PaymentController::class);
        Route::apiResource('notifikasis', NotifikasiController::class);
    });
});
