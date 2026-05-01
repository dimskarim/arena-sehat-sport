<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Http\Requests\Admin\PaymentRequest;
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
        $items = $this->service->getAll($request->query('status'), $request->query('booking_id'), $request->query('per_page', 10));
        return view('admin.payment.index', compact('items'), ['title' => 'Pembayaran']);
    }

    public function create()
    {
        $bookings = \App\Models\Booking::with('user', 'lapangan')->get();
        return view('admin.payment.create', compact('bookings'), ['title' => 'Tambah Pembayaran']);
    }

    public function store(PaymentRequest $request)
    {
        try {
            $this->service->create($request->validated(), $request->file('butki_payment'));
            return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $bookings = \App\Models\Booking::with('user', 'lapangan')->get();
            return view('admin.payment.edit', compact('item', 'bookings'), ['title' => 'Edit Pembayaran']);
        } catch (Exception $e) {
            return redirect()->route('admin.payments.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(PaymentRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated(), $request->file('butki_payment'));
            return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
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
