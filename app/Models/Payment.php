<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'payment_method', 'butki_payment', 'tanggal_payment', 'status'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Scopes for filtering
    public function scopeFilterStatus($query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
    }

    public function scopeFilterBooking($query, $bookingId)
    {
        if ($bookingId) {
            $query->where('booking_id', $bookingId);
        }
    }
}
