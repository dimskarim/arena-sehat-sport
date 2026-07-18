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

    public function create(Request $request)
    {
        $query = \App\Models\WaktuOperasional::with('lapangan');
        
        if ($request->filled('lapangan_id')) {
            $query->where('lapangan_id', $request->lapangan_id);
        }
        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }

        if (auth()->check() && auth()->user()->role === 'pemilik') {
            $pemilikId = auth()->id();
            $query->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $waktuOperasionals = $query->get();
        return view('admin.slot_waktu.create', compact('waktuOperasionals'), ['title' => 'Tambah Slot Waktu']);
    }

    public function store(SlotWaktuRequest $request)
    {
        try {
            $this->service->create($request->validated());
            $waktuOperasional = \App\Models\WaktuOperasional::find($request->waktu_operasional_id);
            $lapangan_id = $waktuOperasional ? $waktuOperasional->lapangan_id : null;
            return redirect()->route('admin.time.index', $lapangan_id ? ['lapangan_id' => $lapangan_id] : [])->with('success', 'Slot Waktu berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $waktuOperasionalsQuery = \App\Models\WaktuOperasional::with('lapangan');
            if (auth()->check() && auth()->user()->role === 'pemilik') {
                $pemilikId = auth()->id();
                $waktuOperasionalsQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                    $q->where('pemilik_id', $pemilikId);
                });
            }
            $waktuOperasionals = $waktuOperasionalsQuery->get();
            return view('admin.slot_waktu.edit', compact('item', 'waktuOperasionals'), ['title' => 'Edit Slot Waktu']);
        } catch (Exception $e) {
            return redirect()->route('admin.time.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(SlotWaktuRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            $waktuOperasional = \App\Models\WaktuOperasional::find($request->waktu_operasional_id);
            $lapangan_id = $waktuOperasional ? $waktuOperasional->lapangan_id : null;
            return redirect()->route('admin.time.index', $lapangan_id ? ['lapangan_id' => $lapangan_id] : [])->with('success', 'Slot Waktu berhasil diperbarui.');
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
