<?php

namespace App\Services;

use App\Models\Booking;

class BookingService
{
    public function getAll($status = null, $userId = null, $date = null, $perPage = 10)
    {
        return Booking::with(['user', 'lapangan', 'detailsBookings.slotWaktu', 'payment'])
            ->filterStatus($status)
            ->filterUser($userId)
            ->filterDate($date)
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
        return Booking::with(['user', 'lapangan', 'detailsBookings.slotWaktu', 'payment'])->findOrFail($id);
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