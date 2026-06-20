<?php

namespace App\Services;

use App\Models\Notifikasi;

class NotifikasiService
{
    public function getAll($userId = null, $perPage = 10)
    {
        $query = Notifikasi::with(['user', 'booking'])
            ->filterUser($userId)
            ->latest();

        if (auth()->check() && auth()->user()->role === 'pemilik') {
            $pemilikId = auth()->id();
            $query->where(function ($q) use ($pemilikId) {
                $q->whereHas('booking.lapangan', function ($q2) use ($pemilikId) {
                    $q2->where('pemilik_id', $pemilikId);
                })->orWhere('user_id', $pemilikId);
            });
        }

        return $query->paginate($perPage);
    }

    public function create(array $data)
    {
        $notifikasi = Notifikasi::create($data);
        return $notifikasi->load(['user', 'booking']);
    }

    public function getById($id)
    {
        return Notifikasi::with(['user', 'booking'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = Notifikasi::findOrFail($id);
        $item->update($data);
        return $item->fresh()->load(['user', 'booking']);
    }

    public function delete($id)
    {
        $item = Notifikasi::findOrFail($id);
        $item->delete();
        return true;
    }
}
