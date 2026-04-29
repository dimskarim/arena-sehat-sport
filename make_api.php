<?php

$routes = "<?php

use Illuminate\\Support\\Facades\\Route;
use App\\Http\\Controllers\\Api\\Admin\\KategoriController;
use App\\Http\\Controllers\\Api\\Admin\\LapanganController;
use App\\Http\\Controllers\\Api\\Admin\\GambarLapanganController;
use App\\Http\\Controllers\\Api\\Admin\\SlotWaktuController;
use App\\Http\\Controllers\\Api\\Admin\\OprationalWaktuController;
use App\\Http\\Controllers\\Api\\Admin\\BookingController;
use App\\Http\\Controllers\\Api\\Admin\\PaymentController;
use App\\Http\\Controllers\\Api\\Admin\\UserController;

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    // Check if user is admin
    Route::middleware(function (\$request, \$next) {
        if (\$request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }
        return \$next(\$request);
    })->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('kategoris', KategoriController::class);
        Route::apiResource('lapangans', LapanganController::class);
        Route::apiResource('gambar-lapangans', GambarLapanganController::class);
        Route::apiResource('slot-waktus', SlotWaktuController::class);
        Route::apiResource('oprational-waktus', OprationalWaktuController::class);
        Route::apiResource('bookings', BookingController::class);
        Route::apiResource('payments', PaymentController::class);
    });
});
";

file_put_contents(__DIR__ . '/routes/api.php', $routes);

$controllers = [
    'UserController' => 'User',
    'KategoriController' => 'Kategori',
    'LapanganController' => 'Lapangan',
    'GambarLapanganController' => 'GambarLapangan',
    'SlotWaktuController' => 'SlotWaktu',
    'OprationalWaktuController' => 'OprationalWaktu',
    'BookingController' => 'Booking',
    'PaymentController' => 'Payment'
];

foreach ($controllers as $controller => $model) {
    $content = "<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\\$model;
use Illuminate\Http\Request;

class $controller extends Controller
{
    public function index()
    {
        return response()->json($model::all());
    }

    public function store(Request \$request)
    {
        \$data = \$request->all();
        // Here you would add validation
        \$item = $model::create(\$data);
        return response()->json(\$item, 201);
    }

    public function show(\$id)
    {
        \$item = $model::findOrFail(\$id);
        return response()->json(\$item);
    }

    public function update(Request \$request, \$id)
    {
        \$item = $model::findOrFail(\$id);
        \$data = \$request->all();
        // Here you would add validation
        \$item->update(\$data);
        return response()->json(\$item);
    }

    public function destroy(\$id)
    {
        \$item = $model::findOrFail(\$id);
        \$item->delete();
        return response()->json(null, 204);
    }
}
";
    file_put_contents(__DIR__ . '/app/Http/Controllers/Api/Admin/' . $controller . '.php', $content);
}

// Generate models fillable
$modelsFillable = [
    'User' => "['name', 'foto_profile', 'email', 'phone', 'password', 'role']",
    'Kategori' => "['name']",
    'Lapangan' => "['kategori_id', 'name', 'deskripsi', 'harga', 'status']",
    'GambarLapangan' => "['lapangan_id', 'gambar_file']",
    'SlotWaktu' => "['lapangan_id', 'waktu_mulai', 'waktu_selesai']",
    'OprationalWaktu' => "['lapangan_id', 'waktu_buka', 'waktu_tutup']",
    'Booking' => "['user_id', 'lapangan_id', 'tanggal_booking', 'total_harga', 'status']",
    'Payment' => "['booking_id', 'payment_method', 'butki_payment', 'tanggal_payment', 'status']",
    'DetasilBooking' => "['booking_id', 'slot_waktu_id', 'harga', 'status']",
    'Notifikasi' => "['user_id', 'details_booking_id', 'deskripsi', 'pesan']"
];

foreach ($modelsFillable as $model => $fillable) {
    $path = __DIR__ . '/app/Models/' . $model . '.php';
    if (file_exists($path)) {
        if ($model === 'User') {
            $content = file_get_contents($path);
            $content = preg_replace('/protected \$fillable = \[.*?\];/s', "protected \$fillable = $fillable;", $content);
            file_put_contents($path, $content);
        } else {
            $content = "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class $model extends Model
{
    use HasFactory;

    protected \$fillable = $fillable;
}
";
            file_put_contents($path, $content);
        }
    }
}

echo "Controllers, Routes, and Models updated!\n";
