<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\OprationalWaktuService;
use App\Http\Requests\Admin\OprationalWaktuRequest;
use App\Http\Resources\OprationalWaktuResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class OprationalWaktuController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(OprationalWaktuService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $items = $this->service->getAll(
                $request->query('lapangan_id'),
                $request->query('per_page', 10)
            );
            return OprationalWaktuResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(OprationalWaktuRequest $request)
    {
        try {
            $item = $this->service->create($request->validated());
            return $this->successResponse(new OprationalWaktuResource($item), 'Jam operasional berhasil ditambahkan', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new OprationalWaktuResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Jam operasional tidak ditemukan', 404);
        }
    }

    public function update(OprationalWaktuRequest $request, $id)
    {
        try {
            $item = $this->service->update($id, $request->validated());
            return $this->successResponse(new OprationalWaktuResource($item), 'Jam operasional berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'Jam operasional berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus jam operasional', 500);
        }
    }
}