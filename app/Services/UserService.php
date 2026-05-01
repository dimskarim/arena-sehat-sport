<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAll($search = null, $role = null, $perPage = 10)
    {
        return User::search($search)
            ->filterRole($role)
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data, $file = null)
    {
        if ($file) {
            $path = $file->store('public/users');
            $data['foto_profile'] = Storage::url($path);
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return User::create($data);
    }

    public function getById($id)
    {
        return User::with(['bookings'])->findOrFail($id);
    }

    public function update($id, array $data, $file = null)
    {
        $user = User::findOrFail($id);

        if ($file) {
            // Delete old file if exists
            if ($user->foto_profile) {
                $oldPath = str_replace('/storage', 'public', $user->foto_profile);
                Storage::delete($oldPath);
            }
            $path = $file->store('public/users');
            $data['foto_profile'] = Storage::url($path);
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user->fresh();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // Delete photo if exists
        if ($user->foto_profile) {
            $oldPath = str_replace('/storage', 'public', $user->foto_profile);
            Storage::delete($oldPath);
        }

        $user->delete();
        return true;
    }
}