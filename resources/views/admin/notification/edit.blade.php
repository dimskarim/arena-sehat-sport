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
                <span class="font-semibold text-[#1b1c1c]">Edit Notifikasi</span>
            </div>
            <h1 class="font-['Lexend'] text-3xl font-bold text-[#1b1c1c] tracking-tight">Edit Notifikasi</h1>
            <p class="text-[#5b403d] mt-1 text-sm">Perbarui isi pesan atau detail notifikasi ini.</p>
        </div>
        <button type="submit" form="editNotifForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 shadow-lg shadow-red-900/20 active:scale-95 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Simpan Perubahan
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm p-8">
                <form id="editNotifForm" action="{{ route('admin.notifications.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                <option value="{{ $user->id }}" {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
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
                                <option value="{{ $booking->id }}" {{ old('booking_id', $item->booking_id) == $booking->id ? 'selected' : '' }}>
                                    #{{ $booking->id }} — {{ optional($booking->user)->name ?? 'User' }} — {{ optional($booking->lapangan)->name ?? 'Lapangan' }} — {{ ucfirst($booking->status) }}
                                </option>
                            @endforeach
                        </select>
                        @error('booking_id') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Judul / Deskripsi --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Judul / Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ old('deskripsi', $item->deskripsi) }}" placeholder="Contoh: Konfirmasi Pembayaran"
                            class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all">
                        @error('deskripsi') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Pesan --}}
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Isi Pesan <span class="text-[#ba1a1a]">*</span></label>
                        <textarea name="pesan" required rows="5" placeholder="Tulis pesan notifikasi di sini..."
                            class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all resize-none">{{ old('pesan', $item->pesan) }}</textarea>
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
                            <button type="button" onclick="setTemplate('Pembayaran Ditolak', 'Mohon maaf, bukti pembayaran Anda ditolak karena gambar tidak jelas. Silakan upload ulang struk yang valid.')"
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

        {{-- Sidebar Info --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm p-6">
                <h4 class="font-['Lexend'] font-bold text-[#1b1c1c] mb-4">Detail Notifikasi</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-[#5b403d]">ID Notifikasi</span>
                        <span class="font-bold text-[#1b1c1c]">#{{ $item->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#5b403d]">Status Baca</span>
                        <span class="font-bold {{ $item->is_read ? 'text-green-600' : 'text-amber-600' }}">{{ $item->is_read ? 'Sudah Dibaca' : 'Belum Dibaca' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#5b403d]">Dibuat</span>
                        <span class="font-medium text-[#1b1c1c]">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm p-6">
                <h4 class="font-['Lexend'] font-bold text-[#1b1c1c] mb-4">Hapus Notifikasi</h4>
                <p class="text-sm text-[#5b403d] mb-4">Tindakan ini tidak bisa dibatalkan.</p>
                <form action="{{ route('admin.notifications.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-red-50 text-[#ba1a1a] border border-red-200 text-sm font-bold hover:bg-red-100 transition-colors">
                        Hapus Notifikasi Ini
                    </button>
                </form>
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