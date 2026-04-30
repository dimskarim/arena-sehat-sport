<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\GambarLapanganService;
use App\Http\Requests\Admin\GambarLapanganRequest;
use App\Http\Resources\GambarLapanganResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class GambarLapanganController extends Controller
{
    use ApiResponse;
    
    protected $service;

    public function __construct(GambarLapanganService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        try {
            $items = $this->service->getAll($request->query('per_page', 10));
            return GambarLapanganResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(GambarLapanganRequest $request) {
        try {
            $item = $this->service->create($request->validated(), $request->file('gambar_file'));
            return $this->successResponse(new GambarLapanganResource($item), 'GambarLapangan created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new GambarLapanganResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('GambarLapangan not found', 404);
        }
    }

    public function update(GambarLapanganRequest $request, $id) {
        try {
            $item = $this->service->update($id, $request->validated(), $request->file('gambar_file'));
            return $this->successResponse(new GambarLapanganResource($item), 'GambarLapangan updated successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'GambarLapangan deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse('Failed to delete GambarLapangan', 500);
        }
    }
}