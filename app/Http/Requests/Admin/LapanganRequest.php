<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class LapanganRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,tidak tersedia',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}