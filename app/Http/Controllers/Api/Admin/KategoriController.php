<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\KategoriService;
use App\Http\Requests\Admin\KategoriRequest;
use App\Http\Resources\KategoriResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class KategoriController extends Controller
{
    use ApiResponse;
    
    protected $service;

    public function __construct(KategoriService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        try {
            $items = $this->service->getAll($request->query('per_page', 10));
            return KategoriResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(KategoriRequest $request) {
        try {
            $item = $this->service->create($request->validated(), $request->file('dummy'));
            return $this->successResponse(new KategoriResource($item), 'Kategori created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new KategoriResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Kategori not found', 404);
        }
    }

    public function update(KategoriRequest $request, $id) {
        try {
            $item = $this->service->update($id, $request->validated(), $request->file('dummy'));
            return $this->successResponse(new KategoriResource($item), 'Kategori updated successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'Kategori deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse('Failed to delete Kategori', 500);
        }
    }
}