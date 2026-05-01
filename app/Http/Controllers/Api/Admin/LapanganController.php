<?php

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

    protected $lapanganService;

    public function __construct(LapanganService $lapanganService)
    {
        $this->lapanganService = $lapanganService;
    }

    public function index(Request $request)
    {
        try {
            $lapangans = $this->lapanganService->getAllLapangans(
                $request->query('search'),
                $request->query('kategori_id'),
                $request->query('status'),
                $request->query('per_page', 10)
            );
            return LapanganResource::collection($lapangans)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(LapanganRequest $request)
    {
        try {
            $lapangan = $this->lapanganService->createLapangan($request->validated(), $request->file('gambar'));
            return $this->successResponse(new LapanganResource($lapangan), 'Lapangan berhasil ditambahkan', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $lapangan = $this->lapanganService->getLapanganById($id);
            return $this->successResponse(new LapanganResource($lapangan));
        } catch (Exception $e) {
            return $this->errorResponse('Lapangan tidak ditemukan', 404);
        }
    }

    public function update(LapanganRequest $request, $id)
    {
        try {
            $lapangan = $this->lapanganService->updateLapangan($id, $request->validated());
            return $this->successResponse(new LapanganResource($lapangan), 'Lapangan berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->lapanganService->deleteLapangan($id);
            return $this->successResponse(null, 'Lapangan berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus Lapangan', 500);
        }
    }
}