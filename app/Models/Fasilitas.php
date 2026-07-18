<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = ['name', 'icon'];

    public function lapangans()
    {
        return $this->belongsToMany(Lapangan::class, 'fasilitas_lapangan', 'fasilitas_id', 'lapangan_id');
    }
}
