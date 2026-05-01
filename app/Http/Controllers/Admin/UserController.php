<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('search'), $request->query('role'), $request->query('per_page', 10));
        return view('admin.user.index', compact('items'), ['title' => 'User']);
    }

    public function create()
    {
        return view('admin.user.create', ['title' => 'Tambah User']);
    }

    public function store(UserRequest $request)
    {
        try {
            $this->service->create($request->validated(), $request->file('foto_profile'));
            return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.user.edit', compact('item'), ['title' => 'Edit User']);
        } catch (Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated(), $request->file('foto_profile'));
            return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.users.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
