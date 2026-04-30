<?php
namespace App\Services;
use App\Models\OprationalWaktu;

class OprationalWaktuService {
    public function getAll($perPage = 10) {
        return OprationalWaktu::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        
        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        return OprationalWaktu::create($data);
    }
    public function getById($id) {
        return OprationalWaktu::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        $item = OprationalWaktu::findOrFail($id);
        
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $item->update($data);
        return $item;
    }
    public function delete($id) {
        $item = OprationalWaktu::findOrFail($id);
        $item->delete();
        return true;
    }
}