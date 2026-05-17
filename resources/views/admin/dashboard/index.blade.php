@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="mb-8">
    <h1 class="font-lexend font-bold text-3xl text-gray-900 dark:text-white">Halaman Dashboard</h1>
    <p class="mt-1.5 text-base text-gray-500 dark:text-gray-400 font-inter">
        Selamat datang kembali, Admin! Berikut adalah ringkasan aktivitas Arena Sehat Sport hari ini.
    </p>
</div>

{{-- Stats Cards — 4 columns based on current data --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Total Venues --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-start justify-between mb-5">
            <div class="w-11 h-11 bg-[#FFCDD2] dark:bg-red-900/30 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-[#D32F2F] dark:text-[#ef5350]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
            </div>
            <span class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400 px-2 py-0.5 rounded-full font-inter">+12%</span>
        </div>
        <p class="text-sm text-gray-400 dark:text-gray-500 font-inter font-medium mb-1">Total Lapangan</p>
        <p class="font-lexend font-black text-3xl text-gray-900 dark:text-white">{{ $totalLapangans ?? 0 }}</p>
    </div>

    {{-- Total Bookings --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-start justify-between mb-5">
            <div class="w-11 h-11 bg-[#FFCDD2] dark:bg-red-900/30 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-[#D32F2F] dark:text-[#ef5350]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400 px-2 py-0.5 rounded-full font-inter">+24%</span>
        </div>
        <p class="text-sm text-gray-400 dark:text-gray-500 font-inter font-medium mb-1">Total Booking</p>
        <p class="font-lexend font-black text-3xl text-gray-900 dark:text-white">{{ number_format($totalBookings ?? 0) }}</p>
    </div>

    {{-- Total Users --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-start justify-between mb-5">
            <div class="w-11 h-11 bg-[#FFCDD2] dark:bg-red-900/30 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-[#D32F2F] dark:text-[#ef5350]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <span class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400 px-2 py-0.5 rounded-full font-inter">+5%</span>
        </div>
        <p class="text-sm text-gray-400 dark:text-gray-500 font-inter font-medium mb-1">Total Pengguna</p>
        <p class="font-lexend font-black text-3xl text-gray-900 dark:text-white">{{ number_format($totalUsers ?? 0) }}</p>
    </div>

    {{-- Total Revenue --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-start justify-between mb-5">
            <div class="w-11 h-11 bg-[#FFCDD2] dark:bg-red-900/30 rounded-lg flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-[#D32F2F] dark:text-[#ef5350]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400 px-2 py-0.5 rounded-full font-inter">+8%</span>
        </div>
        <p class="text-sm text-gray-400 dark:text-gray-500 font-inter font-medium mb-1">Total Pendapatan</p>
        <p class="font-lexend font-bold text-2xl lg:text-xl xl:text-2xl text-gray-900 dark:text-white truncate">
            Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
        </p>
    </div>
</div>

{{-- Middle Row: Chart + Popular Venues --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Monthly Revenue Chart --}}
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-lexend font-bold text-xl text-gray-900 dark:text-white">Pendapatan Bulanan</h2>
            <div class="flex items-center gap-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg px-3 py-1.5">
                <span class="text-xs font-semibold text-gray-600 dark:text-gray-300 font-inter">Tahun {{ date('Y') }}</span>
            </div>
        </div>

        {{-- Bar Chart --}}
        @php
        $bars = [
        ['h' => 30, 'label' => 'JAN', 'val' => 'Rp4m', 'peak' => false],
        ['h' => 45, 'label' => 'FEB', 'val' => 'Rp6m', 'peak' => false],
        ['h' => 40, 'label' => 'MAR', 'val' => 'Rp5.5m', 'peak' => false],
        ['h' => 60, 'label' => 'APR', 'val' => 'Rp8m', 'peak' => false],
        ['h' => 55, 'label' => 'MAY', 'val' => 'Rp7.5m', 'peak' => true],
        ['h' => 1, 'label' => 'JUN', 'val' => 'Rp0m', 'peak' => false],
        ['h' => 1, 'label' => 'JUL', 'val' => 'Rp0m', 'peak' => false],
        ['h' => 1, 'label' => 'AUG', 'val' => 'Rp0m','peak' => false ],
        ['h' => 1, 'label' => 'SEP', 'val' => 'Rp0m', 'peak' => false],
        ['h' => 1, 'label' => 'OCT', 'val' => 'Rp0m', 'peak' => false],
        ['h' => 1, 'label' => 'NOV', 'val' => 'Rp0m', 'peak' => false],
        ['h' => 1, 'label' => 'DEC', 'val' => 'Rp0m', 'peak' => false],
        ];
        @endphp

        <div class="flex items-end gap-2 h-52 mb-3 px-1">
            @foreach($bars as $bar)
            <div class="flex-1 flex flex-col items-center gap-0 group">
                <div class="relative w-full">
                    {{-- Tooltip --}}
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[10px] font-semibold py-1 px-2 rounded
                                    {{ $bar['peak'] ? 'flex' : 'hidden group-hover:flex' }} whitespace-nowrap pointer-events-none z-10">
                        {{ $bar['val'] }}
                    </div>
                    {{-- Bar --}}
                    <div class="w-full rounded-t-md transition-all duration-200 group-hover:opacity-80"
                        style="height: {{ ($bar['h'] / 100) * 200 }}px;
                                    background-color: {{ $bar['peak'] ? '#D32F2F' : '#FFCDD2' }};">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="flex items-center gap-2 px-1">
            @foreach($bars as $bar)
            <div class="flex-1 text-center">
                <span class="text-[10px] font-semibold text-gray-400 dark:text-gray-500 font-inter tracking-tight">{{ $bar['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Popular Venues --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-lexend font-bold text-xl text-gray-900 dark:text-white">Venue Terpopuler</h2>
            <a href="{{ route('admin.lapangans.index') }}" class="text-sm font-semibold text-[#D32F2F] hover:underline font-inter">Lihat Semua</a>
        </div>

        <div class="space-y-4 flex-1">
            @php
            $popularVenues = [
            ['name' => 'Elite Arena Center', 'bookings' => '842 Reservasi', 'revenue' => 'Rp 12.450', 'img' => 'https://placehold.co/40x40/f3f4f6/a1a1aa?text=Img'],
            ['name' => 'Skyline Tennis Club', 'bookings' => '651 Reservasi', 'revenue' => 'Rp 9.820', 'img' => 'https://placehold.co/40x40/e2e8f0/64748b?text=Img'],
            ['name' => 'Victory Field Turf', 'bookings' => '598 Reservasi', 'revenue' => 'Rp 8.100', 'img' => 'https://placehold.co/40x40/fce7f3/db2777?text=Img'],
            ['name' => 'Olympus Training Hub','bookings' => '412 Reservasi', 'revenue' => 'Rp 5.240', 'img' => 'https://placehold.co/40x40/fef3c7/d97706?text=Img'],
            ];
            @endphp

            @foreach($popularVenues as $venue)
            <div class="flex items-center gap-3">
                <img src="{{ $venue['img'] }}"
                    alt="{{ $venue['name'] }}"
                    class="w-10 h-10 rounded-lg object-cover shrink-0 bg-gray-100 dark:bg-gray-700">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white font-inter truncate">{{ $venue['name'] }}</p>
                    <p class="text-xs text-gray-400 font-inter">{{ $venue['bookings'] }}</p>
                </div>
                <span class="text-sm font-bold text-gray-900 dark:text-white font-inter shrink-0">{{ $venue['revenue'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Recent Bookings --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">

    {{-- Table Top Bar --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
        <h2 class="font-lexend font-bold text-xl text-gray-900 dark:text-white">Reservasi Terbaru</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-1.5 text-xs font-semibold text-[#D32F2F] bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 px-3 py-2 rounded-lg transition-colors font-inter">
                Lihat Semua Reservasi
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/40 border-b border-gray-100 dark:border-gray-700">
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider font-inter">Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider font-inter">Venue</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider font-inter">Tanggal & Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider font-inter">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider font-inter">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($recentBookings ?? [] as $booking)
                @php
                $initials = collect(explode(' ', $booking->user->name ?? 'U N'))->take(2)->map(fn($w) => strtoupper($w[0]))->join('');
                $avatarColors = [
                'bg-blue-100 text-blue-700',
                'bg-purple-100 text-purple-700',
                'bg-red-100 text-red-700',
                'bg-orange-100 text-orange-700',
                'bg-green-100 text-green-700',
                'bg-teal-100 text-teal-700',
                ];
                $colorClass = $avatarColors[$booking->id % count($avatarColors)];

                $statusConfig = match($booking->status) {
                'confirmed' => ['label' => 'Confirmed', 'class' => 'text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400'],
                'completed' => ['label' => 'Success', 'class' => 'text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400'],
                'pending' => ['label' => 'Pending', 'class' => 'text-yellow-600 bg-yellow-50 dark:bg-yellow-900/20 dark:text-yellow-400'],
                'cancelled' => ['label' => 'Rejected', 'class' => 'text-red-600 bg-red-50 dark:bg-red-900/20 dark:text-red-400'],
                default => ['label' => ucfirst($booking->status), 'class' => 'text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-400'],
                };
                @endphp
                <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-700/20 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full {{ $colorClass }} flex items-center justify-center text-xs font-bold shrink-0 font-inter">
                                {{ $initials }}
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white font-inter">
                                {{ $booking->user->name ?? '-' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300 font-inter">
                        {{ $booking->lapangan->name ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 font-inter">
                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('M d, Y') }} • 08:00
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white font-inter">
                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $statusConfig['class'] }} font-inter">
                            {{ $statusConfig['label'] }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400 font-inter">
                        Belum ada data reservasi terbaru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection