<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
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

    /**
     * Get all bookings for current user (history booking)
     */
    public function index(Request $request)
    {
        try {
            $items = $this->service->getAll(
                $request->query('status'),
                $request->user()->id,
                $request->query('date'),
                $request->query('per_page', 10)
            );
            return BookingResource::collection($items)->additional(['status' => 'Success']);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Create a new booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'total_harga' => 'required|integer|min:0',
        ], [
            'lapangan_id.required' => 'Lapangan wajib dipilih',
            'lapangan_id.exists' => 'Lapangan tidak ditemukan',
            'tanggal_booking.required' => 'Tanggal booking wajib diisi',
            'tanggal_booking.after_or_equal' => 'Tanggal booking tidak boleh di masa lalu',
            'total_harga.required' => 'Total harga wajib diisi',
        ]);

        try {
            $data = $request->only(['lapangan_id', 'tanggal_booking', 'total_harga']);
            $data['user_id'] = $request->user()->id;
            $data['status'] = 'pending';

            $item = $this->service->create($data);
            return $this->successResponse(new BookingResource($item), 'Booking berhasil dibuat', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Show booking detail (only own booking)
     */
    public function show(Request $request, $id)
    {
        try {
            $item = $this->service->getById($id);

            if ($item->user_id !== $request->user()->id) {
                return $this->errorResponse('Anda tidak memiliki akses ke booking ini', 403);
            }

            return $this->successResponse(new BookingResource($item));
        } catch (Exception $e) {
            return $this->errorResponse('Booking tidak ditemukan', 404);
        }
    }
}
