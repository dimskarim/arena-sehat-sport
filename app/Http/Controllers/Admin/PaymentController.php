<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Exception;

class PaymentController extends Controller
{
    protected $service;

    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('per_page', 10));
        return view('admin.payment.index', compact('items'), ['title' => 'Pembayaran']);
    }

    public function create()
    {
        return view('admin.payment.create', ['title' => 'Tambah Pembayaran']);
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.payment.edit', compact('item'), ['title' => 'Edit Pembayaran']);
        } catch (Exception $e) {
            return redirect()->route('admin.payments.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.payments.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
