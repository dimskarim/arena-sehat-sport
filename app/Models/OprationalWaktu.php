<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprationalWaktu extends Model
{
    use HasFactory;

    protected $fillable = ['lapangan_id', 'waktu_buka', 'waktu_tutup'];
}
