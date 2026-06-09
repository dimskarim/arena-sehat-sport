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
        $oprationalWaktus = $opQuery->paginate(8, ['*'], 'op_page')->withQueryString();

        // Base query for slots
        $slotQueryBase = SlotWaktu::with('waktuOperasional.lapangan')->latest();
        if ($request->lapangan_id || $request->hari) {
            $slotQueryBase->whereHas('waktuOperasional', function ($q) use ($request) {
                if ($request->lapangan_id) $q->where('lapangan_id', $request->lapangan_id);
                if ($request->hari) $q->where('hari', $request->hari);
            });
        }

        // Slot Waktu (all) — used for stats summary
        $slotAll = (clone $slotQueryBase)->get();

        // Slot Waktu — paginated for the cards grid
        $slotCards = (clone $slotQueryBase)->paginate(12, ['*'], 'card_page')->withQueryString();

        // Slot Waktu — paginated for the detail table
        $slotWaktus = (clone $slotQueryBase)->paginate(12, ['*'], 'table_page')->withQueryString();

        return view('admin.time.index', compact('lapangans', 'oprationalWaktus', 'slotAll', 'slotCards', 'slotWaktus'))
            ->with('title', 'Manajemen Operasional Waktu');
    }
}
