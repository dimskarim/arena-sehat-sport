<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Exception;

class NotificationController extends Controller
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('per_page', 10));
        return view('admin.notification.index', compact('items'), ['title' => 'Notifikasi']);
    }

    public function create()
    {
        return view('admin.notification.create', ['title' => 'Tambah Notifikasi']);
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.notification.edit', compact('item'), ['title' => 'Edit Notifikasi']);
        } catch (Exception $e) {
            return redirect()->route('admin.notifications.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.notifications.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
