<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    use HasFactory;

    protected $fillable = ['waktu_operasional_id', 'waktu_mulai', 'waktu_selesai', 'status'];

    public function waktuOperasional()
    {
        return $this->belongsTo(WaktuOperasional::class);
    }

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }
}
