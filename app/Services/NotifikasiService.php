<?php

namespace App\Services;

use App\Models\Notifikasi;

class NotifikasiService
{
    public function getAll($userId = null, $perPage = 10)
    {
        return Notifikasi::with(['user', 'booking'])
            ->filterUser($userId)
            ->latest()
            ->paginate($perPage);
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
