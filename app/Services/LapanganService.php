<?php

namespace App\Services;

use App\Models\Lapangan;
use App\Models\GambarLapangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class LapanganService
{
    public function getAllLapangans($search = null, $kategori_id = null, $status = null, $perPage = 10)
    {
        return Lapangan::with(['kategori', 'gambarLapangans'])
            ->search($search)
            ->filterKategori($kategori_id)
            ->when($status, fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate($perPage);
    }

    public function createLapangan(array $data, $gambarFile = null)
    {
        DB::beginTransaction();
        try {
            $lapangan = Lapangan::create($data);

            // File Upload logic
            if ($gambarFile) {
                $path = $gambarFile->store('public/lapangans');
                GambarLapangan::create([
                    'lapangan_id' => $lapangan->id,
                    'gambar_file' => Storage::url($path)
                ]);
            }

            DB::commit();
            return $lapangan->load(['kategori', 'gambarLapangans']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getLapanganById($id)
    {
        return Lapangan::with(['kategori', 'gambarLapangans'])->findOrFail($id);
    }

    public function updateLapangan($id, array $data, $gambarFile = null)
    {
        $lapangan = Lapangan::findOrFail($id);
        
        if (isset($data['gambar'])) {
            unset($data['gambar']);
        }

        $lapangan->update($data);

        if ($gambarFile) {
            foreach ($lapangan->gambarLapangans as $gambar) {
                $path = str_replace('/storage', 'public', $gambar->gambar_file);
                Storage::delete($path);
                $gambar->delete();
            }

            $path = $gambarFile->store('public/lapangans');
            GambarLapangan::create([
                'lapangan_id' => $lapangan->id,
                'gambar_file' => Storage::url($path)
            ]);
        }

        return $lapangan->fresh()->load(['kategori', 'gambarLapangans']);
    }

    public function deleteLapangan($id)
    {
        $lapangan = Lapangan::with('gambarLapangans')->findOrFail($id);

        // Delete associated images from storage
        foreach ($lapangan->gambarLapangans as $gambar) {
            $path = str_replace('/storage', 'public', $gambar->gambar_file);
            Storage::delete($path);
        }

        $lapangan->delete();
        return true;
    }
}