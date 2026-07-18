<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OprationalWaktuService;
use App\Http\Requests\Admin\OprationalWaktuRequest;
use Illuminate\Http\Request;
use Exception;

class OprationalWaktuController extends Controller
{
    protected $service;

    public function __construct(OprationalWaktuService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return redirect()->route('admin.time.index');
    }

    public function create()
    {
        $lapanganQuery = \App\Models\Lapangan::query();
        if (auth()->check() && auth()->user()->role === 'pemilik') {
            $lapanganQuery->where('pemilik_id', auth()->id());
        }
        $lapangans = $lapanganQuery->get();
        return view('admin.oprational_waktu.create', compact('lapangans'), ['title' => 'Tambah Jam Operasional']);
    }

    public function store(OprationalWaktuRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.time.index', ['lapangan_id' => $request->lapangan_id])->with('success', 'Jam Operasional berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $lapanganQuery = \App\Models\Lapangan::query();
            if (auth()->check() && auth()->user()->role === 'pemilik') {
                $lapanganQuery->where('pemilik_id', auth()->id());
            }
            $lapangans = $lapanganQuery->get();
            return view('admin.oprational_waktu.edit', compact('item', 'lapangans'), ['title' => 'Edit Jam Operasional']);
        } catch (Exception $e) {
            return redirect()->route('admin.time.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(OprationalWaktuRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.time.index', ['lapangan_id' => $request->lapangan_id])->with('success', 'Jam Operasional berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $this->service->delete($id);
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Data berhasil dihapus.']);
            }
            return redirect()->route('admin.time.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage());
        }
    }
}
