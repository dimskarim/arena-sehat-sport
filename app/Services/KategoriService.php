<?php

namespace App\Services;

use App\Models\Kategori;

class KategoriService
{
    public function getAll($search = null, $perPage = 10)
    {
        $query = Kategori::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return Kategori::create($data);
    }

    public function getById($id)
    {
        return Kategori::with(['lapangans'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = Kategori::findOrFail($id);
        $item->update($data);
        return $item->fresh();
    }

    public function delete($id)
    {
        $item = Kategori::findOrFail($id);
        $item->delete();
        return true;
    }
}