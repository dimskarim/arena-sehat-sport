<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user');

        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^(08|628|\+628)[0-9]{7,11}$/'],
            'role' => 'required|in:admin,user,pemilik',
            'password' => $this->isMethod('POST') ? 'required|min:6' : 'nullable|min:6',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 50 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'phone.regex' => 'Nomor HP harus valid nomor Indonesia (diawali 08, 628, atau +628)',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Role harus admin, pengguna, atau pemilik',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'foto_profile.image' => 'File harus berupa gambar',
            'foto_profile.max' => 'Ukuran file maksimal 2MB',
        ];
    }
}