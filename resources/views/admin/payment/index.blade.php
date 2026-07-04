@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c] dark:text-white">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-[#1b1c1c] dark:text-white">Daftar Pembayaran</h1>
            <p class="text-[16px] text-[#5b403d] dark:text-gray-400 mt-1">Kelola data pembayaran, tinjau bukti transfer, dan verifikasi transaksi yang masuk.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-7 py-4 shadow-sm rounded-r-xl dark:bg-green-900/20 dark:border-green-500">
        <p class="leading-relaxed text-green-800 dark:text-green-400 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-7 py-4 shadow-sm rounded-r-xl dark:bg-red-900/20 dark:border-red-500">
        <p class="leading-relaxed text-red-800 dark:text-red-400 font-semibold text-sm">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="md:col-span-2 bg-[#d32f2f] dark:bg-red-900/80 p-6 rounded-xl text-white shadow-lg shadow-[#af101a]/20 dark:shadow-none flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-xs font-bold opacity-80 uppercase tracking-wider">Menunggu Verifikasi</p>
                <h3 class="text-4xl font-bold mt-2">{{ $items->where('status', 'menunggu_verifikasi')->count() }}</h3>
                <p class="text-sm mt-3 opacity-80">Pembayaran membutuhkan persetujuan Admin</p>
            </div>
            <svg class="absolute -right-4 -bottom-4 w-36 h-36 opacity-10 rotate-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-[#e4beba] dark:border-gray-700 shadow-sm flex flex-col justify-between">
            <p class="text-sm text-[#5b403d] dark:text-gray-400 font-semibold">Sudah Dibayar</p>
            <h3 class="text-3xl font-bold text-green-700 dark:text-green-500 mt-1">{{ $items->where('status', 'paid')->count() }}</h3>
            <span class="text-xs text-green-600 dark:text-green-400 font-bold mt-3 inline-flex items-center gap-1"><span class="w-2 h-2 bg-green-500 rounded-full"></span> Terverifikasi</span>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-[#e4beba] dark:border-gray-700 shadow-sm flex flex-col justify-between">
            <p class="text-sm text-[#5b403d] dark:text-gray-400 font-semibold">Ditolak / Gagal</p>
            <h3 class="text-3xl font-bold text-slate-400 dark:text-gray-500 mt-1">{{ $items->whereIn('status', ['failed', 'rejected'])->count() }}</h3>
            <span class="text-xs text-red-500 dark:text-red-400 font-bold mt-3 inline-flex items-center gap-1"><span class="w-2 h-2 bg-red-400 rounded-full"></span> Perlu upload ulang</span>
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-[#e4beba] dark:border-gray-700 shadow-sm p-4 mb-6">
        <form id="filterForm" method="GET" action="{{ route('admin.payments.index') }}" class="flex flex-wrap items-center gap-3 w-full">
            <div class="relative flex-1 min-w-[250px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-[#5b403d] dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama penyewa..." 
                    class="w-full pl-10 pr-10 py-2 bg-[#fcf9f8] dark:bg-gray-700/50 rounded-xl border border-[#e4beba] dark:border-gray-600 text-sm dark:text-white focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all">
                @if(request('search'))
                <a href="{{ route('admin.payments.index', ['status' => request('status')]) }}" class="absolute inset-y-0 right-8 pr-2 flex items-center text-gray-400 hover:text-red-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </a>
                @endif
                <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-[#af101a] transition-colors">
                    <span class="sr-only">Search</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>

            <div class="relative min-w-[200px] z-40">
                <!-- Hidden Select -->
                <select name="status" id="statusFilter" class="hidden">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="menunggu_verifikasi" {{ request('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Ditolak</option>
                </select>

                <!-- Custom Dropdown Button -->
                <div id="custom-status-btn" class="flex items-center justify-between w-full px-4 py-2.5 bg-[#fcf9f8] hover:bg-white/[0.12] rounded-xl border border-[#e4beba] text-sm transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white">
                    <span class="text-slate-700 dark:text-white font-medium truncate" id="custom-status-text">
                        @php
                            $statusText = [
                                '' => 'Semua Status',
                                'pending' => 'Pending',
                                'menunggu_verifikasi' => 'Menunggu Verifikasi',
                                'paid' => 'Paid',
                                'failed' => 'Ditolak',
                            ];
                            echo $statusText[request('status')] ?? 'Semua Status';
                        @endphp
                    </span>
                    <svg id="custom-status-icon" class="w-4 h-4 text-slate-500 transition-transform duration-200 ml-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>

                <!-- Custom Dropdown Menu -->
                <div id="custom-status-menu" class="absolute left-0 right-0 sm:right-auto top-[calc(100%+0.5rem)] sm:w-[220px] bg-white dark:bg-gray-800 rounded-xl shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-[#e4beba] dark:border-gray-700 hidden z-50">
                    <!-- Upward Pointer -->
                    <div class="absolute -top-1.5 left-6 w-3 h-3 bg-white dark:bg-gray-800 transform rotate-45 border-t border-l border-[#e4beba] dark:border-gray-700"></div>

                    <ul class="relative z-10 py-1" id="custom-status-options">
                        <li data-value="" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == '' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-t-xl">Semua Status</li>
                        <li data-value="pending" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'pending' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }}">Pending</li>
                        <li data-value="menunggu_verifikasi" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'menunggu_verifikasi' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }}">Menunggu Verifikasi</li>
                        <li data-value="paid" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'paid' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }}">Paid</li>
                        <li data-value="failed" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'failed' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-b-xl">Ditolak</li>
                    </ul>
                </div>
            </div>
            @if(request('status') || request('search'))
            <a href="{{ route('admin.payments.index') }}" class="text-xs text-slate-400 dark:text-gray-500 hover:text-red-700 dark:hover:text-red-400 flex items-center gap-1 transition-colors ml-auto font-bold shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg> Reset Filter
            </a>
            @endif
        </form>
    </div>

    {{-- Data Table --}}
    <div id="table-container" class="bg-white dark:bg-gray-800 rounded-2xl border border-[#e4beba] dark:border-gray-700 shadow-sm overflow-hidden transition-opacity duration-300 relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0eded] dark:bg-gray-900/50 text-[#5b403d] dark:text-gray-400 text-xs font-bold uppercase tracking-wider border-b border-[#e4beba] dark:border-gray-700">
                        <th class="px-6 py-4">ID / Booking</th>
                        <th class="px-6 py-4">Penyewa</th>
                        <th class="px-6 py-4">Metode & Tanggal</th>
                        <th class="px-6 py-4">Bukti Bayar</th>
                        <th class="px-6 py-4 text-right">Jumlah</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba] dark:divide-gray-700">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] dark:hover:bg-gray-700/20 transition-colors group">
                        <td class="px-6 py-5">
                            <p class="text-sm font-bold text-[#1b1c1c] dark:text-white">#PAY-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-xs text-[#5b403d] dark:text-gray-400">Booking #{{ $item->booking_id ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            @php $user = optional($item->booking)->user; @endphp
                            <p class="text-sm font-semibold text-[#1b1c1c] dark:text-white">{{ $user->name ?? '-' }}</p>
                            <p class="text-xs text-[#5b403d] dark:text-gray-400">{{ $user->email ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm font-medium text-[#1b1c1c] dark:text-white">{{ $item->metode_pembayaran ?? $item->payment_method ?? 'Transfer Bank' }}</p>
                            <p class="text-xs text-[#5b403d] dark:text-gray-400">
                                {{ $item->tanggal_payment ? \Carbon\Carbon::parse($item->tanggal_payment)->format('d M Y, H:i') : ($item->created_at ? $item->created_at->format('d M Y, H:i') : '-') }}
                            </p>
                        </td>
                        <td class="px-6 py-5">
                            @php $bukti = $item->bukti_pembayaran ?? $item->butki_payment ?? null; @endphp
                            @if($bukti)
                                <button type="button" onclick="openBuktiModal('{{ asset('storage/' . $bukti) }}')"
                                    class="flex items-center gap-1.5 text-xs font-bold text-[#af101a] dark:text-red-400 bg-red-50 dark:bg-red-900/30 px-3 py-1.5 rounded-lg hover:bg-[#ffdad6] dark:hover:bg-red-900/50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Lihat Struk
                                </button>
                            @else
                                <span class="text-xs text-slate-400 dark:text-gray-500 italic">Belum ada struk</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <p class="text-sm font-bold text-[#1b1c1c] dark:text-white">Rp {{ number_format($item->jumlah_bayar ?? optional($item->booking)->total_harga ?? 0, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-6 py-5">
                            @php $status = strtolower($item->status ?? 'pending'); @endphp
                            @if($status === 'paid')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400"><span class="w-1.5 h-1.5 bg-green-600 dark:bg-green-400 rounded-full"></span> Terverifikasi</span>
                            @elseif($status === 'menunggu_verifikasi')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 animate-pulse"><span class="w-1.5 h-1.5 bg-amber-500 dark:bg-amber-400 rounded-full"></span> Menunggu Verifikasi</span>
                            @elseif(in_array($status, ['failed', 'rejected']))
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400"><span class="w-1.5 h-1.5 bg-red-600 dark:bg-red-400 rounded-full"></span> Ditolak</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400"><span class="w-1.5 h-1.5 bg-gray-400 dark:bg-gray-500 rounded-full"></span> {{ ucfirst($status) }}</span>
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
                                            class="flex items-center gap-1 text-xs font-bold text-green-700 bg-green-50 border border-green-200 px-3 py-1.5 rounded-lg hover:bg-green-100 transition-colors dark:text-green-400 dark:bg-green-900/30 dark:border-green-900/50 dark:hover:bg-green-900/50">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Terima
                                        </button>
                                    </form>
                                    <form id="tolak-form-{{ $item->id }}" action="{{ route('admin.payments.update', $item->id) }}" method="POST" class="inline-block">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="failed">
                                        <input type="hidden" name="booking_id" value="{{ $item->booking_id }}">
                                        <input type="hidden" name="alasan_penolakan" id="alasan-{{ $item->id }}">
                                        <button type="button" onclick="openTolakModal('{{ $item->id }}')"
                                            class="flex items-center gap-1 text-xs font-bold text-red-700 bg-red-50 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100 transition-colors dark:text-red-400 dark:bg-red-900/30 dark:border-red-900/50 dark:hover:bg-red-900/50">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Tolak
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.payments.edit', $item->id) }}" class="text-[#af101a] font-bold text-xs hover:bg-[#ffdad6] px-3 py-1.5 rounded-lg transition-colors dark:text-red-400 dark:hover:bg-red-900/30">Edit</a>
                                    <form action="{{ route('admin.payments.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-500 font-bold text-xs hover:bg-red-50 hover:text-red-700 px-3 py-1.5 rounded-lg transition-colors dark:text-gray-400 dark:hover:bg-red-900/30 dark:hover:text-red-400">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-[#5b403d] dark:text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-2 text-[#e4beba] dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="font-medium">Belum ada data pembayaran.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-[#f6f3f2] dark:bg-gray-800/50 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-[#e4beba] dark:border-gray-700">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs text-[#5b403d] dark:text-gray-400">Menampilkan <span class="font-bold text-[#1b1c1c] dark:text-white">{{ $items->firstItem() }} - {{ $items->lastItem() }}</span> dari {{ number_format($items->total()) }} data</p>
            @endif
            @if(method_exists($items, 'links')) {{ $items->links('components.pagination') }} @endif
        </div>
    </div>
</div>

{{-- Modal: Lihat Bukti --}}
<div id="buktiModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div id="buktiModalContent" class="w-full max-w-lg bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 dark:border dark:border-gray-700">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 dark:border-gray-700">
            <h3 class="font-['Lexend'] font-bold text-slate-900 dark:text-white">Bukti Pembayaran</h3>
            <button onclick="closeBuktiModal()" class="p-2 text-slate-400 hover:text-slate-700 hover:bg-slate-100 dark:hover:bg-gray-700 dark:hover:text-gray-300 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-4"><img id="buktiImg" src="" alt="Bukti" class="w-full rounded-xl object-contain max-h-[70vh]"></div>
    </div>
</div>

{{-- Modal: Tolak --}}
<div id="tolakModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div id="tolakModalContent" class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 transform scale-95 opacity-0 transition-all duration-300 dark:border dark:border-gray-700">
        <div class="flex items-center justify-center mb-4">
            <div class="h-14 w-14 bg-red-50 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-slate-900 dark:text-white mb-1 font-['Lexend']">Tolak Pembayaran?</h3>
        <p class="text-center text-sm text-slate-500 dark:text-gray-400 mb-5">Berikan alasan agar penyewa dapat mengupload ulang struk yang benar.</p>
        <textarea id="tolakAlasan" rows="3" placeholder="Contoh: Struk buram, nominal tidak sesuai..." class="w-full px-4 py-3 border border-slate-200 dark:border-gray-600 dark:bg-gray-700/50 dark:text-white rounded-xl text-sm focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none resize-none"></textarea>
        <div class="flex gap-3 mt-5">
            <button type="button" onclick="closeTolakModal()" class="flex-1 py-2.5 rounded-xl border border-slate-200 dark:border-gray-600 text-sm font-semibold text-slate-600 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-gray-700 transition-colors">Batal</button>
            <button type="button" id="confirmTolakBtn" onclick="submitTolak()" class="flex-1 py-2.5 rounded-xl bg-[#af101a] dark:bg-red-600 text-white text-sm font-bold hover:bg-red-800 dark:hover:bg-red-700 transition-colors">Ya, Tolak</button>
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

// AJAX Filter & Pagination
const filterForm = document.getElementById('filterForm');
const tableContainer = document.getElementById('table-container');

async function fetchTableData(url) {
    tableContainer.style.opacity = '0.5';
    tableContainer.style.pointerEvents = 'none';
    
    try {
        const response = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const html = await response.text();
        
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        const newTable = doc.getElementById('table-container');
        if (newTable) {
            tableContainer.innerHTML = newTable.innerHTML;
        }
        
        // Update browser URL
        window.history.pushState({}, '', url);
    } catch (e) {
        console.error('Error fetching data:', e);
    } finally {
        tableContainer.style.opacity = '1';
        tableContainer.style.pointerEvents = 'auto';
    }
}

filterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const url = new URL(this.action);
    const formData = new FormData(this);
    formData.forEach((value, key) => {
        if(value) url.searchParams.append(key, value);
    });
    fetchTableData(url.toString());
});

document.getElementById('statusFilter').addEventListener('change', function() {
    filterForm.dispatchEvent(new Event('submit'));
});

document.addEventListener('click', function(e) {
    const link = e.target.closest('#table-container nav a'); // Targets Laravel pagination links
    if (link) {
        e.preventDefault();
        fetchTableData(link.href);
    }
});

let typingTimer;
filterForm.querySelector('input[name="search"]').addEventListener('input', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
        filterForm.dispatchEvent(new Event('submit'));
    }, 400); // 400ms typing delay
});

// Custom Status Dropdown Logic
const statusBtn = document.getElementById('custom-status-btn');
const statusMenu = document.getElementById('custom-status-menu');
const statusIcon = document.getElementById('custom-status-icon');
const statusSelect = document.getElementById('statusFilter');
const statusText = document.getElementById('custom-status-text');
const statusOptions = document.getElementById('custom-status-options')?.querySelectorAll('li');

if (statusBtn && statusMenu) {
    statusBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        statusMenu.classList.toggle('hidden');
        if (statusMenu.classList.contains('hidden')) {
            statusIcon.classList.remove('rotate-180');
        } else {
            statusIcon.classList.add('rotate-180');
        }
    });

    document.addEventListener('click', function(e) {
        if (!statusBtn.contains(e.target) && !statusMenu.contains(e.target)) {
            statusMenu.classList.add('hidden');
            statusIcon.classList.remove('rotate-180');
        }
    });

    if (statusOptions) {
        statusOptions.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.innerText;
                
                statusSelect.value = value;
                statusText.innerText = text;
                
                // Update active styles
                statusOptions.forEach(opt => {
                    opt.classList.remove('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400', 'font-bold');
                    opt.classList.add('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                });
                
                this.classList.remove('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                this.classList.add('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400', 'font-bold');
                
                // Dispatch change event to trigger AJAX filter
                statusSelect.dispatchEvent(new Event('change', { bubbles: true }));
                
                statusMenu.classList.add('hidden');
                statusIcon.classList.remove('rotate-180');
            });
        });
    }
}

</script>
@endsection
