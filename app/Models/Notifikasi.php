<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasis';

    protected $fillable = ['user_id', 'details_booking_id', 'deskripsi', 'pesan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailsBooking()
    {
        return $this->belongsTo(DetailsBooking::class, 'details_booking_id');
    }

    // Scopes
    public function scopeFilterUser($query, $userId)
    {
        if ($userId) {
            $query->where('user_id', $userId);
        }
    }
}
