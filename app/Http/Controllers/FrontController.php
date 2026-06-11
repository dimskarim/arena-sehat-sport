<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Kategori;
use App\Models\SlotWaktu;
use App\Models\Booking;

class FrontController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::with('kategori', 'gambarLapangans')->where('status', 'tersedia')->take(6)->get();
        return view('front.home', compact('lapangans'));
    }

    public function lapanganIndex(Request $request)
    {
        $query = Lapangan::with('kategori', 'gambarLapangans')->where('status', 'tersedia');
        
        if ($request->filled('kategori') && $request->kategori !== 'Semua Olahraga') {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('id', $request->kategori);
            });
        }
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('harga_max')) {
            $hargaMax = preg_replace('/[^0-9]/', '', $request->harga_max);
            if(is_numeric($hargaMax)) {
                $query->where('harga', '<=', $hargaMax);
            }
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'harga_asc') {
                $query->orderBy('harga', 'asc');
            } elseif ($request->sort == 'harga_desc') {
                $query->orderBy('harga', 'desc');
            } elseif ($request->sort == 'terbaru') {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $lapangans = $query->paginate(9)->withQueryString();
        $kategoris = Kategori::all();

        return view('front.lapangan.index', compact('lapangans', 'kategoris'));
    }

    public function lapanganShow($id)
    {
        $lapangan = Lapangan::with(['kategori', 'gambarLapangans', 'waktuOperasionals.slotWaktus'])->findOrFail($id);
        return view('front.lapangan.show', compact('lapangan'));
    }

    public function getSlotWaktu(Request $request, $id)
    {
        $tanggal = $request->tanggal;
        $lapangan = Lapangan::with(['waktuOperasionals.slotWaktus'])->findOrFail($id);
        
        // Find booked slots for this date
        $bookedSlots = \App\Models\BookingDetail::whereHas('booking', function($q) use ($tanggal, $id) {
            $q->where('tanggal_booking', $tanggal)
              ->where('lapangan_id', $id)
              ->whereIn('status', ['pending', 'paid', 'success', 'approved']);
        })->pluck('slot_waktu_id')->toArray();

        $slots = [];
        foreach($lapangan->waktuOperasionals as $waktuOperasional) {
            foreach($waktuOperasional->slotWaktus as $slot) {
                $slots[] = [
                    'id' => $slot->id,
                    'waktu_mulai' => $slot->waktu_mulai,
                    'waktu_selesai' => $slot->waktu_selesai,
                    'is_booked' => in_array($slot->id, $bookedSlots) || $slot->status == 'nonaktif'
                ];
            }
        }
        
        // Sort by start time
        usort($slots, function($a, $b) {
            return strtotime($a['waktu_mulai']) - strtotime($b['waktu_mulai']);
        });

        return response()->json($slots);
    }

    public function bookingCreate(Request $request)
    {
        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $tanggal = $request->tanggal;
        $slotIds = explode(',', $request->slot_ids);
        $slots = SlotWaktu::whereIn('id', $slotIds)->get();
        
        $subtotal = count($slots) * $lapangan->harga;
        $biayaLayanan = 5000;
        $total = $subtotal + $biayaLayanan;

        return view('front.booking.create', compact('lapangan', 'tanggal', 'slots', 'subtotal', 'biayaLayanan', 'total'));
    }

    public function bookingStore(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required',
            'tanggal' => 'required|date',
            'slot_ids' => 'required|array'
        ]);

        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $subtotal = count($request->slot_ids) * $lapangan->harga;
        $total = $subtotal + 5000;

        $booking = Booking::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'lapangan_id' => $lapangan->id,
            'tanggal_booking' => $request->tanggal,
            'total_harga' => $total,
            'status' => 'pending'
        ]);

        foreach ($request->slot_ids as $slotId) {
            \App\Models\BookingDetail::create([
                'booking_id' => $booking->id,
                'slot_waktu_id' => $slotId,
                'harga' => $lapangan->harga,
                'status' => 'pending'
            ]);
        }

        // Mock payment for now
        \App\Models\Payment::create([
            'booking_id' => $booking->id,
            'amount' => $total,
            'payment_method' => $request->payment_method ?? 'transfer',
            'status' => 'pending',
            'payment_date' => now()
        ]);

        // Create notification for admin
        $admin = \App\Models\User::where('role', 'admin')->first();
        if ($admin) {
            \App\Models\Notifikasi::create([
                'user_id' => $admin->id,
                'booking_id' => $booking->id,
                'pesan' => 'Pesanan baru dari ' . \Illuminate\Support\Facades\Auth::user()->name,
                'deskripsi' => 'Booking ' . $lapangan->name . ' untuk tanggal ' . \Carbon\Carbon::parse($request->tanggal)->format('d M Y'),
            ]);
        }

        return redirect()->route('booking.riwayat')->with('success', 'Booking berhasil dibuat. Silakan selesaikan pembayaran.');
    }

    public function bookingPayment()
    {
        return view('front.booking.payment');
    }

    public function bookingRiwayat()
    {
        $bookings = Booking::with(['lapangan', 'bookingDetails.slotWaktu', 'payment'])
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('front.booking.riwayat', compact('bookings'));
    }

    public function profile()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $totalBookings = Booking::where('user_id', $user->id)->count();
        $successfulBookings = Booking::where('user_id', $user->id)->where('status', 'success')->count();
        
        return view('front.profile.index', compact('user', 'totalBookings', 'successfulBookings'));
    }

    public function updateProfile(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->name = $request->name;
        // if user model has phone, uncomment: $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function login()
    {
        return view('front.auth.login');
    }

    public function register()
    {
        return view('front.auth.register');
    }

    public function support()
    {
        return view('front.support');
    }
}
