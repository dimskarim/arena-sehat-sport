<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:fasilitas,name'
        ], [
            'name.required' => 'Nama fasilitas wajib diisi',
            'name.max' => 'Nama fasilitas maksimal 50 karakter',
            'name.unique' => 'Nama fasilitas sudah ada'
        ]);

        $fasilitas = Fasilitas::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan',
            'data' => $fasilitas
        ]);
    }
}
