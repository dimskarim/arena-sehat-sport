@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900 dark:text-white">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white">Pusat Notifikasi</h1>
            <p class="text-[16px] text-slate-500 dark:text-gray-400 mt-1">Kelola notifikasi individu dan kirim pengumuman massal ke semua penyewa.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="openBroadcastModal()" class="flex items-center gap-2 px-5 py-2.5 bg-red-600 dark:bg-red-700 text-white rounded-xl font-bold text-sm hover:opacity-90 shadow-lg shadow-red-800/20 active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                Kirim Pengumuman Massal
            </button>
            <a href="{{ route('admin.notifications.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 dark:border-gray-700 text-slate-900 dark:text-white rounded-xl font-semibold text-sm hover:bg-slate-50 dark:bg-gray-900 transition-colors shadow-sm">
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
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-slate-200 dark:border-gray-700 dark:border-gray-700 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-wider">Total Notifikasi</p>
                <p class="text-2xl font-black font-['Lexend']">{{ method_exists($items, 'total') ? $items->total() : count($items) }}</p>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-slate-200 dark:border-gray-700 dark:border-gray-700 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-wider">Belum Dibaca</p>
                <p class="text-2xl font-black font-['Lexend'] text-amber-600">{{ $items->where('is_read', 0)->count() }}</p>
            </div>
        </div>
        <div class="bg-red-600 dark:bg-red-700 p-6 rounded-xl shadow-lg shadow-red-900/20 flex items-center gap-4 cursor-pointer hover:opacity-90 transition-opacity" onclick="openBroadcastModal()">
            <div class="w-12 h-12 bg-white dark:bg-gray-800/20 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <div class="text-white">
                <p class="text-xs font-bold opacity-80 uppercase tracking-wider">Siaran Massal</p>
                <p class="text-base font-bold mt-0.5">Klik untuk kirim pengumuman</p>
            </div>
        </div>
    </div>

    {{-- Notification List (Cards) --}}
    <div class="grid grid-cols-1 gap-4">
        @forelse($items as $item)
            @php
                // Generate the link to mark as read and redirect
                $link = route('admin.notifications.read', $item->id);
            @endphp
            <a href="{{ $link }}" class="block bg-white dark:bg-gray-800 rounded-2xl border border-slate-200 dark:border-gray-700 dark:border-gray-700 shadow-sm hover:shadow-md hover:border-red-500/30 dark:hover:border-red-500/50 transition-all p-5 relative overflow-hidden group">
                <!-- Read indicator stripe -->
                @if(!$item->is_read)
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-500"></div>
                @else
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gray-400"></div>
                @endif
                
                <div class="flex items-start sm:items-center gap-4 flex-col sm:flex-row">
                    <!-- Icon -->
                    <div class="w-12 h-12 rounded-full bg-slate-50 dark:bg-gray-900 flex items-center justify-center shrink-0 group-hover:bg-red-600 dark:bg-red-700/10 transition-colors">
                        @if($item->booking_id)
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        @else
                            <svg class="w-6 h-6 text-slate-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-grow">
                        <div class="flex items-center justify-between gap-4 mb-1">
                            <h3 class="font-bold text-slate-900 dark:text-white text-base group-hover:text-red-600 dark:text-red-400 transition-colors">{{ $item->pesan ?? 'Notifikasi Baru' }}</h3>
                            <span class="text-xs font-semibold text-slate-500 dark:text-gray-400 shrink-0">{{ $item->created_at ? $item->created_at->diffForHumans() : '-' }}</span>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-gray-400 mb-3">{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                        
                        <div class="flex items-center flex-wrap gap-3">
                            <!-- Sender/User -->
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-gray-700 flex items-center justify-center text-slate-500 dark:text-gray-400 font-bold text-[10px]">
                                    {{ strtoupper(substr(optional($item->user)->name ?? 'U', 0, 2)) }}
                                </div>
                                <span class="text-xs font-medium text-slate-900 dark:text-white">{{ optional($item->user)->name ?? 'Sistem' }}</span>
                            </div>
                            
                            <!-- Booking ID Badge -->
                            @if($item->booking_id)
                                <div class="w-1 h-1 rounded-full bg-slate-200 dark:bg-gray-700"></div>
                                <span class="text-xs font-bold text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-900/20 px-2 py-0.5 rounded-md">Booking #{{ $item->booking_id }}</span>
                            @endif
                            
                            <!-- Read Status -->
                            @if(!$item->is_read)
                                <div class="w-1 h-1 rounded-full bg-slate-200 dark:bg-gray-700"></div>
                                <span class="text-xs font-bold text-green-600 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Belum Dibaca
                                </span>
                            @else
                                <div class="w-1 h-1 rounded-full bg-slate-200 dark:bg-gray-700"></div>
                                <span class="text-xs font-bold text-gray-500 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Sudah Dibaca
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Delete Button (Separate from link to avoid clicking both) -->
                    <div class="shrink-0 flex items-center gap-2 ml-auto sm:ml-0" onclick="event.preventDefault(); event.stopPropagation();">
                        <form action="{{ route('admin.notifications.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-red-50 text-slate-400 hover:text-red-600 transition-colors" title="Hapus Notifikasi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </a>
        @empty
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-slate-200 dark:border-gray-700 dark:border-gray-700 p-12 text-center shadow-sm">
                <div class="w-16 h-16 bg-slate-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>
                <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-1">Belum Ada Notifikasi</h3>
                <p class="text-sm text-slate-500 dark:text-gray-400">Saat ini belum ada data notifikasi yang masuk ke sistem.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6 px-6 py-4 bg-slate-50 dark:bg-gray-900 rounded-2xl border border-slate-200 dark:border-gray-700 dark:border-gray-700 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
        @if(method_exists($items, 'firstItem') && $items->hasPages())
        <p class="text-sm text-slate-500 dark:text-gray-400">
            Menampilkan <span class="font-bold text-slate-900 dark:text-white">{{ $items->firstItem() ?? 0 }}-{{ $items->lastItem() ?? 0 }}</span> 
            dari {{ number_format($items->total() ?? 0) }} notifikasi
        </p>
        {{ $items->links('components.pagination') }}
        @else
        <p class="text-sm text-slate-500 dark:text-gray-400">
            Menampilkan <span class="font-bold text-slate-900 dark:text-white">{{ $items->count() }}</span> notifikasi
        </p>
        @endif
    </div>
