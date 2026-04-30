<?php
namespace App\Services;
use App\Models\Kategori;

class KategoriService {
    public function getAll($perPage = 10) {
        return Kategori::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        
        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        return Kategori::create($data);
    }
    public function getById($id) {
        return Kategori::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        $item = Kategori::findOrFail($id);
        
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $item->update($data);
        return $item;
    }
    public function delete($id) {
        $item = Kategori::findOrFail($id);
        $item->delete();
        return true;
    }
}