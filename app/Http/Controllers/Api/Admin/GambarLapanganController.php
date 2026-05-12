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

    public function __construct(GambarLapanganService $service)
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
            return GambarLapanganResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(GambarLapanganRequest $request)
    {
        try {
            $item = $this->service->create($request->validated(), $request->file('gambar_file'));
            return $this->successResponse(new GambarLapanganResource($item), 'Foto lapangan berhasil ditambahkan', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new GambarLapanganResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Foto lapangan tidak ditemukan', 404);
        }
    }

    public function update(GambarLapanganRequest $request, $id)
    {
        try {
            $item = $this->service->update($id, $request->validated(), $request->file('gambar_file'));
            return $this->successResponse(new GambarLapanganResource($item), 'Foto lapangan berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'Foto lapangan berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus foto lapangan', 500);
        }
    }
}