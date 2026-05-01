<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotifikasiService;
use App\Http\Requests\Admin\NotifikasiRequest;
use App\Http\Resources\NotifikasiResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class NotifikasiController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(NotifikasiService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $items = $this->service->getAll(
                $request->query('user_id'),
                $request->query('per_page', 10)
            );
            return NotifikasiResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(NotifikasiRequest $request)
    {
        try {
            $item = $this->service->create($request->validated());
            return $this->successResponse(new NotifikasiResource($item), 'Notifikasi berhasil ditambahkan', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new NotifikasiResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Notifikasi tidak ditemukan', 404);
        }
    }

    public function update(NotifikasiRequest $request, $id)
    {
        try {
            $item = $this->service->update($id, $request->validated());
            return $this->successResponse(new NotifikasiResource($item), 'Notifikasi berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'Notifikasi berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus Notifikasi', 500);
        }
    }
}
