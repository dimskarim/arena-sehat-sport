<?php
namespace App\Services;
use App\Models\GambarLapangan;

class GambarLapanganService {
    public function getAll($perPage = 10) {
        return GambarLapangan::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        
            if ($file) {
                $data['gambar_file'] = \Illuminate\Support\Facades\Storage::url($file->store('public/lapangans'));
            }
        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        return GambarLapangan::create($data);
    }
    public function getById($id) {
        return GambarLapangan::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        $item = GambarLapangan::findOrFail($id);
        
            if ($file) {
                $data['gambar_file'] = \Illuminate\Support\Facades\Storage::url($file->store('public/lapangans'));
            }
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $item->update($data);
        return $item;
    }
    public function delete($id) {
        $item = GambarLapangan::findOrFail($id);
        $item->delete();
        return true;
    }
}