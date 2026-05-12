<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OprationalWaktuResource extends JsonResource
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
            'waktu_buka' => $this->waktu_buka,
            'waktu_tutup' => $this->waktu_tutup,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}