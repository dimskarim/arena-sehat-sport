<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Http\Requests\Admin\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class PaymentController extends Controller
{
    use ApiResponse;
    
    protected $service;

    public function __construct(PaymentService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        try {
            $items = $this->service->getAll($request->query('per_page', 10));
            return PaymentResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function store(PaymentRequest $request) {
        try {
            $item = $this->service->create($request->validated(), $request->file('butki_payment'));
            return $this->successResponse(new PaymentResource($item), 'Payment created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $item = $this->service->getById($id);
            return $this->successResponse(new PaymentResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Payment not found', 404);
        }
    }

    public function update(PaymentRequest $request, $id) {
        try {
            $item = $this->service->update($id, $request->validated(), $request->file('butki_payment'));
            return $this->successResponse(new PaymentResource($item), 'Payment updated successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'Payment deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse('Failed to delete Payment', 500);
        }
    }
}