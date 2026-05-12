<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LapanganResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kategori' => $this->whenLoaded('kategori', function () {
                return [
                    'id' => $this->kategori->id,
                    'name' => $this->kategori->name,
                    'slug' => $this->kategori->slug,
                ];
            }),
            'name' => $this->name,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'status' => $this->status,
            'gambar_utama' => $this->whenLoaded('gambarLapangans', fn() => $this->gambarLapangans->first()?->gambar_file),
            'gambar_lapangans' => GambarLapanganResource::collection($this->whenLoaded('gambarLapangans')),
            'slot_waktus' => SlotWaktuResource::collection($this->whenLoaded('slotWaktus')),
            'oprational_waktus' => OprationalWaktuResource::collection($this->whenLoaded('oprationalWaktus')),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}