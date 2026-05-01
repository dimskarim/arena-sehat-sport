<?php

namespace App\Services;

use App\Models\OprationalWaktu;

class OprationalWaktuService
{
    public function getAll($lapanganId = null, $perPage = 10)
    {
        $query = OprationalWaktu::with('lapangan');

        if ($lapanganId) {
            $query->where('lapangan_id', $lapanganId);
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return OprationalWaktu::create($data);
    }

    public function getById($id)
    {
        return OprationalWaktu::with('lapangan')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = OprationalWaktu::findOrFail($id);
        $item->update($data);
        return $item->fresh();
    }

    public function delete($id)
    {
        $item = OprationalWaktu::findOrFail($id);
        $item->delete();
        return true;
    }
}