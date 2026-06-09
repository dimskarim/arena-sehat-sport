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
        $lapangans = \App\Models\Lapangan::all();
        return view('admin.oprational_waktu.create', compact('lapangans'), ['title' => 'Tambah Jam Operasional']);
    }

    public function store(OprationalWaktuRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.time.index')->with('success', 'Jam Operasional berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $lapangans = \App\Models\Lapangan::all();
            return view('admin.oprational_waktu.edit', compact('item', 'lapangans'), ['title' => 'Edit Jam Operasional']);
        } catch (Exception $e) {
            return redirect()->route('admin.time.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(OprationalWaktuRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.time.index')->with('success', 'Jam Operasional berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.time.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
