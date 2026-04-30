<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LapanganResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'kategori' => [
                'id' => $this->kategori->id ?? null,
                'name' => $this->kategori->name ?? null,
            ],
            'name' => $this->name,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'status' => $this->status,
            'gambar_utama' => $this->gambarLapangans->first()->gambar_file ?? null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}