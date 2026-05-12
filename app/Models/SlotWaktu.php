<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    use HasFactory;

    protected $fillable = ['lapangan_id', 'waktu_mulai', 'waktu_selesai', 'status'];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    public function detailsBookings()
    {
        return $this->hasMany(DetailsBooking::class);
    }
}
