@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] mb-2">
                <a href="{{ route('admin.notifications.index') }}" class="hover:text-[#af101a] transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    Kembali ke Notifikasi
                </a>
                <span class="text-[#e4beba]">/</span>
                <span class="font-semibold text-[#1b1c1c]">Tambah Notifikasi</span>
            </div>
            <h1 class="font-['Lexend'] text-3xl font-bold text-[#1b1c1c] tracking-tight">Buat Notifikasi Baru</h1>
            <p class="text-[#5b403d] mt-1 text-sm">Kirim pesan pemberitahuan ke pengguna tertentu.</p>
        </div>
        <button type="submit" form="notifForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 shadow-lg shadow-red-900/20 active:scale-95 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            Kirim Notifikasi
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm p-8">
                <form id="notifForm" action="{{ route('admin.notifications.store') }}" method="POST">
                    @csrf

                    @if($errors->any())
                    <div class="mb-6 border-l-4 border-red-500 bg-red-50 px-5 py-4 rounded-r-xl">
                        <p class="text-red-800 font-bold text-sm mb-1">Mohon perbaiki kesalahan:</p>
                        <ul class="list-disc list-inside text-red-700 text-xs space-y-0.5">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Penerima --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Penerima (Pengguna) <span class="text-[#ba1a1a]">*</span></label>
                        <select name="user_id" required class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all appearance-none cursor-pointer">
                            <option value="">— Pilih Pengguna —</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Booking terkait --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Booking Terkait <span class="text-[10px] normal-case font-normal text-[#8f6f6c] ml-1">(opsional)</span></label>
                        <select name="booking_id" class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all appearance-none cursor-pointer">
                            <option value="">— Tidak terkait booking tertentu —</option>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                                    #{{ $booking->id }} — {{ optional($booking->user)->name ?? 'User' }} — {{ optional($booking->lapangan)->name ?? 'Lapangan' }} — {{ ucfirst($booking->status) }}
                                </option>
                            @endforeach
                        </select>
                        @error('booking_id') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Judul / Deskripsi --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Judul / Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Contoh: Konfirmasi Pembayaran"
                            class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all">
                        @error('deskripsi') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Pesan --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Isi Pesan <span class="text-[#ba1a1a]">*</span></label>
                        <textarea name="pesan" required rows="5" placeholder="Tulis pesan notifikasi di sini..."
                            class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all resize-none">{{ old('pesan') }}</textarea>
                        @error('pesan') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Template Cepat --}}
                    <div>
                        <p class="text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-3">Template Cepat</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button type="button" onclick="setTemplate('Pembayaran Diverifikasi', 'Selamat! Pembayaran Anda telah kami verifikasi dan jadwal lapangan resmi terkunci. Silakan datang sesuai jadwal.')"
                                class="text-left px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-xs font-semibold text-green-700 hover:bg-green-100 transition-colors">
                                ✅ Pembayaran Diterima
                            </button>
                            <button type="button" onclick="setTemplate('Pembayaran Ditolak', 'Mohon maaf, bukti pembayaran Anda ditolak karena gambar tidak jelas. Silakan upload ulang struk yang valid dalam batas waktu yang ditentukan.')"
                                class="text-left px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-xs font-semibold text-red-700 hover:bg-red-100 transition-colors">
                                ❌ Pembayaran Ditolak
                            </button>
                            <button type="button" onclick="setTemplate('Pengingat Booking', 'Pengingat: Jadwal booking Anda akan segera dimulai. Harap datang tepat waktu dan bawa bukti reservasi.')"
                                class="text-left px-4 py-3 bg-blue-50 border border-blue-200 rounded-xl text-xs font-semibold text-blue-700 hover:bg-blue-100 transition-colors">
                                🔔 Pengingat Jadwal
                            </button>
                            <button type="button" onclick="setTemplate('Booking Dibatalkan', 'Booking Anda telah dibatalkan. Jika ada pertanyaan, silakan hubungi tim kami.')"
                                class="text-left px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700 hover:bg-gray-100 transition-colors">
                                🚫 Booking Dibatalkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Tips --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm p-6">
                <h4 class="font-['Lexend'] font-bold text-[#1b1c1c] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#d32f2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Tips Notifikasi
                </h4>
                <ul class="space-y-3 text-sm text-[#5b403d]">
                    <li class="flex items-start gap-2"><span class="text-[#d32f2f] font-bold mt-0.5">•</span><span>Gunakan pesan yang singkat, jelas, dan informatif.</span></li>
                    <li class="flex items-start gap-2"><span class="text-[#d32f2f] font-bold mt-0.5">•</span><span>Sertakan booking terkait agar user langsung mengerti konteksnya.</span></li>
                    <li class="flex items-start gap-2"><span class="text-[#d32f2f] font-bold mt-0.5">•</span><span>Untuk pesan massal, gunakan fitur "Kirim Pengumuman Massal" di halaman daftar.</span></li>
                </ul>
            </div>
            <div class="bg-[#d32f2f] text-white p-6 rounded-2xl shadow-lg shadow-[#af101a]/20">
                <h4 class="font-['Lexend'] font-bold mb-2">Pengumuman Massal?</h4>
                <p class="text-sm opacity-80 mb-4">Kirim satu pesan ke semua penyewa sekaligus dengan fitur Broadcast.</p>
                <a href="{{ route('admin.notifications.index') }}" class="inline-block px-4 py-2 bg-white text-[#d32f2f] rounded-lg text-sm font-bold hover:bg-red-50 transition-colors">Ke Halaman Siaran</a>
            </div>
        </div>
    </div>
</div>

<script>
function setTemplate(judul, pesan) {
    document.querySelector('[name="deskripsi"]').value = judul;
    document.querySelector('[name="pesan"]').value = pesan;
}
</script>
@endsection