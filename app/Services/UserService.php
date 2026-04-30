<?php
namespace App\Services;
use App\Models\User;

class UserService {
    public function getAll($perPage = 10) {
        return User::paginate($perPage);
    }
    public function create(array $data, $file = null) {
        
            if ($file) {
                $data['foto_profile'] = \Illuminate\Support\Facades\Storage::url($file->store('public/users'));
            }
        if (isset($data['password'])) $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }
    public function getById($id) {
        return User::findOrFail($id);
    }
    public function update($id, array $data, $file = null) {
        $item = User::findOrFail($id);
        
            if ($file) {
                $data['foto_profile'] = \Illuminate\Support\Facades\Storage::url($file->store('public/users'));
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
        $item = User::findOrFail($id);
        $item->delete();
        return true;
    }
}