<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SlotWaktuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'waktu_operasional_id' => 'required|exists:waktu_operasionals,id',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ];
    }

    public function messages()
    {
        return [
            'waktu_operasional_id.required' => 'Hari Operasional Lapangan wajib dipilih',
            'waktu_operasional_id.exists' => 'Hari Operasional tidak valid',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi',
            'waktu_mulai.date_format' => 'Format waktu mulai harus HH:mm',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi',
            'waktu_selesai.date_format' => 'Format waktu selesai harus HH:mm',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai',
        ];
    }
}