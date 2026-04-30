<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class GambarLapanganRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'lapangan_id' => 'required',
            'gambar_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ];
    }
}