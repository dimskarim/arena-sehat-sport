<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotifikasiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
            ],
            'details_booking_id' => $this->details_booking_id,
            'details_booking' => $this->whenLoaded('detailsBooking', function () {
                return [
                    'id' => $this->detailsBooking->id,
                    'booking_id' => $this->detailsBooking->booking_id,
                    'harga' => $this->detailsBooking->harga,
                    'status' => $this->detailsBooking->status,
                ];
            }),
            'deskripsi' => $this->deskripsi,
            'pesan' => $this->pesan,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
