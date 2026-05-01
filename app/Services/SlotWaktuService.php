<?php

namespace App\Services;

use App\Models\SlotWaktu;

class SlotWaktuService
{
    public function getAll($lapanganId = null, $perPage = 10)
    {
        $query = SlotWaktu::with('lapangan');

        if ($lapanganId) {
            $query->where('lapangan_id', $lapanganId);
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return SlotWaktu::create($data);
    }

    public function getById($id)
    {
        return SlotWaktu::with('lapangan')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = SlotWaktu::findOrFail($id);
        $item->update($data);
        return $item->fresh();
    }

    public function delete($id)
    {
        $item = SlotWaktu::findOrFail($id);
        $item->delete();
        return true;
    }
}