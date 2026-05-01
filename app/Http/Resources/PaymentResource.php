<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking' => $this->whenLoaded('booking', function () {
                return [
                    'id' => $this->booking->id,
                    'tanggal_booking' => $this->booking->tanggal_booking,
                    'total_harga' => $this->booking->total_harga,
                    'status' => $this->booking->status,
                    'user' => $this->booking->user ? [
                        'id' => $this->booking->user->id,
                        'name' => $this->booking->user->name,
                    ] : null,
                    'lapangan' => $this->booking->lapangan ? [
                        'id' => $this->booking->lapangan->id,
                        'name' => $this->booking->lapangan->name,
                    ] : null,
                ];
            }),
            'payment_method' => $this->payment_method,
            'butki_payment' => $this->butki_payment,
            'tanggal_payment' => $this->tanggal_payment,
            'status' => $this->status,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}