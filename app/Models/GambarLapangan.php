<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarLapangan extends Model
{
    use HasFactory;

    protected $fillable = ['lapangan_id', 'gambar_file'];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}
