@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-[#1b1c1c]">Verifikasi Pembayaran</h1>
            <p class="text-[16px] text-[#5b403d] mt-1">Tinjau bukti transfer dan verifikasi setiap pembayaran yang masuk.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-7 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-7 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-red-800 font-semibold text-sm">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="md:col-span-2 bg-[#d32f2f] p-6 rounded-xl text-white shadow-lg shadow-[#af101a]/20 flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-xs font-bold opacity-80 uppercase tracking-wider">Menunggu Verifikasi</p>
                <h3 class="text-4xl font-bold mt-2">{{ $items->where('status', 'menunggu_verifikasi')->count() }}</h3>
                <p class="text-sm mt-3 opacity-80">Pembayaran membutuhkan persetujuan Admin</p>
            </div>
            <svg class="absolute -right-4 -bottom-4 w-36 h-36 opacity-10 rotate-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between">
            <p class="text-sm text-[#5b403d] font-semibold">Sudah Dibayar</p>
            <h3 class="text-3xl font-bold text-green-700 mt-1">{{ $items->where('status', 'paid')->count() }}</h3>
            <span class="text-xs text-green-600 font-bold mt-3 inline-flex items-center gap-1"><span class="w-2 h-2 bg-green-500 rounded-full"></span> Terverifikasi</span>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between">
            <p class="text-sm text-[#5b403d] font-semibold">Ditolak / Gagal</p>
            <h3 class="text-3xl font-bold text-slate-400 mt-1">{{ $items->whereIn('status', ['failed', 'rejected'])->count() }}</h3>
            <span class="text-xs text-red-500 font-bold mt-3 inline-flex items-center gap-1"><span class="w-2 h-2 bg-red-400 rounded-full"></span> Perlu upload ulang</span>
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm p-5 mb-6">
        <form method="GET" action="{{ route('admin.payments.index') }}" class="flex flex-col sm:flex-row items-end gap-4">
            <div class="flex-1">
                <label class="text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-1.5 block">Filter Status</label>
                <select name="status" class="w-full px-4 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] outline-none appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="menunggu_verifikasi" {{ request('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2.5 bg-[#1b1c1c] text-white rounded-xl font-bold text-sm hover:bg-zinc-700 transition-colors">Terapkan</button>
                <a href="{{ route('admin.payments.index') }}" class="px-6 py-2.5 bg-white border border-[#e4beba] text-[#5b403d] rounded-xl font-bold text-sm hover:bg-[#f6f3f2] transition-colors">Reset</a>
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0eded] text-[#5b403d] text-xs font-bold uppercase tracking-wider border-b border-[#e4beba]">
                        <th class="px-6 py-4">ID / Booking</th>
                        <th class="px-6 py-4">Penyewa</th>
                        <th class="px-6 py-4">Metode & Tanggal</th>
                        <th class="px-6 py-4">Bukti Bayar</th>
                        <th class="px-6 py-4 text-right">Jumlah</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba]">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] transition-colors group">
                        <td class="px-6 py-5">
                            <p class="text-sm font-bold text-[#1b1c1c]">#PAY-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-xs text-[#5b403d]">Booking #{{ $item->booking_id ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            @php $user = optional($item->booking)->user; @endphp
                            <p class="text-sm font-semibold text-[#1b1c1c]">{{ $user->name ?? '-' }}</p>
                            <p class="text-xs text-[#5b403d]">{{ $user->email ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm font-medium text-[#1b1c1c]">{{ $item->metode_pembayaran ?? $item->payment_method ?? 'Transfer Bank' }}</p>
                            <p class="text-xs text-[#5b403d]">
                                {{ $item->tanggal_payment ? \Carbon\Carbon::parse($item->tanggal_payment)->format('d M Y, H:i') : ($item->created_at ? $item->created_at->format('d M Y, H:i') : '-') }}
                            </p>
                        </td>
                        <td class="px-6 py-5">
                            @php $bukti = $item->bukti_pembayaran ?? $item->butki_payment ?? null; @endphp
                            @if($bukti)
                                <button type="button" onclick="openBuktiModal('{{ asset('storage/' . $bukti) }}')"
                                    class="flex items-center gap-1.5 text-xs font-bold text-[#af101a] bg-red-50 px-3 py-1.5 rounded-lg hover:bg-[#ffdad6] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Lihat Struk
                                </button>
                            @else
                                <span class="text-xs text-slate-400 italic">Belum ada struk</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <p class="text-sm font-bold text-[#1b1c1c]">Rp {{ number_format($item->jumlah_bayar ?? optional($item->booking)->total_harga ?? 0, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-6 py-5">
                            @php $status = strtolower($item->status ?? 'pending'); @endphp
                            @if($status === 'paid')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700"><span class="w-1.5 h-1.5 bg-green-600 rounded-full"></span> Terverifikasi</span>
                            @elseif($status === 'menunggu_verifikasi')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 animate-pulse"><span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span> Menunggu Verifikasi</span>
                            @elseif(in_array($status, ['failed', 'rejected']))
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700"><span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span> Ditolak</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600"><span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span> {{ ucfirst($status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if(in_array(strtolower($item->status ?? ''), ['menunggu_verifikasi', 'pending']))
                                    <form action="{{ route('admin.payments.update', $item->id) }}" method="POST" class="inline-block">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="paid">
                                        <input type="hidden" name="booking_id" value="{{ $item->booking_id }}">
                                        <button type="submit" onclick="return confirm('Verifikasi dan terima pembayaran ini?')"
                                            class="flex items-center gap-1 text-xs font-bold text-green-700 bg-green-50 border border-green-200 px-3 py-1.5 rounded-lg hover:bg-green-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Terima
                                        </button>
                                    </form>
                                    <form id="tolak-form-{{ $item->id }}" action="{{ route('admin.payments.update', $item->id) }}" method="POST" class="inline-block">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="failed">
                                        <input type="hidden" name="booking_id" value="{{ $item->booking_id }}">
                                        <input type="hidden" name="alasan_penolakan" id="alasan-{{ $item->id }}">
                                        <button type="button" onclick="openTolakModal('{{ $item->id }}')"
                                            class="flex items-center gap-1 text-xs font-bold text-red-700 bg-red-50 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Tolak
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.payments.edit', $item->id) }}" class="text-[#af101a] font-bold text-xs hover:bg-[#ffdad6] px-3 py-1.5 rounded-lg transition-colors">Edit</a>
                                    <form action="{{ route('admin.payments.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-500 font-bold text-xs hover:bg-red-50 hover:text-red-700 px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-[#5b403d]">
                            <svg class="w-12 h-12 mx-auto mb-2 text-[#e4beba]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="font-medium">Belum ada data pembayaran.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-[#f6f3f2] flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-[#e4beba]">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs text-[#5b403d]">Menampilkan <span class="font-bold text-[#1b1c1c]">{{ $items->firstItem() }} - {{ $items->lastItem() }}</span> dari {{ number_format($items->total()) }} data</p>
            @endif
            @if(method_exists($items, 'links')) {{ $items->links() }} @endif
        </div>
    </div>
</div>

{{-- Modal: Lihat Bukti --}}
<div id="buktiModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div id="buktiModalContent" class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h3 class="font-['Lexend'] font-bold text-slate-900">Bukti Pembayaran</h3>
            <button onclick="closeBuktiModal()" class="p-2 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-4"><img id="buktiImg" src="" alt="Bukti" class="w-full rounded-xl object-contain max-h-[70vh]"></div>
    </div>
</div>

{{-- Modal: Tolak --}}
<div id="tolakModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div id="tolakModalContent" class="w-full max-w-md bg-white rounded-2xl shadow-xl p-6 transform scale-95 opacity-0 transition-all duration-300">
        <div class="flex items-center justify-center mb-4">
            <div class="h-14 w-14 bg-red-50 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-slate-900 mb-1 font-['Lexend']">Tolak Pembayaran?</h3>
        <p class="text-center text-sm text-slate-500 mb-5">Berikan alasan agar penyewa dapat mengupload ulang struk yang benar.</p>
        <textarea id="tolakAlasan" rows="3" placeholder="Contoh: Struk buram, nominal tidak sesuai..." class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:border-[#af101a] outline-none resize-none"></textarea>
        <div class="flex gap-3 mt-5">
            <button type="button" onclick="closeTolakModal()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">Batal</button>
            <button type="button" id="confirmTolakBtn" onclick="submitTolak()" class="flex-1 py-2.5 rounded-xl bg-[#af101a] text-white text-sm font-bold hover:bg-red-800 transition-colors">Ya, Tolak</button>
        </div>
    </div>
</div>

<script>
let _tolakId = null;
function openBuktiModal(src) {
    document.getElementById('buktiImg').src = src;
    const m = document.getElementById('buktiModal'), c = document.getElementById('buktiModalContent');
    m.classList.remove('hidden'); m.classList.add('flex'); void m.offsetWidth;
    m.classList.remove('opacity-0'); c.classList.remove('scale-95','opacity-0'); c.classList.add('scale-100','opacity-100');
}
function closeBuktiModal() {
    const m = document.getElementById('buktiModal'), c = document.getElementById('buktiModalContent');
    m.classList.add('opacity-0'); c.classList.remove('scale-100','opacity-100'); c.classList.add('scale-95','opacity-0');
    setTimeout(() => { m.classList.add('hidden'); m.classList.remove('flex'); }, 300);
}
function openTolakModal(id) {
    _tolakId = id; document.getElementById('tolakAlasan').value = '';
    const m = document.getElementById('tolakModal'), c = document.getElementById('tolakModalContent');
    m.classList.remove('hidden'); m.classList.add('flex'); void m.offsetWidth;
    m.classList.remove('opacity-0'); c.classList.remove('scale-95','opacity-0'); c.classList.add('scale-100','opacity-100');
}
function closeTolakModal() {
    const m = document.getElementById('tolakModal'), c = document.getElementById('tolakModalContent');
    m.classList.add('opacity-0'); c.classList.remove('scale-100','opacity-100'); c.classList.add('scale-95','opacity-0');
    setTimeout(() => { m.classList.add('hidden'); m.classList.remove('flex'); }, 300);
}
function submitTolak() {
    if (_tolakId) {
        document.getElementById('alasan-' + _tolakId).value = document.getElementById('tolakAlasan').value;
        document.getElementById('tolak-form-' + _tolakId).submit();
    }
    closeTolakModal();
}
document.getElementById('buktiModal').addEventListener('click', function(e){ if(e.target===this) closeBuktiModal(); });
document.getElementById('tolakModal').addEventListener('click', function(e){ if(e.target===this) closeTolakModal(); });
</script>
@endsection