<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\SlotWaktuService;
use App\Http\Requests\Admin\SlotWaktuRequest;
use App\Http\Resources\SlotWaktuResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class SlotWaktuController extends Controller
{
    use ApiResponse;
    
    protected $service;

    public function __construct(SlotWaktuService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        try {
            $items = $this->service->getAll($request->query('per_page', 10));
            return SlotWaktuResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(SlotWaktuRequest $request) {
        try {
            $item = $this->service->create($request->validated(), $request->file('dummy'));
            return $this->successResponse(new SlotWaktuResource($item), 'SlotWaktu created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new SlotWaktuResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('SlotWaktu not found', 404);
        }
    }

    public function update(SlotWaktuRequest $request, $id) {
        try {
            $item = $this->service->update($id, $request->validated(), $request->file('dummy'));
            return $this->successResponse(new SlotWaktuResource($item), 'SlotWaktu updated successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'SlotWaktu deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse('Failed to delete SlotWaktu', 500);
        }
    }
}