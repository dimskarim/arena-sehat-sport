<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SlotWaktuService;
use App\Http\Requests\Admin\SlotWaktuRequest;
use Illuminate\Http\Request;
use Exception;

class SlotWaktuController extends Controller
{
    protected $service;

    public function __construct(SlotWaktuService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('lapangan_id'), $request->query('per_page', 10));
        return view('admin.slot_waktu.index', compact('items'), ['title' => 'Slot Waktu']);
    }

    public function create()
    {
        $lapangans = \App\Models\Lapangan::all();
        return view('admin.slot_waktu.create', compact('lapangans'), ['title' => 'Tambah Slot Waktu']);
    }

    public function store(SlotWaktuRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.slot-waktus.index')->with('success', 'Slot Waktu berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $lapangans = \App\Models\Lapangan::all();
            return view('admin.slot_waktu.edit', compact('item', 'lapangans'), ['title' => 'Edit Slot Waktu']);
        } catch (Exception $e) {
            return redirect()->route('admin.slot-waktus.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(SlotWaktuRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.slot-waktus.index')->with('success', 'Slot Waktu berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.slot-waktus.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
