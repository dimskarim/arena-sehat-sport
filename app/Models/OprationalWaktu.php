<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprationalWaktu extends Model
{
    use HasFactory;

    protected $fillable = ['lapangan_id', 'hari', 'waktu_buka', 'waktu_tutup'];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}
