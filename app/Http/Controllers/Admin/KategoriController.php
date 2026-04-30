<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\KategoriService;
use App\Http\Requests\Admin\KategoriRequest;
use Illuminate\Http\Request;
use Exception;

class KategoriController extends Controller
{
    protected $service;

    public function __construct(KategoriService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('per_page', 10));
        return view('admin.kategori.index', compact('items'), ['title' => 'Kategori']);
    }

    public function create()
    {
        return view('admin.kategori.create', ['title' => 'Tambah Kategori']);
    }

    public function store(KategoriRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.kategori.edit', compact('item'), ['title' => 'Edit Kategori']);
        } catch (Exception $e) {
            return redirect()->route('admin.kategoris.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(KategoriRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
