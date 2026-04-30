<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class OprationalWaktuRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'lapangan_id' => 'required',
            'waktu_buka' => 'required',
            'waktu_tutup' => 'required'
        ];
    }
}