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
        $query = Lapangan::with(['kategori', 'gambarLapangans'])
            ->withCount(['bookings' => function($q) {
                $q->whereNotIn('status', ['cancelled', 'canceled', 'failed']);
            }])
            ->search($search)
            ->filterKategori($kategori_id)
            ->when($status, fn($q) => $q->where('status', $status));

        if (auth()->check() && auth()->user()->role === 'pemilik') {
            $query->where('pemilik_id', auth()->id());
        }

        return $query->latest()->paginate($perPage);
    }

    public function createLapangan(array $data, $gambarFile = null)
    {
        DB::beginTransaction();
        try {
            $fasilitasIds = $data['fasilitas'] ?? [];
            unset($data['fasilitas']);

            if (auth()->check() && auth()->user()->role === 'pemilik') {
                $data['pemilik_id'] = auth()->id();
            }

            $lapangan = Lapangan::create($data);

            if (!empty($fasilitasIds)) {
                $lapangan->fasilitas()->sync($fasilitasIds);
            }

            // File Upload logic
            if ($gambarFile) {
                $files = is_array($gambarFile) ? $gambarFile : [$gambarFile];
                foreach ($files as $file) {
                    $path = $file->store('public/lapangans');
                    GambarLapangan::create([
                        'lapangan_id' => $lapangan->id,
                        'gambar_file' => Storage::url($path)
                    ]);
                }
            }

            DB::commit();
            return $lapangan->load(['kategori', 'gambarLapangans', 'fasilitas']);
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

        $fasilitasIds = $data['fasilitas'] ?? [];
        if (isset($data['fasilitas'])) {
            unset($data['fasilitas']);
        }

        if (auth()->check() && auth()->user()->role === 'pemilik') {
            unset($data['pemilik_id']);
        }

        $lapangan->update($data);
        $lapangan->fasilitas()->sync($fasilitasIds);

        if ($gambarFile) {
            foreach ($lapangan->gambarLapangans as $gambar) {
                $path = str_replace('/storage', 'public', $gambar->gambar_file);
                Storage::delete($path);
                $gambar->delete();
            }

            $files = is_array($gambarFile) ? $gambarFile : [$gambarFile];
            foreach ($files as $file) {
                $path = $file->store('public/lapangans');
                GambarLapangan::create([
                    'lapangan_id' => $lapangan->id,
                    'gambar_file' => Storage::url($path)
                ]);
            }
        }

        return $lapangan->fresh()->load(['kategori', 'gambarLapangans', 'fasilitas']);
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