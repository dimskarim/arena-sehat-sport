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
        return redirect()->route('admin.time.index');
    }

    public function create()
    {
        $waktuOperasionals = \App\Models\WaktuOperasional::with('lapangan')->get();
        return view('admin.slot_waktu.create', compact('waktuOperasionals'), ['title' => 'Tambah Slot Waktu']);
    }

    public function store(SlotWaktuRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.time.index')->with('success', 'Slot Waktu berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $waktuOperasionals = \App\Models\WaktuOperasional::with('lapangan')->get();
            return view('admin.slot_waktu.edit', compact('item', 'waktuOperasionals'), ['title' => 'Edit Slot Waktu']);
        } catch (Exception $e) {
            return redirect()->route('admin.time.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(SlotWaktuRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.time.index')->with('success', 'Slot Waktu berhasil diperbarui.');
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
    public function toggleStatus(Request $request, $id)
    {
        try {
            $slot = \App\Models\SlotWaktu::findOrFail($id);
            // Toggle between 'aktif' and 'nonaktif'
            $slot->status = $slot->status === 'aktif' ? 'nonaktif' : 'aktif';
            $slot->save();

            return response()->json([
                'success' => true,
                'status' => $slot->status,
                'message' => 'Status slot berhasil diubah.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status.'
            ], 500);
        }
    }
}
