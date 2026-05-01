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

    public function __construct(KategoriService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $items = $this->service->getAll(
                $request->query('search'),
                $request->query('per_page', 10)
            );
            return KategoriResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(KategoriRequest $request)
    {
        try {
            $item = $this->service->create($request->validated());
            return $this->successResponse(new KategoriResource($item), 'Kategori berhasil ditambahkan', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new KategoriResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Kategori tidak ditemukan', 404);
        }
    }

    public function update(KategoriRequest $request, $id)
    {
        try {
            $item = $this->service->update($id, $request->validated());
            return $this->successResponse(new KategoriResource($item), 'Kategori berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'Kategori berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus Kategori', 500);
        }
    }
}