<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\NotifikasiService;
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

    /**
     * Get all notifications for current user
     */
    public function index(Request $request)
    {
        try {
            $items = $this->service->getAll(
                $request->user()->id,
                $request->query('per_page', 10)
            );
            return NotifikasiResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Show notification detail (only own notification)
     */
    public function show(Request $request, $id)
    {
        try {
            $item = $this->service->getById($id);

            if ($item->user_id !== $request->user()->id) {
                return $this->errorResponse('Anda tidak memiliki akses ke notifikasi ini', 403);
            }

            return $this->successResponse(new NotifikasiResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Notifikasi tidak ditemukan', 404);
        }
    }
}
