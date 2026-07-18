<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LapanganRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'pemilik_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:30',
            'deskripsi' => 'nullable|string|max:100',
            'harga' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,nonaktif',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id',
        ];
    }

    public function messages()
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak ditemukan',
            'name.required' => 'Nama lapangan wajib diisi',
            'name.max' => 'Nama lapangan maksimal 30 karakter',
            'deskripsi.max' => 'Deskripsi lapangan maksimal 100 karakter',
            'harga.required' => 'Harga wajib diisi',
            'harga.integer' => 'Harga harus berupa angka',
            'harga.min' => 'Harga tidak boleh negatif',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status harus tersedia atau nonaktif',
            'gambar.array' => 'Format gambar tidak valid',
            'gambar.*.image' => 'File harus berupa gambar',
            'gambar.*.max' => 'Ukuran file maksimal 2MB',
            'fasilitas.array' => 'Format fasilitas tidak valid',
            'fasilitas.*.exists' => 'Fasilitas tidak ditemukan',
        ];
    }
}