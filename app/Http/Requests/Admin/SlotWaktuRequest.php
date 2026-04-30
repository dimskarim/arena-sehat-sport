<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class SlotWaktuRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'lapangan_id' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'
        ];
    }
}