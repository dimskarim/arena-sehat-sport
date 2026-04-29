<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\OprationalWaktu;
use Illuminate\Http\Request;

class OprationalWaktuController extends Controller
{
    public function index()
    {
        return response()->json(OprationalWaktu::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Here you would add validation
        $item = OprationalWaktu::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = OprationalWaktu::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = OprationalWaktu::findOrFail($id);
        $data = $request->all();
        // Here you would add validation
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = OprationalWaktu::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
