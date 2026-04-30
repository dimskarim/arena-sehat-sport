<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'user_id' => 'required',
            'lapangan_id' => 'required',
            'tanggal_booking' => 'required',
            'total_harga' => 'required',
            'status' => 'required'
        ];
    }
}