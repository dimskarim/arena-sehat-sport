<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'lapangan_id' => 'required|exists:lapangans,id',
            'tanggal_booking' => 'required|date',
            'total_harga' => 'required|integer|min:0',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User wajib dipilih',
            'user_id.exists' => 'User tidak ditemukan',
            'lapangan_id.required' => 'Lapangan wajib dipilih',
            'lapangan_id.exists' => 'Lapangan tidak ditemukan',
            'tanggal_booking.required' => 'Tanggal booking wajib diisi',
            'tanggal_booking.date' => 'Format tanggal tidak valid',
            'total_harga.required' => 'Total harga wajib diisi',
            'total_harga.integer' => 'Total harga harus berupa angka',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status harus pending, confirmed, cancelled, atau completed',
        ];
    }
}