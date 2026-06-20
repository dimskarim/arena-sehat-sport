@extends('layouts.app')

@section('content')


<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h2 class="font-['Lexend'] text-[32px] font-semibold tracking-tight leading-[1.3] text-[#1b1c1c] dark:text-white">Manajemen Reservasi</h2>
            <p class="text-[16px] text-[#5b403d] dark:text-gray-400 mt-1">Tinjau dan kelola seluruh reservasi lapangan yang masuk.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.bookings.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#e4beba] rounded-xl text-[14px] font-semibold hover:bg-[#f6f3f2] transition-colors active:scale-95 text-[#1b1c1c] dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Reservasi
            </a>
            <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#e4beba] rounded-xl text-[14px] font-semibold hover:bg-[#f6f3f2] transition-colors active:scale-95 text-[#1b1c1c] dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
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
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" id="stats-overview-container">
        <div class="md:col-span-2 bg-[#d32f2f] p-6 rounded-xl text-[#fff2f0] shadow-lg shadow-[#af101a]/20 flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-[14px] font-semibold opacity-80 uppercase tracking-wider text-xs">Total Pendapatan (Bulan Ini)</p>
                <h3 class="text-4xl font-bold mt-2">Rp {{ number_format($summaryStats['current_month_income'] ?? 0, 0, ',', '.') }}</h3>
                <p class="text-sm mt-4 flex items-center gap-1">
                    @if(($summaryStats['percentage_change'] ?? 0) >= 0)
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                    </svg>
                    {{ $summaryStats['percentage_change'] ?? 0 }}% peningkatan dari bulan lalu
                    @else
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.306-4.307a11.95 11.95 0 015.814 5.519l2.74 1.22m0 0l-5.94 2.28m5.94-2.28l-2.28-5.941" />
                    </svg>
                    {{ abs($summaryStats['percentage_change'] ?? 0) }}% penurunan dari bulan lalu
                    @endif
                </p>
            </div>
            <svg class="absolute -right-4 -bottom-4 w-36 h-36 opacity-10 rotate-12" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between dark:bg-gray-800 dark:border-gray-700">
            <div>
                <p class="text-sm text-[#5b403d] font-semibold text-[14px] dark:text-gray-400">Reservasi Aktif (Bulan Ini)</p>
                <h3 class="text-3xl font-bold text-[#1b1c1c] mt-1 dark:text-white">{{ $summaryStats['active_reservations_count'] ?? 0 }}</h3>
            </div>
            <div class="mt-4 flex -space-x-2">
                @foreach(($summaryStats['active_users'] ?? collect())->take(3) as $u)
                @php
                $imgUrl = $u->foto_profile ? (str_starts_with($u->foto_profile, 'http') ? $u->foto_profile : asset($u->foto_profile)) : 'https://ui-avatars.com/api/?name='.urlencode($u->name).'&background=FFCDD2&color=D32F2F&size=32';
                @endphp
                <img alt="{{ $u->name }}" class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800 object-cover" src="{{ $imgUrl }}" title="{{ $u->name }}" />
                @endforeach
                @if(count($summaryStats['active_users'] ?? []) > 3)
                <div class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800 bg-zinc-100 dark:bg-gray-700 flex items-center justify-center text-[10px] font-bold text-zinc-600 dark:text-gray-300">+{{ count($summaryStats['active_users']) - 3 }}</div>
                @endif
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between dark:bg-gray-800 dark:border-gray-700">
            <div>
                <p class="text-sm text-[#5b403d] font-semibold text-[14px] dark:text-gray-400">Menunggu Persetujuan</p>
                <h3 class="text-3xl font-bold text-[#ba1a1a] mt-1 dark:text-red-400">{{ $summaryStats['total_pending'] ?? 0 }}</h3>
            </div>
            <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="text-[#af101a] font-bold text-sm text-left hover:underline">Lihat semua antrean</a>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm mb-8 dark:bg-gray-800 dark:border-gray-700 relative z-40">
        <form method="GET" action="{{ route('admin.bookings.index') }}" id="filterForm" class="p-6 border-[#e4beba] dark:border-gray-700">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="relative lg:col-span-1">
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block dark:text-gray-400">Pencarian</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#5b403d] dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Ketik nama..." class="w-full pl-9 pr-3 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-[#af101a]/30" />
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block dark:text-gray-400">Dari Tanggal</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#5b403d] dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <input type="text" name="date_from" id="dateFromFilter" value="{{ request('date_from') }}" placeholder="Pilih tanggal..." class="datepicker-filter w-full pl-9 pr-3 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-[#af101a]/30 text-[#1b1c1c]" />
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block dark:text-gray-400">Sampai Tanggal</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#5b403d] dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <input type="text" name="date_to" id="dateToFilter" value="{{ request('date_to') }}" placeholder="Pilih tanggal..." class="datepicker-filter w-full pl-9 pr-3 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-[#af101a]/30 text-[#1b1c1c]" />
                        </div>
                    </div>
                    <div class="relative w-full z-40">
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block dark:text-gray-400">Status</label>

                        <!-- Hidden Select -->
                        <select name="status" id="statusFilter" class="hidden">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>

                        <!-- Custom Dropdown Button -->
                        <div id="custom-status-btn" class="flex items-center justify-between w-full px-4 py-2.5 bg-[#fcf9f8] hover:bg-white/20 rounded-xl border border-[#e4beba] text-sm transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white">
                            <span class="text-[#1b1c1c] dark:text-white font-medium" id="custom-status-text">
                                @php
                                $statusText = [
                                '' => 'Semua Status',
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                                ];
                                echo $statusText[request('status')] ?? 'Semua Status';
                                @endphp
                            </span>
                            <svg id="custom-status-icon" class="w-4 h-4 text-[#5b403d] transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <!-- Custom Dropdown Menu -->
                        <div id="custom-status-menu" class="absolute left-0 top-[calc(100%+0.5rem)] w-full bg-white dark:bg-gray-800 rounded-xl shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-[#e4beba] dark:border-gray-700 hidden z-50">
                            <!-- Upward Pointer -->
                            <div class="absolute -top-1.5 left-6 w-3 h-3 bg-white dark:bg-gray-800 transform rotate-45 border-t border-l border-[#e4beba] dark:border-gray-700"></div>

                            <ul class="relative z-10 py-1" id="custom-status-options">
                                <li data-value="" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == '' ? 'bg-red-100 text-[#af101a] font-bold' : 'text-[#5b403d] hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400 rounded-t-lg">Semua Status</li>
                                <li data-value="pending" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'pending' ? 'bg-red-100 text-[#af101a] font-bold' : 'text-[#5b403d] hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400">Pending</li>
                                <li data-value="confirmed" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'confirmed' ? 'bg-red-100 text-[#af101a] font-bold' : 'text-[#5b403d] hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400">Confirmed</li>
                                <li data-value="completed" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'completed' ? 'bg-red-100 text-[#af101a] font-bold' : 'text-[#5b403d] hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400">Completed</li>
                                <li data-value="cancelled" class="px-4 py-2.5 text-sm cursor-pointer transition-colors {{ request('status') == 'cancelled' ? 'bg-red-100 text-[#af101a] font-bold' : 'text-[#5b403d] hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400 rounded-b-lg">Cancelled</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="lg:pt-6 flex gap-2">
                    <button type="submit" class="px-6 py-2.5 bg-[#1b1c1c] text-[#fcf9f8] rounded-xl font-bold hover:bg-zinc-800 transition-colors active:scale-95 whitespace-nowrap hidden lg:block">
                        Cari
                    </button>
                    <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2.5 bg-white border border-[#e4beba] text-[#5b403d] rounded-xl font-semibold text-sm hover:bg-[#f6f3f2] transition-colors whitespace-nowrap dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div id="booking-table-container">

        <!-- Table Content -->
        <div class="overflow-x-auto bg-white rounded-t-xl border border-[#e4beba] border-b-0 dark:bg-gray-800 dark:border-gray-700">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0eded] text-[#5b403d] text-xs font-bold uppercase tracking-wider dark:bg-gray-900/50 dark:text-gray-400">
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Venue/Lapangan</th>
                        <th class="px-6 py-4">Tanggal & Waktu</th>
                        <th class="px-6 py-4 text-right">Total Harga</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba] dark:divide-gray-700">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] transition-colors group dark:hover:bg-gray-700/20">
                        <td class="px-6 py-5 border-b border-[#e4beba] dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="text-sm font-bold w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-[#af101a] dark:bg-gray-700 dark:text-red-400">
                                    {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#1b1c1c] dark:text-white">{{ $item->user->name ?? '-' }}</p>
                                    <p class="text-xs text-[#5b403d] dark:text-gray-400">{{ $item->user->email ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 border-b border-[#e4beba] dark:border-gray-700">
                            <p class="text-sm font-medium text-[#1b1c1c] dark:text-white">{{ $item->lapangan->name ?? '-' }}</p>
                            <p class="text-xs text-[#5b403d] dark:text-gray-400">{{ $item->lapangan->kategori->name ?? 'Venue' }}</p>
                        </td>
                        <td class="px-6 py-5 border-b border-[#e4beba] dark:border-gray-700">
                            <p class="text-sm font-medium text-[#1b1c1c] dark:text-white">{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d M Y') }}</p>
                            @php
                            $slotWaktus = $item->bookingDetails->pluck('slotWaktu')->filter();
                            $waktuMulai = $slotWaktus->min('waktu_mulai');
                            $waktuSelesai = $slotWaktus->max('waktu_selesai');
                            $waktuString = $waktuMulai && $waktuSelesai
                            ? \Carbon\Carbon::parse($waktuMulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($waktuSelesai)->format('H:i')
                            : '-';
                            @endphp
                            <p class="text-xs text-[#5b403d] dark:text-gray-400">{{ $waktuString }}</p>
                        </td>
                        <td class="px-6 py-5 text-right text-sm font-bold text-[#1b1c1c] border-b border-[#e4beba] dark:border-gray-700 dark:text-white">
                            Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-5 border-b border-[#e4beba] dark:border-gray-700">
                            @if(strtolower($item->status) == 'paid' || strtolower($item->status) == 'completed' || strtolower($item->status) == 'confirmed')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/20 dark:text-green-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                            @elseif(strtolower($item->status) == 'pending')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/20 dark:text-red-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 mr-1.5"></span>
                                Pending
                            </span>
                            @elseif(strtolower($item->status) == 'canceled' || strtolower($item->status) == 'cancelled')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-zinc-200 text-zinc-600 dark:bg-gray-700 dark:text-gray-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 mr-1.5"></span>
                                Canceled
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-600 mr-1.5"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-center border-b border-[#e4beba] dark:border-gray-700">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.bookings.edit', $item->id) }}" class="text-[#af101a] font-bold text-xs hover:bg-[#ffdad6] px-3 py-1.5 rounded-lg transition-colors">
                                    Details
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ route('admin.bookings.destroy', $item->id) }}', 'Reservasi dari {{ addslashes($item->user->name ?? '-') }}')" class="text-red-600 font-bold text-xs hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-[#5b403d] dark:text-gray-400">Belum ada data pemesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 bg-[#f6f3f2] flex flex-col sm:flex-row items-center justify-between rounded-b-xl border border-[#e4beba] border-t-0 dark:bg-gray-800/50 dark:border-gray-700">
            <div class="mb-4 sm:mb-0">
                @if(method_exists($items, 'firstItem'))
                <p class="text-xs font-medium text-[#5b403d] dark:text-gray-400">Menampilkan {{ $items->firstItem() ?? 0 }} hingga {{ $items->lastItem() ?? 0 }} dari {{ $items->total() ?? 0 }} reservasi</p>
                @endif
            </div>
            <div>
                @if(method_exists($items, 'links'))
                {{ $items->appends(request()->query())->links('components.pagination') }}
                @endif
            </div>
        </div>
    </div>

    <!-- Laporan Keuangan Section -->
    <div class="mt-8" id="financial-report-container">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="font-['Lexend'] text-2xl font-bold text-[#1b1c1c] dark:text-white">Laporan Keuangan</h2>
                <p class="text-sm text-[#5b403d] dark:text-gray-400 mt-1">Rekapitulasi pendapatan dari semua pesanan yang berhasil
                    @if(request('date_from') || request('date_to'))
                    <span class="font-semibold text-[#af101a] dark:text-red-400">pada rentang tanggal yang dipilih</span>
                    @endif
                </p>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-2 text-sm font-bold text-[#af101a] hover:underline">
                Verifikasi Pembayaran
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Gross Income --}}
            <div class="md:col-span-2 bg-gradient-to-br from-[#1b1c1c] to-zinc-700 text-white p-8 rounded-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-xs font-bold opacity-60 uppercase tracking-widest">Total Pendapatan Kotor (Gross Income)</p>
                    <h3 class="text-4xl font-black mt-3 font-['Lexend']">
                        Rp {{ number_format($summaryStats['gross_income'] ?? 0, 0, ',', '.') }}
                    </h3>
                    <p class="text-sm opacity-70 mt-4">Dari {{ $summaryStats['total_confirmed'] ?? 0 }} reservasi yang berhasil dikonfirmasi</p>
                    <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-white/10">
                        <div>
                            <p class="text-xs opacity-50 uppercase tracking-wider">Pending</p>
                            <p class="text-lg font-bold mt-1">{{ $summaryStats['total_pending'] ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs opacity-50 uppercase tracking-wider">Selesai</p>
                            <p class="text-lg font-bold mt-1 text-green-400">{{ $summaryStats['total_confirmed'] ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs opacity-50 uppercase tracking-wider">Dibatalkan</p>
                            <p class="text-lg font-bold mt-1 text-red-400">{{ $summaryStats['total_cancelled'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <svg class="absolute -right-6 -bottom-6 w-48 h-48 opacity-5" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            {{-- Quick Actions --}}
            <div class="space-y-4">
                <div class="bg-white border border-[#e4beba] rounded-2xl p-6 flex flex-col justify-between h-full dark:bg-gray-800 dark:border-gray-700">
                    <div>
                        <h4 class="font-['Lexend'] font-bold text-[#1b1c1c] mb-1 dark:text-white">Filter Laporan</h4>
                        <p class="text-sm text-[#5b403d] mb-4 dark:text-gray-400">Gunakan filter tanggal di atas untuk melihat laporan per rentang waktu atau jenis lapangan.</p>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.bookings.index', ['date_from' => now()->startOfMonth()->format('Y-m-d'), 'date_to' => now()->format('Y-m-d')]) }}"
                            class="block text-center px-4 py-2.5 bg-[#d32f2f] text-white rounded-xl text-sm font-bold hover:opacity-90 transition-opacity">
                            Laporan Bulan Ini
                        </a>
                        <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}"
                            class="block text-center px-4 py-2.5 bg-white border border-[#e4beba] text-[#1b1c1c] rounded-xl text-sm font-semibold hover:bg-[#f6f3f2] transition-colors dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700">
                            Semua Reservasi Selesai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 z-[150] hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0 font-['Inter'] text-[#1b1c1c] dark:text-white"
    :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
    <div class="w-fit transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 border border-[#e4beba] dark:border-gray-700" id="deleteModalContent">
        <div class="flex items-center justify-center mb-5">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                <svg class="text-[#af101a] dark:text-red-400 text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-[#1b1c1c] dark:text-white mb-2">Hapus Data Ini?</h3>
        <p class="text-center text-sm text-[#5b403d] dark:text-gray-400 mb-6">
            Apakah Anda yakin ingin menghapus <strong id="deleteItemName"></strong>? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
            <button type="button" onclick="closeDeleteModal()"
                class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-[#e4beba] dark:border-gray-600 bg-white dark:bg-gray-800 px-5 py-2.5 text-sm font-semibold text-[#5b403d] dark:text-gray-300 hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors">
                Batal
            </button>
            <button type="button" id="confirmDeleteBtn" onclick="executeDelete()"
                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] dark:bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800 dark:hover:bg-red-700 transition-colors">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
    let deleteModal, deleteModalContent, deleteFeedback, confirmDeleteBtn, deleteItemName;
    let deleteUrl = '';

    function initDeleteModal() {
        deleteModal = document.getElementById('deleteModal');
        deleteModalContent = document.getElementById('deleteModalContent');
        deleteFeedback = document.getElementById('deleteFeedback');
        confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        deleteItemName = document.getElementById('deleteItemName');
    }

    function openDeleteModal(url, name) {
        if (!deleteModal) initDeleteModal();
        deleteUrl = url;
        deleteItemName.textContent = name || 'Data';

        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
        void deleteModal.offsetWidth;
        deleteModal.classList.remove('opacity-0');
        deleteModalContent.classList.remove('scale-95', 'opacity-0');
        deleteModalContent.classList.add('scale-100', 'opacity-100');
        deleteFeedback.className = 'hidden mb-4 rounded-lg p-4 text-sm';
    }

    function closeDeleteModal() {
        if (!deleteModal) return;
        deleteModal.classList.add('opacity-0');
        deleteModalContent.classList.remove('scale-100', 'opacity-100');
        deleteModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        }, 300);
    }

    async function executeDelete() {
        if (!deleteUrl) return;

        const originalBtnText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memproses...`;

        try {
            const response = await fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            const data = await response.json().catch(() => ({}));

            if (response.ok) {
                deleteFeedback.classList.remove('hidden');
                deleteFeedback.classList.add('bg-green-50', 'text-green-800', 'border', 'border-green-200');
                deleteFeedback.innerHTML = '<p class="flex items-center gap-2">✅ Berhasil dihapus. Merefresh...</p>';
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                throw new Error(data.message || 'Terjadi kesalahan saat menghapus data.');
            }
        } catch (error) {
            deleteFeedback.classList.remove('hidden');
            deleteFeedback.classList.add('bg-red-50', 'text-red-800', 'border', 'border-red-200');
            deleteFeedback.innerHTML = `<p class="flex items-center gap-2">❌ ${error.message}</p>`;
            confirmDeleteBtn.disabled = false;
            confirmDeleteBtn.innerHTML = originalBtnText;
        }
    }
</script>

<!-- Flatpickr for Date Inputs -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<script>
    // AJAX Filter & Pagination
    async function fetchBookingData(url) {
        const container = document.getElementById('booking-table-container');
        if (!container) return;

        container.style.opacity = '0.5';
        container.style.pointerEvents = 'none';

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const html = await response.text();

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newContainer = doc.getElementById('booking-table-container');
            if (newContainer) container.innerHTML = newContainer.innerHTML;

            const statsOverview = document.getElementById('stats-overview-container');
            const newStatsOverview = doc.getElementById('stats-overview-container');
            if (statsOverview && newStatsOverview) statsOverview.innerHTML = newStatsOverview.innerHTML;

            const financialReport = document.getElementById('financial-report-container');
            const newFinancialReport = doc.getElementById('financial-report-container');
            if (financialReport && newFinancialReport) financialReport.innerHTML = newFinancialReport.innerHTML;

            window.history.pushState({}, '', url);
        } catch (error) {
            console.error('AJAX Error:', error);
        } finally {
            container.style.opacity = '1';
            container.style.pointerEvents = 'auto';
        }
    }

    function triggerFilter() {
        const form = document.getElementById('filterForm');
        if (form) {
            const url = new URL(form.action);
            const formData = new FormData(form);
            formData.forEach((value, key) => {
                if (value) url.searchParams.append(key, value);
            });
            fetchBookingData(url.toString());
        }
    }

    // Flatpickr initialization
    flatpickr(".datepicker-filter", {
        dateFormat: "Y-m-d",
        locale: "id",
        onChange: function(selectedDates, dateStr, instance) {
            triggerFilter();
        }
    });

    // Form submit interception
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            triggerFilter();
        });
    }

    // Event Delegation for filtering
    let searchTimeout;
    document.addEventListener('input', function(e) {
        if (e.target.id === 'searchInput') {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                triggerFilter();
            }, 300);
        }
    });

    document.addEventListener('change', function(e) {
        if (e.target.id === 'statusFilter') {
            triggerFilter();
        }
    });

    document.addEventListener('click', function(e) {
        // Intercept Pagination Links
        const link = e.target.closest('#booking-table-container nav a');
        if (link) {
            e.preventDefault();
            fetchBookingData(link.href);
        }
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
                        opt.classList.remove('bg-red-100', 'text-[#af101a]', 'font-bold');
                        opt.classList.add('text-[#5b403d]');
                    });

                    this.classList.remove('text-[#5b403d]');
                    this.classList.add('bg-red-100', 'text-[#af101a]', 'font-bold');

                    // Dispatch change event to trigger AJAX filter
                    statusSelect.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));

                    statusMenu.classList.add('hidden');
                    statusIcon.classList.remove('rotate-180');
                });
            });
        }
    }
</script>
@endsection