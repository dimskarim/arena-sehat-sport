@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-[#1b1c1c]">Pusat Notifikasi</h1>
            <p class="text-[16px] text-[#5b403d] mt-1">Kelola notifikasi individu dan kirim pengumuman massal ke semua penyewa.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="openBroadcastModal()" class="flex items-center gap-2 px-5 py-2.5 bg-[#d32f2f] text-white rounded-xl font-bold text-sm hover:opacity-90 shadow-lg shadow-red-800/20 active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                Kirim Pengumuman Massal
            </button>
            <a href="{{ route('admin.notifications.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#e4beba] text-[#1b1c1c] rounded-xl font-semibold text-sm hover:bg-[#f6f3f2] transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Tambah Notifikasi
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-7 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-[#fdcbd0] rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-[#d32f2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] uppercase tracking-wider">Total Notifikasi</p>
                <p class="text-2xl font-black font-['Lexend']">{{ method_exists($items, 'total') ? $items->total() : count($items) }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] uppercase tracking-wider">Belum Dibaca</p>
                <p class="text-2xl font-black font-['Lexend'] text-amber-600">{{ $items->where('is_read', 0)->count() }}</p>
            </div>
        </div>
        <div class="bg-[#d32f2f] p-6 rounded-xl shadow-lg shadow-[#af101a]/20 flex items-center gap-4 cursor-pointer hover:opacity-90 transition-opacity" onclick="openBroadcastModal()">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <div class="text-white">
                <p class="text-xs font-bold opacity-80 uppercase tracking-wider">Siaran Massal</p>
                <p class="text-base font-bold mt-0.5">Klik untuk kirim pengumuman</p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0eded] text-[#5b403d] text-xs font-bold uppercase tracking-wider border-b border-[#e4beba]">
                        <th class="px-6 py-4">Penerima</th>
                        <th class="px-6 py-4">Pesan</th>
                        <th class="px-6 py-4">Booking</th>
                        <th class="px-6 py-4 text-center">Status Baca</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba]">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] transition-colors group {{ !$item->is_read ? 'bg-amber-50/30' : '' }}">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#d32f2f] flex items-center justify-center text-white font-bold text-xs shrink-0">
                                    {{ strtoupper(substr(optional($item->user)->name ?? 'U', 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#1b1c1c]">{{ optional($item->user)->name ?? '-' }}</p>
                                    <p class="text-xs text-[#5b403d]">{{ optional($item->user)->email ?? 'ID: '.$item->user_id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 max-w-xs">
                            <p class="text-sm text-[#1b1c1c] truncate font-medium">{{ $item->pesan ?? '-' }}</p>
                            @if($item->deskripsi)
                            <p class="text-xs text-[#5b403d] mt-0.5 truncate">{{ $item->deskripsi }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            @if($item->booking_id)
                                <a href="{{ route('admin.bookings.edit', $item->booking_id) }}" class="text-xs font-bold text-[#af101a] hover:underline">#{{ $item->booking_id }}</a>
                            @else
                                <span class="text-xs text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($item->is_read)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700"><span class="w-1.5 h-1.5 bg-green-600 rounded-full"></span> Dibaca</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 animate-pulse"><span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> Belum Dibaca</span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-xs text-[#5b403d]">{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</p>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.notifications.edit', $item->id) }}" class="text-[#af101a] font-bold text-xs hover:bg-[#ffdad6] px-3 py-1.5 rounded-lg transition-colors">Edit</a>
                                <form action="{{ route('admin.notifications.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-slate-500 font-bold text-xs hover:bg-red-50 hover:text-red-700 px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-[#5b403d]">
                            <svg class="w-12 h-12 mx-auto mb-2 text-[#e4beba]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            <p class="font-medium">Belum ada data notifikasi.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-[#f6f3f2] flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-[#e4beba]">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs text-[#5b403d]">Menampilkan <span class="font-bold text-[#1b1c1c]">{{ $items->firstItem() }} - {{ $items->lastItem() }}</span> dari {{ number_format($items->total()) }} notifikasi</p>
            @endif
            @if(method_exists($items, 'links')) {{ $items->links() }} @endif
        </div>
    </div>
</div>

{{-- Modal: Kirim Pengumuman Massal --}}
<div id="broadcastModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div id="broadcastModalContent" class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
        <div class="bg-gradient-to-r from-[#d32f2f] to-[#af101a] px-6 py-5 flex items-center justify-between">
            <div class="text-white">
                <h3 class="font-['Lexend'] font-bold text-lg">Kirim Pengumuman Massal</h3>
                <p class="text-sm opacity-80 mt-0.5">Pesan akan dikirim ke semua penyewa terdaftar</p>
            </div>
            <button onclick="closeBroadcastModal()" class="p-2 text-white/70 hover:text-white hover:bg-white/10 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('admin.notifications.store') }}" method="POST" class="p-6">
            @csrf
            {{-- Broadcast flag - controller/service should handle this --}}
            <input type="hidden" name="is_broadcast" value="1">
            <input type="hidden" name="user_id" value="0">

            <div class="mb-5">
                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Judul / Subjek Pengumuman <span class="text-[#ba1a1a]">*</span></label>
                <input type="text" name="deskripsi" required placeholder="Contoh: Diskon Kemerdekaan! 🎉"
                    class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all">
            </div>

            <div class="mb-5">
                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Isi Pesan <span class="text-[#ba1a1a]">*</span></label>
                <textarea name="pesan" required rows="4" placeholder="Tulis isi pengumuman di sini..."
                    class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all resize-none"></textarea>
            </div>

            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-700 mb-5 flex items-start gap-2">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Pengumuman ini akan dikirimkan ke <strong>semua pengguna</strong> yang terdaftar sebagai penyewa di platform ini.</span>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeBroadcastModal()" class="flex-1 py-3 rounded-xl border border-[#e4beba] text-sm font-semibold text-[#5b403d] hover:bg-[#f6f3f2] transition-colors">Batal</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-[#d32f2f] text-white text-sm font-bold hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openBroadcastModal() {
    const m = document.getElementById('broadcastModal'), c = document.getElementById('broadcastModalContent');
    m.classList.remove('hidden'); m.classList.add('flex'); void m.offsetWidth;
    m.classList.remove('opacity-0'); c.classList.remove('scale-95','opacity-0'); c.classList.add('scale-100','opacity-100');
}
function closeBroadcastModal() {
    const m = document.getElementById('broadcastModal'), c = document.getElementById('broadcastModalContent');
    m.classList.add('opacity-0'); c.classList.remove('scale-100','opacity-100'); c.classList.add('scale-95','opacity-0');
    setTimeout(() => { m.classList.add('hidden'); m.classList.remove('flex'); }, 300);
}
document.getElementById('broadcastModal').addEventListener('click', function(e){ if(e.target===this) closeBroadcastModal(); });
</script>
@endsection
