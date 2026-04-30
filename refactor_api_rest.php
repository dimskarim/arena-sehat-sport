<?php

$entities = [
    'User' => [
        'model' => 'App\Models\User',
        'fields' => ['name', 'email', 'phone', 'role', 'password'],
        'hasFile' => true,
        'fileField' => 'foto_profile',
        'filePath' => 'public/users',
    ],
    'Kategori' => [
        'model' => 'App\Models\Kategori',
        'fields' => ['name'],
        'hasFile' => false,
    ],
    'GambarLapangan' => [
        'model' => 'App\Models\GambarLapangan',
        'fields' => ['lapangan_id'],
        'hasFile' => true,
        'fileField' => 'gambar_file',
        'filePath' => 'public/lapangans',
    ],
    'SlotWaktu' => [
        'model' => 'App\Models\SlotWaktu',
        'fields' => ['lapangan_id', 'waktu_mulai', 'waktu_selesai'],
        'hasFile' => false,
    ],
    'OprationalWaktu' => [
        'model' => 'App\Models\OprationalWaktu',
        'fields' => ['lapangan_id', 'waktu_buka', 'waktu_tutup'],
        'hasFile' => false,
    ],
    'Booking' => [
        'model' => 'App\Models\Booking',
        'fields' => ['user_id', 'lapangan_id', 'tanggal_booking', 'total_harga', 'status'],
        'hasFile' => false,
    ],
    'Payment' => [
        'model' => 'App\Models\Payment',
        'fields' => ['booking_id', 'payment_method', 'tanggal_payment', 'status'],
        'hasFile' => true,
        'fileField' => 'butki_payment',
        'filePath' => 'public/payments',
    ]
];

foreach ($entities as $name => $config) {
    // 1. Service
    $fileHandling = "";
    if ($config['hasFile']) {
        $fileHandling = "
            if (\$file) {
                \$data['{$config['fileField']}'] = \Illuminate\Support\Facades\Storage::url(\$file->store('{$config['filePath']}'));
            }";
    }

    $serviceCode = "<?php
namespace App\Services;
use {$config['model']};

class {$name}Service {
    public function getAll(\$perPage = 10) {
        return {$name}::paginate(\$perPage);
    }
    public function create(array \$data, \$file = null) {
        {$fileHandling}
        if (isset(\$data['password'])) \$data['password'] = bcrypt(\$data['password']);
        return {$name}::create(\$data);
    }
    public function getById(\$id) {
        return {$name}::findOrFail(\$id);
    }
    public function update(\$id, array \$data, \$file = null) {
        \$item = {$name}::findOrFail(\$id);
        {$fileHandling}
        if (isset(\$data['password'])) {
            \$data['password'] = bcrypt(\$data['password']);
        } else {
            unset(\$data['password']);
        }
        \$item->update(\$data);
        return \$item;
    }
    public function delete(\$id) {
        \$item = {$name}::findOrFail(\$id);
        \$item->delete();
        return true;
    }
}";
    file_put_contents(__DIR__ . "/app/Services/{$name}Service.php", $serviceCode);

    // 2. Request
    $requestRules = [];
    foreach ($config['fields'] as $field) {
        if ($field === 'email') $requestRules[] = "'$field' => 'required|email'";
        else if ($field === 'password') $requestRules[] = "'$field' => 'nullable|min:6'";
        else $requestRules[] = "'$field' => 'required'";
    }
    if ($config['hasFile']) {
        $requestRules[] = "'{$config['fileField']}' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'";
    }
    $rulesStr = implode(",\n            ", $requestRules);

    $requestCode = "<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class {$name}Request extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            $rulesStr
        ];
    }
}";
    file_put_contents(__DIR__ . "/app/Http/Requests/Admin/{$name}Request.php", $requestCode);

    // 3. Resource
    $resourceCode = "<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class {$name}Resource extends JsonResource {
    public function toArray(Request \$request): array {
        return parent::toArray(\$request);
    }
}";
    file_put_contents(__DIR__ . "/app/Http/Resources/{$name}Resource.php", $resourceCode);

    // 4. Controller
    $controllerCode = "<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\\{$name}Service;
use App\Http\Requests\Admin\\{$name}Request;
use App\Http\Resources\\{$name}Resource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class {$name}Controller extends Controller
{
    use ApiResponse;
    
    protected \$service;

    public function __construct({$name}Service \$service) {
        \$this->service = \$service;
    }

    public function index(Request \$request) {
        try {
            \$items = \$this->service->getAll(\$request->query('per_page', 10));
            return {$name}Resource::collection(\$items)->additional(['status' => 'Success']);
        } catch (Exception \$e) {
            return \$this->errorResponse(\$e->getMessage(), 500);
        }
    }

    public function store({$name}Request \$request) {
        try {
            \$item = \$this->service->create(\$request->validated(), \$request->file('" . ($config['hasFile'] ? $config['fileField'] : 'dummy') . "'));
            return \$this->successResponse(new {$name}Resource(\$item), '{$name} created successfully', 201);
        } catch (Exception \$e) {
            return \$this->errorResponse(\$e->getMessage(), 500);
        }
    }

    public function show(\$id) {
        try {
            \$item = \$this->service->getById(\$id);
            return \$this->successResponse(new {$name}Resource(\$item));
        } catch (Exception \$e) {
            return \$this->errorResponse('{$name} not found', 404);
        }
    }

    public function update({$name}Request \$request, \$id) {
        try {
            \$item = \$this->service->update(\$id, \$request->validated(), \$request->file('" . ($config['hasFile'] ? $config['fileField'] : 'dummy') . "'));
            return \$this->successResponse(new {$name}Resource(\$item), '{$name} updated successfully');
        } catch (Exception \$e) {
            return \$this->errorResponse(\$e->getMessage(), 500);
        }
    }

    public function destroy(\$id) {
        try {
            \$this->service->delete(\$id);
            return \$this->successResponse(null, '{$name} deleted successfully');
        } catch (Exception \$e) {
            return \$this->errorResponse('Failed to delete {$name}', 500);
        }
    }
}";
    file_put_contents(__DIR__ . "/app/Http/Controllers/Api/Admin/{$name}Controller.php", $controllerCode);
}

echo "All Admin API Controllers, Services, Requests, and Resources generated!\n";
