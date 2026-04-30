<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\LapanganService;
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
        $items = $this->service->getAllLapangans($request->query('search'), $request->query('kategori_id'), $request->query('per_page', 10));
        return view('admin.lapangan.index', compact('items'), ['title' => 'Lapangan']);
    }

    public function create()
    {
        return view('admin.lapangan.create', ['title' => 'Tambah Lapangan']);
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getLapanganById($id);
            return view('admin.lapangan.edit', compact('item'), ['title' => 'Edit Lapangan']);
        } catch (Exception $e) {
            return redirect()->route('admin.lapangans.index')->with('error', 'Data tidak ditemukan.');
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
