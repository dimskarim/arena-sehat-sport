<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return response()->json(Booking::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Here you would add validation
        $item = Booking::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Booking::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Booking::findOrFail($id);
        $data = $request->all();
        // Here you would add validation
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Booking::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
