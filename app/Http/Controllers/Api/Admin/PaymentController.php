<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Here you would add validation
        $item = Payment::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Payment::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Payment::findOrFail($id);
        $data = $request->all();
        // Here you would add validation
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Payment::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
