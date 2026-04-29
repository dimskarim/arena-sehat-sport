<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json(Kategori::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Here you would add validation
        $item = Kategori::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Kategori::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Kategori::findOrFail($id);
        $data = $request->all();
        // Here you would add validation
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Kategori::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
