<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lapangan;
use App\Models\Booking;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalLapangans = Lapangan::count();
        $totalBookings = Booking::count();
        
        // Pendapatan dihitung dari payment yang statusnya 'paid'
        $totalPendapatan = Payment::where('payments.status', 'paid')
            ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
            ->sum('bookings.total_harga');

        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
            'totalLapangans' => $totalLapangans,
            'totalBookings' => $totalBookings,
            'totalPendapatan' => $totalPendapatan
        ]);
    }
}
