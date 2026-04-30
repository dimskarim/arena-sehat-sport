<?php
namespace App\Services;
use App\Models\Lapangan;
use App\Models\GambarLapangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class LapanganService {
    public function getAllLapangans($search, $kategori_id, $perPage = 10) {
        return Lapangan::with(['kategori', 'gambarLapangans'])
            ->search($search)
            ->filterKategori($kategori_id)
            ->paginate($perPage);
    }

    public function createLapangan(array $data, $gambarFile = null) {
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
            return $lapangan;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getLapanganById($id) {
        return Lapangan::with(['kategori', 'gambarLapangans', 'slotWaktus', 'oprationalWaktus'])->findOrFail($id);
    }

    public function updateLapangan($id, array $data) {
        $lapangan = Lapangan::findOrFail($id);
        $lapangan->update($data);
        return $lapangan;
    }

    public function deleteLapangan($id) {
        $lapangan = Lapangan::findOrFail($id);
        $lapangan->delete();
        return true;
    }
}