</div>

{{-- Modal: Kirim Pengumuman Massal --}}
<div id="broadcastModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div id="broadcastModalContent" class="w-full max-w-lg bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
        <div class="bg-gradient-to-r from-red-600 dark:from-red-800 to-red-800 dark:to-red-950 px-6 py-5 flex items-center justify-between">
            <div class="text-white">
                <h3 class="font-['Lexend'] font-bold text-lg">Kirim Pengumuman Massal</h3>
                <p class="text-sm opacity-80 mt-0.5">Pesan akan dikirim ke semua penyewa terdaftar</p>
            </div>
            <button onclick="closeBroadcastModal()" class="p-2 text-white/70 hover:text-white hover:bg-white dark:bg-gray-800/10 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('admin.notifications.store') }}" method="POST" class="p-6">
            @csrf
            {{-- Broadcast flag - controller/service should handle this --}}
            <input type="hidden" name="is_broadcast" value="1">
            <input type="hidden" name="user_id" value="0">

            <div class="mb-5">
                <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">Judul / Subjek Pengumuman <span class="text-[#ba1a1a]">*</span></label>
                <input type="text" name="deskripsi" required placeholder="Contoh: Diskon Kemerdekaan! 🎉"
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-gray-900 border border-slate-200 dark:border-gray-700 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all">
            </div>

            <div class="mb-5">
                <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">Isi Pesan <span class="text-[#ba1a1a]">*</span></label>
                <textarea name="pesan" required rows="4" placeholder="Tulis isi pengumuman di sini..."
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-gray-900 border border-slate-200 dark:border-gray-700 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all resize-none"></textarea>
            </div>

            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-700 mb-5 flex items-start gap-2">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Pengumuman ini akan dikirimkan ke <strong>semua pengguna</strong> yang terdaftar sebagai penyewa di platform ini.</span>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeBroadcastModal()" class="flex-1 py-3 rounded-xl border border-slate-200 dark:border-gray-700 dark:border-gray-700 text-sm font-semibold text-slate-500 dark:text-gray-400 hover:bg-slate-50 dark:bg-gray-900 transition-colors">Batal</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-red-600 dark:bg-red-700 text-white text-sm font-bold hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
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

