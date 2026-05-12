<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GambarLapanganService;
use App\Http\Requests\Admin\GambarLapanganRequest;
use Illuminate\Http\Request;
use Exception;

class GambarLapanganController extends Controller
{
    protected $service;

    public function __construct(GambarLapanganService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('lapangan_id'), $request->query('per_page', 10));
        return view('admin.gambar_lapangan.index', compact('items'), ['title' => 'Gambar Lapangan']);
    }

    public function create()
    {
        $lapangans = \App\Models\Lapangan::all();
        return view('admin.gambar_lapangan.create', compact('lapangans'), ['title' => 'Tambah Gambar Lapangan']);
    }

    public function store(GambarLapanganRequest $request)
    {
        try {
            $this->service->create($request->validated(), $request->file('gambar_file'));
            return redirect()->route('admin.gambar-lapangans.index')->with('success', 'Gambar Lapangan berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $lapangans = \App\Models\Lapangan::all();
            return view('admin.gambar_lapangan.edit', compact('item', 'lapangans'), ['title' => 'Edit Gambar Lapangan']);
        } catch (Exception $e) {
            return redirect()->route('admin.gambar-lapangans.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(GambarLapanganRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated(), $request->file('gambar_file'));
            return redirect()->route('admin.gambar-lapangans.index')->with('success', 'Gambar Lapangan berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.gambar-lapangans.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
