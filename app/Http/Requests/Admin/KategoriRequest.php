<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('kategori') ?? $this->route('id') ?? $this->segment(3);
        
        return [
            'name' => 'required|string|max:20|regex:/^[a-zA-Z0-9\s\-]+$/|unique:kategoris,name,' . $id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kategori wajib diisi',
            'name.max' => 'Maksimal 20 huruf',
            'name.regex' => 'Format penulisan salah',
            'name.unique' => 'Nama kategori sudah ada',
            'logo.image' => 'Logo harus berupa gambar',
            'logo.mimes' => 'Format logo harus jpeg, png, jpg, atau webp',
            'logo.max' => 'Ukuran logo maksimal 2MB',
        ];
    }
}