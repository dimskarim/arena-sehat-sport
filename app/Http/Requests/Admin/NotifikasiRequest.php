<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NotifikasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'deskripsi' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ];
    }
}
