<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotifikasiService;
use App\Http\Requests\Admin\NotifikasiRequest;
use Illuminate\Http\Request;
use Exception;

class NotificationController extends Controller
{
    protected $service;

    public function __construct(NotifikasiService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $items = $this->service->getAll($request->query('user_id'), $request->query('per_page', 10));
        return view('admin.notification.index', compact('items'), ['title' => 'Notifikasi']);
    }

    public function create()
    {
        $users = \App\Models\User::all();
        $bookings = \App\Models\Booking::all();
        return view('admin.notification.create', compact('users', 'bookings'), ['title' => 'Tambah Notifikasi']);
    }

    public function store(NotifikasiRequest $request)
    {
        try {
            $this->service->create($request->validated());
            return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            $users = \App\Models\User::all();
            $bookings = \App\Models\Booking::all();
            return view('admin.notification.edit', compact('item', 'users', 'bookings'), ['title' => 'Edit Notifikasi']);
        } catch (Exception $e) {
            return redirect()->route('admin.notifications.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(NotifikasiRequest $request, $id)
    {
        try {
            $this->service->update($id, $request->validated());
            return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
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
