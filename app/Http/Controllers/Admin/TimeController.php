<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\WaktuOperasional;
use App\Models\SlotWaktu;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index(Request $request)
    {
        $lapangans = Lapangan::orderBy('name')->get();

        // Jam Operasional — paginated for the left table
        $opQuery = WaktuOperasional::with('lapangan')->latest();
        if ($request->lapangan_id) $opQuery->where('lapangan_id', $request->lapangan_id);
        if ($request->hari)        $opQuery->where('hari', $request->hari);
        $waktuOperasionals = $opQuery->paginate(8)->withQueryString();

        // Slot Waktu (all) — used for stats summary + cards grid
        $slotQuery = SlotWaktu::with('waktuOperasional.lapangan')->latest();
        if ($request->lapangan_id) {
            $slotQuery->whereHas('waktuOperasional', function ($q) use ($request) {
                $q->where('lapangan_id', $request->lapangan_id);
            });
        }
        $slotAll = $slotQuery->get();

        // Slot Waktu — paginated for the detail table
        $slotQuery2 = SlotWaktu::with('waktuOperasional.lapangan')->latest();
        if ($request->lapangan_id) {
            $slotQuery2->whereHas('waktuOperasional', function ($q) use ($request) {
                $q->where('lapangan_id', $request->lapangan_id);
            });
        }
        $slotWaktus = $slotQuery2->paginate(12)->withQueryString();

        return view('admin.time.index', compact('lapangans', 'waktuOperasionals', 'slotAll', 'slotWaktus'))
            ->with('title', 'Manajemen Operasional Waktu');
    }
}
