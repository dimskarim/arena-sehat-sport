<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LapanganService;
use App\Http\Requests\Admin\LapanganRequest;
use Illuminate\Http\Request;
use Exception;

class LapanganController extends Controller
{
    protected $service;

    public function __construct(LapanganService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAllLapangans($request->query('search'), $request->query('kategori_id'), $request->query('status'), $request->query('per_page', 10));
        return view('admin.lapangan.index', compact('items'), ['title' => 'Lapangan']);
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.lapangan.create', compact('kategoris'), ['title' => 'Tambah Lapangan']);
    }

    public function store(LapanganRequest $request)
    {
        try {
            $this->service->createLapangan($request->validated(), $request->file('gambar'));
            return redirect()->route('admin.lapangans.index')->with('success', 'Lapangan berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getLapanganById($id);
            $kategoris = \App\Models\Kategori::all();
            return view('admin.lapangan.detail', compact('item', 'kategoris'), ['title' => 'Edit Lapangan']);
        } catch (Exception $e) {
            return redirect()->route('admin.lapangans.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(LapanganRequest $request, $id)
    {
        try {
            $this->service->updateLapangan($id, $request->validated(), $request->file('gambar'));
            return redirect()->route('admin.lapangans.index')->with('success', 'Lapangan berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->deleteLapangan($id);
            return redirect()->route('admin.lapangans.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
