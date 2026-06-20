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
        $items = $this->service->getAll(
            $request->query('status'),
            $request->query('user_id'),
            $request->query('date_from') ?? $request->query('date'),
            $request->query('per_page', 10),
            $request->query('date_to'),
            $request->query('search')
        );

        $user = auth()->user();
        $isPemilik = $user && $user->role === 'pemilik';
        $pemilikId = $user ? $user->id : null;

        // Summary stats (across all matching records, not just current page)
        $statsQuery = \App\Models\Booking::query();
        if ($isPemilik) {
            $statsQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        if ($request->status) $statsQuery->where('status', $request->status);
        if ($request->date_from) $statsQuery->whereDate('tanggal_booking', '>=', $request->date_from);
        if ($request->date_to)   $statsQuery->whereDate('tanggal_booking', '<=', $request->date_to);

        if ($request->search) $statsQuery->search($request->search);

        $currentMonthIncomeQuery = \App\Models\Booking::where('status', 'completed')
            ->whereMonth('tanggal_booking', now()->month)
            ->whereYear('tanggal_booking', now()->year);
        if ($isPemilik) {
            $currentMonthIncomeQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $currentMonthIncome = $currentMonthIncomeQuery->sum('total_harga');

        $lastMonthIncomeQuery = \App\Models\Booking::where('status', 'completed')
            ->whereMonth('tanggal_booking', now()->subMonth()->month)
            ->whereYear('tanggal_booking', now()->subMonth()->year);
        if ($isPemilik) {
            $lastMonthIncomeQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $lastMonthIncome = $lastMonthIncomeQuery->sum('total_harga');

        $percentageChange = $lastMonthIncome > 0 
            ? (($currentMonthIncome - $lastMonthIncome) / $lastMonthIncome) * 100 
            : ($currentMonthIncome > 0 ? 100 : 0);

        $activeReservationsThisMonthQuery = \App\Models\Booking::whereNotIn('status', ['cancelled', 'canceled'])
            ->whereMonth('tanggal_booking', now()->month)
            ->whereYear('tanggal_booking', now()->year)
            ->with('user');
        if ($isPemilik) {
            $activeReservationsThisMonthQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $activeReservationsThisMonth = $activeReservationsThisMonthQuery->get();

        $summaryStats = [
            'gross_income'     => (clone $statsQuery)->whereIn('status', ['confirmed', 'completed', 'paid'])->sum('total_harga'),
            'total_confirmed'  => (clone $statsQuery)->whereIn('status', ['confirmed', 'completed', 'paid'])->count(),
            'total_pending'    => (clone $statsQuery)->where('status', 'pending')->count(),
            'total_cancelled'  => (clone $statsQuery)->whereIn('status', ['cancelled', 'canceled'])->count(),
            'current_month_income' => $currentMonthIncome,
            'percentage_change' => round($percentageChange, 1),
            'active_reservations_count' => $activeReservationsThisMonth->count(),
            'active_users' => $activeReservationsThisMonth->pluck('user')->filter()->unique('id'),
        ];

        if ($request->ajax()) {
            return view('admin.booking.index', compact('items', 'summaryStats'), ['title' => 'History Booking'])->render();
        }

        return view('admin.booking.index', compact('items', 'summaryStats'), ['title' => 'History Booking']);
    }

    public function create()
    {
        $users = \App\Models\User::all();
        $lapanganQuery = \App\Models\Lapangan::query();
        if (auth()->check() && auth()->user()->role === 'pemilik') {
            $lapanganQuery->where('pemilik_id', auth()->id());
        }
        $lapangans = $lapanganQuery->get();
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
            $lapanganQuery = \App\Models\Lapangan::query();
            if (auth()->check() && auth()->user()->role === 'pemilik') {
                $lapanganQuery->where('pemilik_id', auth()->id());
            }
            $lapangans = $lapanganQuery->get();
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

    public function destroy(Request $request, $id)
    {
        try {
            $this->service->delete($id);
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Data berhasil dihapus.']);
            }
            return redirect()->route('admin.bookings.index')->with('success', 'Data berhasil dihapus.');
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $e->getMessage()], 400);
            }
            return back()->with('error', $e->getMessage());
        }
    }
}
