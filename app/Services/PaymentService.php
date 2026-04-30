<?php
namespace App\Services;
use App\Models\Payment;

class PaymentService {
    public function getAll($perPage = 10) {
        return Payment::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        
            if ($file) {
                $data['butki_payment'] = \Illuminate\Support\Facades\Storage::url($file->store('public/payments'));
            }
        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        return Payment::create($data);
    }
    public function getById($id) {
        return Payment::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        $item = Payment::findOrFail($id);
        
            if ($file) {
                $data['butki_payment'] = \Illuminate\Support\Facades\Storage::url($file->store('public/payments'));
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
        $item = Payment::findOrFail($id);
        $item->delete();
        return true;
    }
}