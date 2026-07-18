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
            'slot_waktu' => 'required|array|min:1',
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
            'slot_waktu.required' => 'Waktu/Slot reservasi wajib dipilih',
            'slot_waktu.array' => 'Format waktu/slot tidak valid',
            'slot_waktu.min' => 'Minimal 1 waktu/slot harus dipilih',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tanggal = $this->input('tanggal_booking');
            $lapanganId = $this->input('lapangan_id');
            $slots = $this->input('slot_waktu');
            $bookingId = $this->route('booking'); // for update routes

            if ($tanggal && $lapanganId && is_array($slots)) {
                $conflict = \App\Models\BookingDetail::whereIn('slot_waktu_id', $slots)
                    ->whereHas('booking', function ($q) use ($tanggal, $lapanganId, $bookingId) {
                        $q->where('tanggal_booking', $tanggal)
                          ->where('lapangan_id', $lapanganId)
                          ->whereNotIn('status', ['cancelled', 'canceled', 'failed', 'rejected']);
                        
                        if ($bookingId) {
                            $q->where('id', '!=', $bookingId);
                        }
                    })->exists();

                if ($conflict) {
                    $validator->errors()->add('slot_waktu', 'Satu atau lebih slot waktu yang Anda pilih sudah dipesan oleh orang lain. Silakan pilih jadwal yang berbeda (abu-abu = tidak tersedia).');
                }
            }
        });
    }
}