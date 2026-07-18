<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OprationalWaktuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('oprational_waktu');

        return [
            'lapangan_id' => 'required|exists:lapangans,id',
            'hari' => [
                'required',
                'string',
                'max:20',
                \Illuminate\Validation\Rule::unique('waktu_operasionals')->where(function ($query) {
                    return $query->where('lapangan_id', $this->lapangan_id);
                })->ignore($id)
            ],
            'waktu_buka' => 'required|date_format:H:i',
            'waktu_tutup' => 'required|date_format:H:i|after:waktu_buka',
        ];
    }

    public function messages()
    {
        return [
            'lapangan_id.required' => 'Lapangan wajib dipilih',
            'lapangan_id.exists' => 'Lapangan tidak ditemukan',
            'hari.required' => 'Hari wajib diisi',
            'hari.unique' => 'Hari ini sudah ada untuk lapangan yang dipilih.',
            'waktu_buka.required' => 'Waktu buka wajib diisi',
            'waktu_buka.date_format' => 'Format waktu buka harus HH:mm',
            'waktu_tutup.required' => 'Waktu tutup wajib diisi',
            'waktu_tutup.date_format' => 'Format waktu tutup harus HH:mm',
            'waktu_tutup.after' => 'Waktu tutup harus setelah waktu buka',
        ];
    }
}