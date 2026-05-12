<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $items = $this->service->getAll(
                $request->query('search'),
                $request->query('role'),
                $request->query('per_page', 10)
            );
            return UserResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $item = $this->service->create($request->validated(), $request->file('foto_profile'));
            return $this->successResponse(new UserResource($item), 'User berhasil ditambahkan', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new UserResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('User tidak ditemukan', 404);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $item = $this->service->update($id, $request->validated(), $request->file('foto_profile'));
            return $this->successResponse(new UserResource($item), 'User berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'User berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus User', 500);
        }
    }
}