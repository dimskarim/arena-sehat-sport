<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Http\Requests\Admin\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class BookingController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $items = $this->service->getAll(
                $request->query('status'),
                $request->query('user_id'),
                $request->query('date'),
                $request->query('per_page', 10)
            );
            return BookingResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(BookingRequest $request)
    {
        try {
            $item = $this->service->create($request->validated());
            return $this->successResponse(new BookingResource($item), 'Booking berhasil ditambahkan', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new BookingResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Booking tidak ditemukan', 404);
        }
    }

    public function update(BookingRequest $request, $id)
    {
        try {
            $item = $this->service->update($id, $request->validated());
            return $this->successResponse(new BookingResource($item), 'Booking berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'Booking berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus Booking', 500);
        }
    }
}
