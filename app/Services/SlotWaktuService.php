<?php
namespace App\Services;
use App\Models\SlotWaktu;

class SlotWaktuService {
    public function getAll($perPage = 10) {
        return SlotWaktu::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        
        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        return SlotWaktu::create($data);
    }
    public function getById($id) {
        return SlotWaktu::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        $item = SlotWaktu::findOrFail($id);
        
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $item->update($data);
        return $item;
    }
    public function delete($id) {
        $item = SlotWaktu::findOrFail($id);
        $item->delete();
        return true;
    }
}