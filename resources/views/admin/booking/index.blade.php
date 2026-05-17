@extends('layouts.app')

@section('content')


<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h2 class="font-['Lexend'] text-[32px] font-semibold tracking-tight leading-[1.3] text-[#1b1c1c]">Manajemen Reservasi</h2>
            <p class="text-[16px] text-[#5b403d] mt-1">Tinjau dan kelola seluruh reservasi lapangan yang masuk.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.bookings.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#e4beba] rounded-xl text-[14px] font-semibold hover:bg-[#f6f3f2] transition-colors active:scale-95 text-[#1b1c1c]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Reservasi
            </a>
            <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#e4beba] rounded-xl text-[14px] font-semibold hover:bg-[#f6f3f2] transition-colors active:scale-95 text-[#1b1c1c]">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Ekspor CSV
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 flex w-full border-l-4 border-green-500 bg-green-50 px-7 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">
            {{ session('success') }}
        </p>
    </div>
    @endif

    <!-- Stats Overview (Asymmetric/Bento Style) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="md:col-span-2 bg-[#d32f2f] p-6 rounded-xl text-[#fff2f0] shadow-lg shadow-[#af101a]/20 flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-[14px] font-semibold opacity-80 uppercase tracking-wider text-xs">Total Pendapatan (Bulan Ini)</p>
                <h3 class="text-4xl font-bold mt-2">Rp 7.500.000</h3>
                <p class="text-sm mt-4 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                    </svg>
                    12% peningkatan dari bulan lalu
                </p>
            </div>
            <svg class="absolute -right-4 -bottom-4 w-36 h-36 opacity-10 rotate-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between">
            <div>
                <p class="text-sm text-[#5b403d] font-semibold text-[14px]">Reservasi Aktif</p>
                <h3 class="text-3xl font-bold text-[#1b1c1c] mt-1">128</h3>
            </div>
            <div class="mt-4 flex -space-x-2">
                <img alt="User 1" class="w-8 h-8 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=U1&background=FFCDD2&color=D32F2F&size=32" />
                <img alt="User 2" class="w-8 h-8 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=U2&background=E8D5C4&color=795358&size=32" />
                <div class="w-8 h-8 rounded-full border-2 border-white bg-zinc-100 flex items-center justify-center text-[10px] font-bold text-zinc-600">+120</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between">
            <div>
                <p class="text-sm text-[#5b403d] font-semibold text-[14px]">Menunggu Persetujuan</p>
                <h3 class="text-3xl font-bold text-[#ba1a1a] mt-1">14</h3>
            </div>
            <button class="text-[#af101a] font-bold text-sm text-left hover:underline">Lihat semua antrean</button>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm overflow-hidden mb-8">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="p-6 border-b border-[#e4beba]">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block">Tanggal Reservasi</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#5b403d]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <input name="date" value="{{ request('date') }}" class="w-full pl-10 pr-4 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all" type="date" />
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block">Status</label>
                        <select name="status" class="w-full px-4 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all appearance-none cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block">Venue / Lapangan</label>
                        <select name="venue_id" class="w-full px-4 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all appearance-none cursor-pointer">
                            <option value="">Semua Lapangan</option>
                        </select>
                    </div>
                </div>
                <div class="lg:pt-6">
                    <button type="submit" class="w-full lg:w-auto px-8 py-2.5 bg-[#1b1c1c] text-[#fcf9f8] rounded-xl font-bold hover:bg-zinc-800 transition-colors active:scale-95">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Content -->
    <div class="overflow-x-auto bg-white rounded-t-xl border border-[#e4beba] border-b-0">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#f0eded] text-[#5b403d] text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">Pengguna</th>
                    <th class="px-6 py-4">Venue/Lapangan</th>
                    <th class="px-6 py-4">Tanggal & Waktu</th>
                    <th class="px-6 py-4 text-right">Total Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e4beba]">
                @forelse($items as $item)
                <tr class="hover:bg-[#f6f3f2] transition-colors group">
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        <div class="flex items-center gap-3">
                            <div class="text-sm font-bold w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-[#af101a]">
                                {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#1b1c1c]">{{ $item->user->name ?? '-' }}</p>
                                <p class="text-xs text-[#5b403d]">{{ $item->user->email ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        <p class="text-sm font-medium text-[#1b1c1c]">{{ $item->lapangan->name ?? '-' }}</p>
                        <p class="text-xs text-[#5b403d]">{{ $item->lapangan->kategori->name ?? 'Venue' }}</p>
                    </td>
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        <p class="text-sm font-medium text-[#1b1c1c]">{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d M Y') }}</p>
                        <p class="text-xs text-[#5b403d]">{{ $item->waktu_mulai ?? '' }} - {{ $item->waktu_selesai ?? '' }}</p>
                    </td>
                    <td class="px-6 py-5 text-right text-sm font-bold text-[#1b1c1c] border-b border-[#e4beba]">
                        Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        @if(strtolower($item->status) == 'paid' || strtolower($item->status) == 'completed' || strtolower($item->status) == 'confirmed')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5"></span>
                            {{ ucfirst($item->status) }}
                        </span>
                        @elseif(strtolower($item->status) == 'pending')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-600 mr-1.5"></span>
                            Pending
                        </span>
                        @elseif(strtolower($item->status) == 'canceled' || strtolower($item->status) == 'cancelled')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-zinc-200 text-zinc-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 mr-1.5"></span>
                            Canceled
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-600 mr-1.5"></span>
                            {{ ucfirst($item->status) }}
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-center border-b border-[#e4beba]">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.bookings.edit', $item->id) }}" class="text-[#af101a] font-bold text-xs hover:bg-[#ffdad6] px-3 py-1.5 rounded-lg transition-colors">
                                Details
                            </a>
                            <form action="{{ route('admin.bookings.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-bold text-xs hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-[#5b403d]">Belum ada data pemesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-6 bg-[#f6f3f2] flex flex-col sm:flex-row items-center justify-between rounded-b-xl border border-[#e4beba] border-t-0">
        <div class="mb-4 sm:mb-0">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs font-medium text-[#5b403d]">Menampilkan {{ $items->firstItem() ?? 0 }} hingga {{ $items->lastItem() ?? 0 }} dari {{ $items->total() ?? 0 }} reservasi</p>
            @endif
        </div>
        <div>
            @if(method_exists($items, 'links'))
            {{ $items->links() }}
            @endif
        </div>
    </div>

    <!-- Promotion / Action Section (Bento Bottom) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="bg-zinc-900 text-white p-8 rounded-2xl items-center">
            <div>
                <h4 class="text-xl font-bold mb-2">Laporan Otomatis</h4>
                <p class="text-sm text-zinc-400">Buat laporan mingguan mengenai pendapatan dan tingkat hunian secara otomatis untuk mitra venue.</p>
                <button class="mt-6 px-6 py-2 bg-white text-zinc-900 rounded-xl font-bold text-sm hover:bg-zinc-200 transition-colors">Atur Jadwal Laporan</button>
            </div>
        </div>
        <div class="bg-[#fdcbd0] text-[#795358] p-8 rounded-2xl items-center">
            <div>
                <h4 class="text-xl font-bold mb-2">Kapasitas Lapangan</h4>
                <p class="text-sm opacity-80">Pantau ketersediaan lapangan secara langsung dan maksimalkan strategi harga di jam sibuk.</p>
                <button class="mt-6 px-6 py-2 bg-[#795358] text-white rounded-xl font-bold text-sm hover:opacity-90 transition-colors">Cek Ketersediaan</button>
            </div>
        </div>
    </div>
</div>
@endsection