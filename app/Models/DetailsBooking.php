<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsBooking extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'slot_waktu_id', 'harga', 'status'];
}
