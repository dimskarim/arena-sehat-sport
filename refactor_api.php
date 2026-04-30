<?php

$dirs = [
    __DIR__ . '/app/Services',
    __DIR__ . '/app/Http/Requests/Admin',
    __DIR__ . '/app/Http/Resources',
    __DIR__ . '/app/Traits',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0755, true);
}

// 1. Trait for API Response
$apiResponseTrait = "<?php
namespace App\Traits;

trait ApiResponse {
    protected function successResponse(\$data, \$message = null, \$code = 200) {
        return response()->json([
            'status'=> 'Success', 
            'message' => \$message, 
            'data' => \$data
        ], \$code);
    }
    protected function errorResponse(\$message, \$code) {
        return response()->json([
            'status'=>'Error',
            'message' => \$message,
            'data' => null
        ], \$code);
    }
}";
file_put_contents(__DIR__ . '/app/Traits/ApiResponse.php', $apiResponseTrait);

// 2. Models Relationships & Scopes
$kategoriModel = "<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model {
    use HasFactory;
    protected \$fillable = ['name', 'slug'];

    protected static function boot() {
        parent::boot();
        static::creating(function (\$kategori) {
            \$kategori->slug = Str::slug(\$kategori->name);
        });
        static::updating(function (\$kategori) {
            \$kategori->slug = Str::slug(\$kategori->name);
        });
    }

    public function lapangans() {
        return \$this->hasMany(Lapangan::class);
    }
}";
file_put_contents(__DIR__ . '/app/Models/Kategori.php', $kategoriModel);

// 3. Lapangan Model
$lapanganModel = "<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model {
    use HasFactory;
    protected \$fillable = ['kategori_id', 'name', 'deskripsi', 'harga', 'status'];

    public function kategori() {
        return \$this->belongsTo(Kategori::class);
    }
    public function gambarLapangans() {
        return \$this->hasMany(GambarLapangan::class);
    }
    public function slotWaktus() {
        return \$this->hasMany(SlotWaktu::class);
    }
    public function oprationalWaktus() {
        return \$this->hasMany(OprationalWaktu::class);
    }

    // Scope for filtering & search
    public function scopeSearch(\$query, \$term) {
        if (\$term) {
            \$query->where('name', 'like', '%' . \$term . '%');
        }
    }
    public function scopeFilterKategori(\$query, \$kategori_id) {
        if (\$kategori_id) {
            \$query->where('kategori_id', \$kategori_id);
        }
    }
}";
file_put_contents(__DIR__ . '/app/Models/Lapangan.php', $lapanganModel);

// 4. Form Requests
$lapanganRequest = "<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class LapanganRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}";
file_put_contents(__DIR__ . '/app/Http/Requests/Admin/LapanganRequest.php', $lapanganRequest);

// 5. API Resources
$lapanganResource = "<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LapanganResource extends JsonResource {
    public function toArray(Request \$request): array {
        return [
            'id' => \$this->id,
            'kategori' => [
                'id' => \$this->kategori->id ?? null,
                'name' => \$this->kategori->name ?? null,
            ],
            'name' => \$this->name,
            'deskripsi' => \$this->deskripsi,
            'harga' => \$this->harga,
            'status' => \$this->status,
            'gambar_utama' => \$this->gambarLapangans->first()->gambar_file ?? null,
            'created_at' => \$this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}";
file_put_contents(__DIR__ . '/app/Http/Resources/LapanganResource.php', $lapanganResource);

// 6. Service Layer
$lapanganService = "<?php
namespace App\Services;
use App\Models\Lapangan;
use App\Models\GambarLapangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class LapanganService {
    public function getAllLapangans(\$search, \$kategori_id, \$perPage = 10) {
        return Lapangan::with(['kategori', 'gambarLapangans'])
            ->search(\$search)
            ->filterKategori(\$kategori_id)
            ->paginate(\$perPage);
    }

    public function createLapangan(array \$data, \$gambarFile = null) {
        DB::beginTransaction();
        try {
            \$lapangan = Lapangan::create(\$data);
            
            // File Upload logic
            if (\$gambarFile) {
                \$path = \$gambarFile->store('public/lapangans');
                GambarLapangan::create([
                    'lapangan_id' => \$lapangan->id,
                    'gambar_file' => Storage::url(\$path)
                ]);
            }
            
            DB::commit();
            return \$lapangan;
        } catch (Exception \$e) {
            DB::rollBack();
            throw \$e;
        }
    }

    public function getLapanganById(\$id) {
        return Lapangan::with(['kategori', 'gambarLapangans', 'slotWaktus', 'oprationalWaktus'])->findOrFail(\$id);
    }

    public function updateLapangan(\$id, array \$data) {
        \$lapangan = Lapangan::findOrFail(\$id);
        \$lapangan->update(\$data);
        return \$lapangan;
    }

    public function deleteLapangan(\$id) {
        \$lapangan = Lapangan::findOrFail(\$id);
        \$lapangan->delete();
        return true;
    }
}";
file_put_contents(__DIR__ . '/app/Services/LapanganService.php', $lapanganService);

// 7. Controller
$lapanganController = "<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\LapanganService;
use App\Http\Requests\Admin\LapanganRequest;
use App\Http\Resources\LapanganResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class LapanganController extends Controller
{
    use ApiResponse;
    
    protected \$lapanganService;

    public function __construct(LapanganService \$lapanganService) {
        \$this->lapanganService = \$lapanganService;
    }

    public function index(Request \$request) {
        try {
            \$lapangans = \$this->lapanganService->getAllLapangans(
                \$request->query('search'), 
                \$request->query('kategori_id'),
                \$request->query('per_page', 10)
            );
            return LapanganResource::collection(\$lapangans)->additional(['status' => 'Success']);
        } catch (Exception \$e) {
            return \$this->errorResponse(\$e->getMessage(), 500);
        }
    }

    public function store(LapanganRequest \$request) {
        try {
            \$lapangan = \$this->lapanganService->createLapangan(\$request->validated(), \$request->file('gambar'));
            return \$this->successResponse(new LapanganResource(\$lapangan), 'Lapangan created successfully', 201);
        } catch (Exception \$e) {
            return \$this->errorResponse(\$e->getMessage(), 500);
        }
    }

    public function show(\$id) {
        try {
            \$lapangan = \$this->lapanganService->getLapanganById(\$id);
            return \$this->successResponse(new LapanganResource(\$lapangan));
        } catch (Exception \$e) {
            return \$this->errorResponse('Lapangan not found', 404);
        }
    }

    public function update(LapanganRequest \$request, \$id) {
        try {
            \$lapangan = \$this->lapanganService->updateLapangan(\$id, \$request->validated());
            return \$this->successResponse(new LapanganResource(\$lapangan), 'Lapangan updated successfully');
        } catch (Exception \$e) {
            return \$this->errorResponse(\$e->getMessage(), 500);
        }
    }

    public function destroy(\$id) {
        try {
            \$this->lapanganService->deleteLapangan(\$id);
            return \$this->successResponse(null, 'Lapangan deleted successfully');
        } catch (Exception \$e) {
            return \$this->errorResponse('Failed to delete Lapangan', 500);
        }
    }
}";
file_put_contents(__DIR__ . '/app/Http/Controllers/Api/Admin/LapanganController.php', $lapanganController);

echo "Architecture generated for Lapangan (Controller, Service, Resource, Request, Model)!";
