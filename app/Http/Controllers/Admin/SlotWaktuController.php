<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\SlotWaktuService;
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
        $items = $this->service->getAll($request->query('per_page', 10));
        return view('admin.slot_waktu.index', compact('items'), ['title' => 'Slot Waktu']);
    }

    public function create()
    {
        return view('admin.slot_waktu.create', ['title' => 'Tambah Slot Waktu']);
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.slot_waktu.edit', compact('item'), ['title' => 'Edit Slot Waktu']);
        } catch (Exception $e) {
            return redirect()->route('admin.slot-waktus.index')->with('error', 'Data tidak ditemukan.');
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
