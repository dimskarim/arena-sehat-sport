<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'nullable|min:6',
            'foto_profile' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ];
    }
}