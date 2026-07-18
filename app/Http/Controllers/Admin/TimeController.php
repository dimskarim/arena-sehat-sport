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
        $user = auth()->user();
        $isPemilik = $user && $user->role === 'pemilik';
        $pemilikId = $user ? $user->id : null;

        $lapanganQuery = Lapangan::orderBy('name');
        if ($isPemilik) {
            $lapanganQuery->where('pemilik_id', $pemilikId);
        }
        $lapangans = $lapanganQuery->get();

        // Jam Operasional — paginated for the left table
        $opQuery = WaktuOperasional::with('lapangan')->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')");
        if ($isPemilik) {
            $opQuery->whereHas('lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }
        if ($request->lapangan_id) $opQuery->where('lapangan_id', $request->lapangan_id);
        if ($request->hari)        $opQuery->where('hari', $request->hari);
        $oprationalWaktus = $opQuery->paginate(8, ['*'], 'op_page')->withQueryString()->onEachSide(1);

        // Base query for slots
        $slotQueryBase = SlotWaktu::with(['waktuOperasional' => function ($q) {
            $q->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')");
        }, 'waktuOperasional.lapangan'])
        ->join('waktu_operasionals', 'slot_waktus.waktu_operasional_id', '=', 'waktu_operasionals.id')
        ->orderByRaw("FIELD(waktu_operasionals.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
        ->orderBy('slot_waktus.waktu_mulai', 'asc')
        ->select('slot_waktus.*');
        
        if ($isPemilik) {
            $slotQueryBase->whereHas('waktuOperasional.lapangan', function($q) use ($pemilikId) {
                $q->where('pemilik_id', $pemilikId);
            });
        }

        if ($request->lapangan_id || $request->hari) {
            $slotQueryBase->whereHas('waktuOperasional', function ($q) use ($request) {
                if ($request->lapangan_id) $q->where('lapangan_id', $request->lapangan_id);
                if ($request->hari) $q->where('hari', $request->hari);
            });
        }

        // Slot Waktu (all) — used for stats summary
        $slotAll = (clone $slotQueryBase)->get();

        // Slot Waktu — paginated for the cards grid
        $slotCards = (clone $slotQueryBase)->paginate(12, ['*'], 'card_page')->withQueryString()->onEachSide(1);

        // Slot Waktu — paginated for the detail table
        $slotWaktus = (clone $slotQueryBase)->paginate(12, ['*'], 'table_page')->withQueryString()->onEachSide(1);

        return view('admin.time.index', compact('lapangans', 'oprationalWaktus', 'slotAll', 'slotCards', 'slotWaktus'))
            ->with('title', 'Manajemen Operasional Waktu');
    }
}
