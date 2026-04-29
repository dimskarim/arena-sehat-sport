<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Here you would add validation
        $item = User::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = User::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $data = $request->all();
        // Here you would add validation
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
