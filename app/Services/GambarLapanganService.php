<?php

namespace App\Services;

use App\Models\GambarLapangan;
use Illuminate\Support\Facades\Storage;

class GambarLapanganService
{
    public function getAll($lapanganId = null, $perPage = 10)
    {
        $query = GambarLapangan::with('lapangan');

        if ($lapanganId) {
            $query->where('lapangan_id', $lapanganId);
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data, $file = null)
    {
        if ($file) {
            $path = $file->store('public/lapangans');
            $data['gambar_file'] = Storage::url($path);
        }

        return GambarLapangan::create($data);
    }

    public function getById($id)
    {
        return GambarLapangan::with('lapangan')->findOrFail($id);
    }

    public function update($id, array $data, $file = null)
    {
        $item = GambarLapangan::findOrFail($id);

        if ($file) {
            // Delete old file
            if ($item->gambar_file) {
                $oldPath = str_replace('/storage', 'public', $item->gambar_file);
                Storage::delete($oldPath);
            }
            $path = $file->store('public/lapangans');
            $data['gambar_file'] = Storage::url($path);
        }

        $item->update($data);
        return $item->fresh();
    }

    public function delete($id)
    {
        $item = GambarLapangan::findOrFail($id);

        // Delete file from storage
        if ($item->gambar_file) {
            $path = str_replace('/storage', 'public', $item->gambar_file);
            Storage::delete($path);
        }

        $item->delete();
        return true;
    }
}