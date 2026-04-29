<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\GambarLapangan;
use Illuminate\Http\Request;

class GambarLapanganController extends Controller
{
    public function index()
    {
        return response()->json(GambarLapangan::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Here you would add validation
        $item = GambarLapangan::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = GambarLapangan::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = GambarLapangan::findOrFail($id);
        $data = $request->all();
        // Here you would add validation
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = GambarLapangan::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
