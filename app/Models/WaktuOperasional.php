<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuOperasional extends Model
{
    use HasFactory;

    protected $fillable = ['lapangan_id', 'hari', 'waktu_buka', 'waktu_tutup', 'is_libur'];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    public function slotWaktus()
    {
        return $this->hasMany(SlotWaktu::class);
    }
}
