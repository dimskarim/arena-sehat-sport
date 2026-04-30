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

    public function __construct(OprationalWaktuService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        try {
            $items = $this->service->getAll($request->query('per_page', 10));
            return OprationalWaktuResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(OprationalWaktuRequest $request) {
        try {
            $item = $this->service->create($request->validated(), $request->file('dummy'));
            return $this->successResponse(new OprationalWaktuResource($item), 'OprationalWaktu created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new OprationalWaktuResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('OprationalWaktu not found', 404);
        }
    }

    public function update(OprationalWaktuRequest $request, $id) {
        try {
            $item = $this->service->update($id, $request->validated(), $request->file('dummy'));
            return $this->successResponse(new OprationalWaktuResource($item), 'OprationalWaktu updated successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'OprationalWaktu deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse('Failed to delete OprationalWaktu', 500);
        }
    }
}