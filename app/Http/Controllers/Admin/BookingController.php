<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Http\Requests\Admin\BookingRequest;
use Illuminate\Http\Request;
use Exception;

class BookingController extends Controller
{
    protected $service;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('status'), $request->query('user_id'), $request->query('date'), $request->query('per_page', 10));
        return view('admin.booking.index', compact('items'), ['title' => 'History Booking']);
    }

    public function create()
    {
        $users = \App\Models\User::all();
        $lapangans = \App\Models\Lapangan::all();
        return view('admin.booking.create', compact('users', 'lapangans'), ['title' => 'Tambah History Booking']);
    }

    public function store(BookingRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $users = \App\Models\User::all();
            $lapangans = \App\Models\Lapangan::all();
            return view('admin.booking.detail', compact('item', 'users', 'lapangans'), ['title' => 'Edit History Booking']);
        } catch (Exception $e) {
            return redirect()->route('admin.bookings.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(BookingRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.bookings.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
