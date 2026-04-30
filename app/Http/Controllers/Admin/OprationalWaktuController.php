<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\OprationalWaktuService;
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
        $items = $this->service->getAll($request->query('per_page', 10));
        return view('admin.oprational_waktu.index', compact('items'), ['title' => 'Jam Oprational']);
    }

    public function create()
    {
        return view('admin.oprational_waktu.create', ['title' => 'Tambah Jam Oprational']);
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.oprational_waktu.edit', compact('item'), ['title' => 'Edit Jam Oprational']);
        } catch (Exception $e) {
            return redirect()->route('admin.oprational-waktus.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.oprational-waktus.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
