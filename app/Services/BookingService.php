<?php
namespace App\Services;
use App\Models\Booking;

class BookingService {
    public function getAll($perPage = 10) {
        return Booking::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        
        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        return Booking::create($data);
    }
    public function getById($id) {
        return Booking::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        $item = Booking::findOrFail($id);
        
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $item->update($data);
        return $item;
    }
    public function delete($id) {
        $item = Booking::findOrFail($id);
        $item->delete();
        return true;
    }
}