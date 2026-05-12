<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string|max:100',
            'tanggal_payment' => 'required|date',
            'status' => 'required|in:pending,paid,failed,refunded',
            'butki_payment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'booking_id.required' => 'Booking wajib dipilih',
            'booking_id.exists' => 'Booking tidak ditemukan',
            'payment_method.required' => 'Metode pembayaran wajib diisi',
            'tanggal_payment.required' => 'Tanggal pembayaran wajib diisi',
            'tanggal_payment.date' => 'Format tanggal tidak valid',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status harus pending, paid, failed, atau refunded',
            'butki_payment.file' => 'Bukti pembayaran harus berupa file',
            'butki_payment.max' => 'Ukuran file maksimal 2MB',
        ];
    }
}