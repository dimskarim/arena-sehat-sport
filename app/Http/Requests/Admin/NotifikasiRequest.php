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
            'details_booking_id' => 'required|exists:details_bookings,id',
            'deskripsi' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ];
    }
}
