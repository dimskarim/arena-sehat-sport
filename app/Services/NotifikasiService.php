<?php

namespace App\Services;

use App\Models\Notifikasi;

class NotifikasiService
{
    public function getAll($userId = null, $perPage = 10)
    {
        return Notifikasi::with(['user', 'detailsBooking.booking'])
            ->filterUser($userId)
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data)
    {
        $notifikasi = Notifikasi::create($data);
        return $notifikasi->load(['user', 'detailsBooking']);
    }

    public function getById($id)
    {
        return Notifikasi::with(['user', 'detailsBooking.booking'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = Notifikasi::findOrFail($id);
        $item->update($data);
        return $item->fresh()->load(['user', 'detailsBooking']);
    }

    public function delete($id)
    {
        $item = Notifikasi::findOrFail($id);
        $item->delete();
        return true;
    }
}
