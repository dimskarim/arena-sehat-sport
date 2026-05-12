<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GambarLapanganRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lapangan_id' => 'required|exists:lapangans,id',
            'gambar_file' => $this->isMethod('POST') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'lapangan_id.required' => 'Lapangan wajib dipilih',
            'lapangan_id.exists' => 'Lapangan tidak ditemukan',
            'gambar_file.required' => 'Gambar wajib diunggah',
            'gambar_file.image' => 'File harus berupa gambar',
            'gambar_file.max' => 'Ukuran file maksimal 2MB',
        ];
    }
}