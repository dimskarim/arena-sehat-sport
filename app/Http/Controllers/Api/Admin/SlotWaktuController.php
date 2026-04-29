<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlotWaktu;
use Illuminate\Http\Request;

class SlotWaktuController extends Controller
{
    public function index()
    {
        return response()->json(SlotWaktu::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Here you would add validation
        $item = SlotWaktu::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = SlotWaktu::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = SlotWaktu::findOrFail($id);
        $data = $request->all();
        // Here you would add validation
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = SlotWaktu::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
