<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class PaymentService
{
    public function getAll($status = null, $bookingId = null, $perPage = 10)
    {
        return Payment::with(['booking.user', 'booking.lapangan'])
            ->filterStatus($status)
            ->filterBooking($bookingId)
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data, $file = null)
    {
        if ($file) {
            $path = $file->store('public/payments');
            $data['butki_payment'] = Storage::url($path);
        }

        $payment = Payment::create($data);
        return $payment->load(['booking.user', 'booking.lapangan']);
    }

    public function getById($id)
    {
        return Payment::with(['booking.user', 'booking.lapangan'])->findOrFail($id);
    }

    public function update($id, array $data, $file = null)
    {
        $item = Payment::findOrFail($id);

        if ($file) {
            // Delete old file
            if ($item->butki_payment) {
                $oldPath = str_replace('/storage', 'public', $item->butki_payment);
                Storage::delete($oldPath);
            }
            $path = $file->store('public/payments');
            $data['butki_payment'] = Storage::url($path);
        }

        $item->update($data);
        return $item->fresh()->load(['booking.user', 'booking.lapangan']);
    }

    public function delete($id)
    {
        $item = Payment::findOrFail($id);

        // Delete file from storage
        if ($item->butki_payment) {
            $path = str_replace('/storage', 'public', $item->butki_payment);
            Storage::delete($path);
        }

        $item->delete();
        return true;
    }
}