<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('kategori') ?? $this->route('id') ?? $this->segment(3);
        
        return [
            'name' => 'required|string|max:20|regex:/^[a-zA-Z0-9\s\-]+$/|unique:kategoris,name,' . $id,
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kategori wajib diisi',
            'name.max' => 'Maksimal 20 huruf',
            'name.regex' => 'Format penulisan salah',
            'name.unique' => 'Nama kategori sudah ada',
        ];
    }
}