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
        $user = auth()->user();
        $isPemilik = $user && $user->role === 'pemilik';
        $pemilikId = $user->id;

        $totalUsers     = User::where('role', 'user')->count();
        
        $lapanganQuery = Lapangan::query();
        if ($isPemilik) {
            $lapanganQuery->where('pemilik_id', $pemilikId);
        }
        $totalLapangans = $lapanganQuery->count();

        $bookingQuery = Booking::query();
        if ($isPemilik) {
            $bookingQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $totalBookings  = $bookingQuery->count();

        // Pendapatan dari booking yang statusnya 'completed'
        $pendapatanQuery = Booking::where('status', 'completed');
        if ($isPemilik) {
            $pendapatanQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $totalPendapatan = $pendapatanQuery->sum('total_harga');

        // 8 booking terbaru dengan relasi
        $recentBookingsQuery = Booking::with(['user', 'lapangan', 'bookingDetails.slotWaktu'])->latest()->take(8);
        if ($isPemilik) {
            $recentBookingsQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $recentBookings = $recentBookingsQuery->get();

        // Monthly Revenue Chart Data
        $revenueDataQuery = Booking::where('status', 'completed')
            ->selectRaw('MONTH(tanggal_booking) as month, SUM(total_harga) as total')
            ->whereYear('tanggal_booking', date('Y'))
            ->groupBy('month');
        if ($isPemilik) {
            $revenueDataQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        $revenueData = $revenueDataQuery->pluck('total', 'month')->toArray();

        $chartBars = [];
        $months = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'];
        $maxRevenue = !empty($revenueData) ? max($revenueData) : 0;

        foreach ($months as $index => $label) {
            $monthNum = $index + 1;
            $val = $revenueData[$monthNum] ?? 0;
            
            // Format currency for tooltip (e.g. Rp 1.5M or Rp 500k)
            $formattedVal = 'Rp 0';
            if ($val > 0) {
                if ($val >= 1000000) {
                    $formattedVal = 'Rp ' . number_format($val / 1000000, 1, ',', '.') . 'M';
                } elseif ($val >= 1000) {
                    $formattedVal = 'Rp ' . number_format($val / 1000, 0, ',', '.') . 'k';
                } else {
                    $formattedVal = 'Rp ' . number_format($val, 0, ',', '.');
                }
            }

            // Calculate height percentage (min 1% for visibility, max 100%)
            $height = $maxRevenue > 0 ? max(1, round(($val / $maxRevenue) * 100)) : 1;
            
            $chartBars[] = [
                'h' => $height,
                'label' => $label,
                'val' => $formattedVal,
                'peak' => ($maxRevenue > 0 && $val == $maxRevenue),
            ];
        }

        // Popular Venues
        $popularVenuesQuery = Lapangan::withCount(['bookings as completed_bookings_count' => function($q) {
                $q->where('status', 'completed');
            }])
            ->withSum(['bookings as completed_bookings_sum' => function($q) {
                $q->where('status', 'completed');
            }], 'total_harga')
            ->with(['gambarLapangans' => function($q) {
                $q->limit(1);
            }])
            ->orderByDesc('completed_bookings_count')
            ->take(4);
        if ($isPemilik) {
            $popularVenuesQuery->where('pemilik_id', $pemilikId);
        }
        $popularVenues = $popularVenuesQuery->get();

        return view('admin.dashboard.index', [
            'title'          => 'Dashboard',
            'totalUsers'     => $totalUsers,
            'totalLapangans' => $totalLapangans,
            'totalBookings'  => $totalBookings,
            'totalPendapatan'=> $totalPendapatan,
            'recentBookings' => $recentBookings,
            'chartBars'      => $chartBars,
            'popularVenues'  => $popularVenues,
        ]);
    }
}

