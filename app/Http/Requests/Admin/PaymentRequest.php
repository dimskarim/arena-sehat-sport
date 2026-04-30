<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'booking_id' => 'required',
            'payment_method' => 'required',
            'tanggal_payment' => 'required',
            'status' => 'required',
            'butki_payment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ];
    }
}