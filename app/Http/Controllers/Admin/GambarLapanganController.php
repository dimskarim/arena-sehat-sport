<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\GambarLapanganService;
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
        $items = $this->service->getAll($request->query('per_page', 10));
        return view('admin.gambar_lapangan.index', compact('items'), ['title' => 'Gambar Lapangan']);
    }

    public function create()
    {
        return view('admin.gambar_lapangan.create', ['title' => 'Tambah Gambar Lapangan']);
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.gambar_lapangan.edit', compact('item'), ['title' => 'Edit Gambar Lapangan']);
        } catch (Exception $e) {
            return redirect()->route('admin.gambar-lapangans.index')->with('error', 'Data tidak ditemukan.');
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
