<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\BookingService;
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
        $items = $this->service->getAll($request->query('per_page', 10));
        return view('admin.booking.index', compact('items'), ['title' => 'History Booking']);
    }

    public function create()
    {
        return view('admin.booking.create', ['title' => 'Tambah History Booking']);
    }

    public function edit($id)
    {
        try {
            $item = $this->service->getById($id);
            return view('admin.booking.edit', compact('item'), ['title' => 'Edit History Booking']);
        } catch (Exception $e) {
            return redirect()->route('admin.bookings.index')->with('error', 'Data tidak ditemukan.');
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
