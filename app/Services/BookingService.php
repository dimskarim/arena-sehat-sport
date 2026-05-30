<?php

namespace App\Services;

use App\Models\Booking;

class BookingService
{
    public function getAll($status = null, $userId = null, $dateFrom = null, $perPage = 10, $dateTo = null)
    {
        return Booking::with(['user', 'lapangan', 'bookingDetails.slotWaktu', 'payment'])
            ->filterStatus($status)
            ->filterUser($userId)
            ->filterDate($dateFrom)
            ->when($dateTo, fn($q) => $q->whereDate('tanggal_booking', '<=', $dateTo))
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data)
    {
        $booking = Booking::create($data);
        return $booking->load(['user', 'lapangan', 'payment']);
    }

    public function getById($id)
    {
        return Booking::with(['user', 'lapangan', 'bookingDetails.slotWaktu', 'payment'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = Booking::findOrFail($id);
        $item->update($data);
        return $item->fresh()->load(['user', 'lapangan', 'payment']);
    }

    public function delete($id)
    {
        $item = Booking::findOrFail($id);
        $item->delete();
        return true;
    }
}