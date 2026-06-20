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
        $id = $this->route('slot_waktu');

        return [
            'waktu_operasional_id' => 'required|exists:waktu_operasionals,id',
            'waktu_mulai' => [
                'required',
                'date_format:H:i',
                \Illuminate\Validation\Rule::unique('slot_waktus')->where(function ($query) {
                    return $query->where('waktu_operasional_id', $this->waktu_operasional_id);
                })->ignore($id)
            ],
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->waktu_operasional_id || !$this->waktu_mulai || !$this->waktu_selesai) return;

            $waktuOperasional = \App\Models\WaktuOperasional::find($this->waktu_operasional_id);
            if ($waktuOperasional) {
                $buka = substr($waktuOperasional->waktu_buka, 0, 5);
                $tutup = substr($waktuOperasional->waktu_tutup, 0, 5);
                
                if ($this->waktu_mulai < $buka || $this->waktu_mulai > $tutup) {
                    $validator->errors()->add('waktu_mulai', 'Waktu mulai harus dalam jam operasional (' . $buka . ' - ' . $tutup . ').');
                }
                if ($this->waktu_selesai > $tutup || $this->waktu_selesai < $buka) {
                    $validator->errors()->add('waktu_selesai', 'Waktu selesai tidak boleh melebihi jam operasional (' . $tutup . ').');
                }
            }
        });
    }

    public function messages()
    {
        return [
            'waktu_operasional_id.required' => 'Hari Operasional Lapangan wajib dipilih',
            'waktu_operasional_id.exists' => 'Hari Operasional tidak valid',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi',
            'waktu_mulai.unique' => 'Waktu mulai ini sudah ada pada jadwal tersebut.',
            'waktu_mulai.date_format' => 'Format waktu mulai harus HH:mm',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi',
            'waktu_selesai.date_format' => 'Format waktu selesai harus HH:mm',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai',
        ];
    }
}