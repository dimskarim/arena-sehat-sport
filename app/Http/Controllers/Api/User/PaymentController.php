<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Http\Resources\PaymentResource;
use App\Models\Booking;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Exception;

class PaymentController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    /**
     * Get all payments for current user
     */
    public function index(Request $request)
    {
        try {
            $userBookingIds = Booking::where('user_id', $request->user()->id)->pluck('id');

            $items = \App\Models\Payment::with(['booking.user', 'booking.lapangan'])
                ->whereIn('booking_id', $userBookingIds)
                ->latest()
                ->paginate($request->query('per_page', 10));

            return PaymentResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Create a payment for a booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string|max:100',
            'butki_payment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'booking_id.required' => 'Booking wajib dipilih',
            'booking_id.exists' => 'Booking tidak ditemukan',
            'payment_method.required' => 'Metode pembayaran wajib diisi',
        ]);

        try {
            // Verify the booking belongs to the user
            $booking = Booking::findOrFail($request->booking_id);
            if ($booking->user_id !== $request->user()->id) {
                return $this->errorResponse('Anda tidak memiliki akses ke booking ini', 403);
            }

            $data = $request->only(['booking_id', 'payment_method']);
            $data['tanggal_payment'] = now();
            $data['status'] = 'pending';

            $item = $this->service->create($data, $request->file('butki_payment'));
            return $this->successResponse(new PaymentResource($item), 'Pembayaran berhasil dibuat', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Show payment detail
     */
    public function show(Request $request, $id)
    {
        try {
            $item = $this->service->getById($id);

            if ($item->booking->user_id !== $request->user()->id) {
                return $this->errorResponse('Anda tidak memiliki akses ke pembayaran ini', 403);
            }

            return $this->successResponse(new PaymentResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Pembayaran tidak ditemukan', 404);
        }
    }
}
