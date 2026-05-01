<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                ];
            }),
            'lapangan' => $this->whenLoaded('lapangan', function () {
                return [
                    'id' => $this->lapangan->id,
                    'name' => $this->lapangan->name,
                    'harga' => $this->lapangan->harga,
                ];
            }),
            'tanggal_booking' => $this->tanggal_booking,
            'total_harga' => $this->total_harga,
            'status' => $this->status,
            'details_bookings' => $this->whenLoaded('detailsBookings', function () {
                return $this->detailsBookings->map(function ($detail) {
                    return [
                        'id' => $detail->id,
                        'slot_waktu' => $detail->slotWaktu ? [
                            'id' => $detail->slotWaktu->id,
                            'waktu_mulai' => $detail->slotWaktu->waktu_mulai,
                            'waktu_selesai' => $detail->slotWaktu->waktu_selesai,
                        ] : null,
                        'harga' => $detail->harga,
                        'status' => $detail->status,
                    ];
                });
            }),
            'payment' => $this->whenLoaded('payment', function () {
                return $this->payment ? [
                    'id' => $this->payment->id,
                    'payment_method' => $this->payment->payment_method,
                    'status' => $this->payment->status,
                    'tanggal_payment' => $this->payment->tanggal_payment,
                ] : null;
            }),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}