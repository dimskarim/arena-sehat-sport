<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlotWaktuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lapangan_id' => $this->lapangan_id,
            'lapangan' => $this->whenLoaded('lapangan', function () {
                return [
                    'id' => $this->lapangan->id,
                    'name' => $this->lapangan->name,
                ];
            }),
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}