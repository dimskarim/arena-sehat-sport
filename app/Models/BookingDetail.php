<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $table = 'booking_details';

    protected $fillable = ['booking_id', 'slot_waktu_id', 'harga', 'status'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function slotWaktu()
    {
        return $this->belongsTo(SlotWaktu::class);
    }
}
