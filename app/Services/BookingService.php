<?php

namespace App\Services;

use App\Models\Booking;

class BookingService
{
    public function getAll($status = null, $userId = null, $dateFrom = null, $perPage = 10, $dateTo = null, $search = null)
    {
        $query = Booking::with(['user', 'lapangan', 'bookingDetails.slotWaktu', 'payment'])
            ->filterStatus($status)
            ->filterUser($userId)
            ->when($dateFrom, fn($q) => $q->whereDate('tanggal_booking', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('tanggal_booking', '<=', $dateTo))
            ->search($search);

        if (auth()->check() && auth()->user()->role === 'pemilik') {
            $pemilikId = auth()->id();
            $query->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        $slotWaktuIds = $data['slot_waktu'] ?? [];
        unset($data['slot_waktu']);

        $booking = Booking::create($data);
        
        $lapangan = \App\Models\Lapangan::find($data['lapangan_id']);
        $harga = $lapangan ? $lapangan->harga : 0;

        foreach ($slotWaktuIds as $slotId) {
            \App\Models\BookingDetail::create([
                'booking_id' => $booking->id,
                'slot_waktu_id' => $slotId,
                'harga' => $harga,
                'status' => $data['status']
            ]);
        }

        // Auto create payment as 'pending' for admin created bookings
        \App\Models\Payment::create([
            'booking_id' => $booking->id,
            'amount' => $data['total_harga'],
            'payment_method' => 'manual',
            'status' => 'pending',
            'payment_date' => now()
        ]);

        return $booking->load(['user', 'lapangan', 'payment']);
    }

    public function getById($id)
    {
        return Booking::with(['user', 'lapangan', 'bookingDetails.slotWaktu', 'payment'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = Booking::findOrFail($id);
        
        $slotWaktuIds = $data['slot_waktu'] ?? [];
        unset($data['slot_waktu']);

        $item->update($data);

        // Sync slots: Delete existing and recreate
        $item->bookingDetails()->delete();

        $lapangan = \App\Models\Lapangan::find($item->lapangan_id);
        $harga = $lapangan ? $lapangan->harga : 0;

        foreach ($slotWaktuIds as $slotId) {
            \App\Models\BookingDetail::create([
                'booking_id' => $item->id,
                'slot_waktu_id' => $slotId,
                'harga' => $harga,
                'status' => $data['status']
            ]);
        }

        // Also update payment amount and status if needed
        if ($item->payment) {
            $paymentStatus = $data['status'] == 'completed' || $data['status'] == 'confirmed' ? 'success' : 
                             ($data['status'] == 'cancelled' ? 'failed' : 'pending');
            $item->payment->update([
                'amount' => $data['total_harga'],
                'status' => $paymentStatus
            ]);
        } else {
             \App\Models\Payment::create([
                'booking_id' => $item->id,
                'amount' => $data['total_harga'],
                'payment_method' => 'manual',
                'status' => 'pending',
                'payment_date' => now()
            ]);
        }

        // Also update details status
        $item->bookingDetails()->update(['status' => $data['status']]);

        return $item->fresh()->load(['user', 'lapangan', 'payment']);
    }

    public function delete($id)
    {
        $item = Booking::findOrFail($id);
        $item->delete();
        return true;
    }
}