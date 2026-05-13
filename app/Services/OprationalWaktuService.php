<?php

namespace App\Services;

use App\Models\WaktuOperasional;

class OprationalWaktuService
{
    public function getAll($lapanganId = null, $perPage = 10)
    {
        $query = WaktuOperasional::with('lapangan');

        if ($lapanganId) {
            $query->where('lapangan_id', $lapanganId);
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return WaktuOperasional::create($data);
    }

    public function getById($id)
    {
        return WaktuOperasional::with('lapangan')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = WaktuOperasional::findOrFail($id);
        $item->update($data);
        return $item->fresh();
    }

    public function delete($id)
    {
        $item = WaktuOperasional::findOrFail($id);
        $item->delete();
        return true;
    }
}