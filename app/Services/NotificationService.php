<?php
namespace App\Services;
use App\Models\Notification; // Assuming this model exists or will be created

class NotificationService {
    public function getAll($perPage = 10) {
        if (!class_exists(Notification::class)) return collect([]); // Dummy return if model doesn't exist yet
        return Notification::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        if (!class_exists(Notification::class)) return null;
        return Notification::create($data);
    }
    public function getById($id) {
        if (!class_exists(Notification::class)) throw new \Exception('Notification not found');
        return Notification::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        if (!class_exists(Notification::class)) throw new \Exception('Notification not found');
        $item = Notification::findOrFail($id);
        $item->update($data);
        return $item;
    }
    public function delete($id) {
        if (!class_exists(Notification::class)) throw new \Exception('Notification not found');
        $item = Notification::findOrFail($id);
        $item->delete();
        return true;
    }
}
