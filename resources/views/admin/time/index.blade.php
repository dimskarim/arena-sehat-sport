@extends('layouts.app')

@section('content')
<div id="time-content-container" class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900 dark:text-white transition-opacity duration-300 relative">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-2 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white mb-1">Manajemen Operasional Waktu</h1>
            <p class="text-slate-500 dark:text-gray-400 text-[15px]">Atur jam buka dan kelola slot waktu ketersediaan lapangan</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.oprational-waktus.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 text-slate-700 dark:text-gray-300 text-sm font-semibold rounded-xl hover:bg-slate-50 dark:hover:bg-gray-700 transition-colors shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tambah Jam Operasional
            </a>
            <a href="{{ route('admin.slot-waktus.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-[#af101a] dark:bg-red-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 dark:hover:bg-red-700 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tambah Slot Waktu
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 dark:border-green-500 px-5 py-4 rounded-r-xl shadow-sm">
        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-green-800 dark:text-green-400 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Filter Bar --}}
    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-slate-100 dark:border-gray-700 shadow-sm flex flex-wrap items-center gap-4 mb-6">
        <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-3 w-full">
            <svg class="w-5 h-5 text-slate-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <span class="text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-wider">Filter:</span>
            <select name="lapangan_id" id="lapanganFilter"
                class="py-2 px-3 bg-slate-50 dark:bg-gray-700/50 border border-slate-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 dark:text-white transition-all text-sm outline-none">
                <option value="">Semua Lapangan</option>
                @foreach($lapangans as $lap)
                <option value="{{ $lap->id }}" {{ request('lapangan_id') == $lap->id ? 'selected' : '' }}>
                    {{ $lap->name }}
                </option>
                @endforeach
            </select>
            @if(request('hari'))
            <input type="hidden" name="hari" value="{{ request('hari') }}">
            @endif
            @if(request('lapangan_id') || request('hari'))
            <a href="{{ url()->current() }}" class="text-xs text-slate-400 dark:text-gray-500 hover:text-red-700 dark:hover:text-red-400 flex items-center gap-1 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg> Reset
            </a>
            @endif
        </form>
    </div>

    @if(request('lapangan_id'))
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white">
            Menampilkan Jadwal Lapangan: {{ $lapangans->firstWhere('id', request('lapangan_id'))?->name ?? 'Semua Lapangan' }}
        </h2>
    </div>
    @endif

    {{-- Top Grid: Jam Operasional Table + Stats --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Jam Operasional Table (spans 2 cols) --}}
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl border border-slate-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-gray-700 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-red-50 dark:bg-red-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900 dark:text-white">Jam Operasional</h2>
                        <p class="text-xs text-slate-400 dark:text-gray-500">Tabel <code class="bg-slate-100 dark:bg-gray-700 px-1 rounded text-[10px]">oprational_waktu</code></p>
                    </div>
                </div>
                <a href="{{ route('admin.oprational-waktus.create') }}"
                    class="flex items-center gap-1 px-3 py-1.5 bg-[#af101a] dark:bg-red-600 text-white text-xs font-bold rounded-lg hover:opacity-90 dark:hover:bg-red-700 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg> Tambah
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-gray-900/50 border-b border-slate-100 dark:border-gray-700">
                            <th class="px-4 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Lapangan</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Hari</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Buka</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Tutup</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-gray-700">
                        @forelse($oprationalWaktus as $opw)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-gray-700/20 transition-colors group">
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800 dark:text-white">
                                {{ optional($opw->lapangan)->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-0.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-xs font-bold">
                                    {{ $opw->hari ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-mono text-slate-600 dark:text-gray-400">
                                {{ substr($opw->waktu_buka ?? '--:--', 0, 5) }}
                            </td>
                            <td class="px-4 py-3 text-sm font-mono text-slate-600 dark:text-gray-400">
                                {{ substr($opw->waktu_tutup ?? '--:--', 0, 5) }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.oprational-waktus.edit', $opw->id) }}"
                                        class="p-1.5 text-slate-400 dark:text-gray-500 hover:text-[#af101a] dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button type="button" onclick="openDeleteModal('{{ route('admin.oprational-waktus.destroy', $opw->id) }}', 'Jam Operasional Ini')" class="p-1.5 text-slate-400 dark:text-gray-500 hover:text-red-700 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-400 dark:text-gray-500">
                                <svg class="w-10 h-10 block mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm">Belum ada jam operasional.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($oprationalWaktus, 'links'))
            <div class="px-4 py-3 bg-slate-50 dark:bg-gray-800/50 border-t border-slate-100 dark:border-gray-700">
                {{ $oprationalWaktus->links('components.pagination') }}
            </div>
            @endif
        </div>

        {{-- Right column: Stats + Info --}}
        <div class="flex flex-col gap-4">
            {{-- Summary Stats --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-slate-100 dark:border-gray-700 shadow-sm p-5">
                <h3 class="font-['Lexend'] text-sm font-semibold text-slate-500 dark:text-gray-400 uppercase tracking-wider mb-4">Ringkasan Slot</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-gray-700/50 rounded-lg">
                        <span class="text-sm text-slate-600 dark:text-gray-300 font-medium">Total Slot</span>
                        <span class="text-lg font-black text-slate-900 dark:text-white">{{ $slotAll->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <span class="text-sm text-green-700 dark:text-green-400 font-medium flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Aktif
                        </span>
                        <span class="text-lg font-black text-green-700 dark:text-green-400">
                            {{ $slotAll->where('status', 'aktif')->count() }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-slate-100 dark:bg-gray-700 rounded-lg">
                        <span class="text-sm text-slate-500 dark:text-gray-400 font-medium flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span> Nonaktif
                        </span>
                        <span class="text-lg font-black text-slate-500 dark:text-gray-400">
                            {{ $slotAll->where('status', 'nonaktif')->count() }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                        <span class="text-sm text-red-700 dark:text-red-400 font-medium flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span> Pemeliharaan
                        </span>
                        <span class="text-lg font-black text-red-700 dark:text-red-400">
                            {{ $slotAll->whereIn('status', ['pemeliharaan','maintenance'])->count() }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="bg-gradient-to-br from-[#af101a] to-[#7f0d13] text-white rounded-xl p-5 shadow-lg shadow-red-900/20 relative overflow-hidden flex-1">
                <svg class="absolute -right-3 -bottom-3 w-24 h-24 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="relative z-10">
                    <h3 class="font-['Lexend'] text-sm font-semibold mb-3">Cara Kerja</h3>
                    <p class="text-red-100 text-xs leading-relaxed">
                        Tabel <strong class="text-white">oprational_waktu</strong> mendefinisikan jam buka–tutup per lapangan per hari.
                        Tabel <strong class="text-white">slot_waktu</strong> adalah slot-slot hasil pembagian waktu tersebut yang bisa dipesan pelanggan.
                    </p>
                    <div class="mt-4 flex items-center gap-2 text-xs font-bold text-red-200">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg> Operasional
                        </span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                            </svg> Slot
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slot Harian Cards --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-slate-100 dark:border-gray-700 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-red-50 dark:bg-red-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-['Lexend'] text-lg font-semibold text-slate-900 dark:text-white">Konfigurasi Slot Harian</h2>
                    <p class="text-xs text-slate-400 dark:text-gray-500">Pratinjau dan atur ketersediaan slot spesifik per lapangan
                        — tabel <code class="bg-slate-100 dark:bg-gray-700 px-1 rounded text-[10px]">slot_waktu</code>
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <form method="GET" action="{{ url()->current() }}" class="flex items-center">
                    @if(request('lapangan_id'))
                    <input type="hidden" name="lapangan_id" value="{{ request('lapangan_id') }}">
                    @endif
                    <select name="hari" id="hariFilter"
                        class="py-2.5 px-4 bg-slate-50 dark:bg-gray-700/50 border border-slate-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 dark:text-white transition-all text-sm outline-none font-semibold shadow-sm">
                        <option value="">Filter Hari</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                        <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('admin.slot-waktus.create') }}"
                    class="flex items-center gap-2 px-5 py-2.5 bg-[#af101a] dark:bg-red-600 text-white text-sm font-bold rounded-xl hover:opacity-90 dark:hover:bg-red-700 transition-all shadow-md shadow-red-700/20 active:scale-95 self-start sm:self-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tambah Slot
                </a>
            </div>
        </div>

        <div class="p-6">
            @if($slotCards->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($slotCards as $slot)
                @php
                $st = strtolower($slot->status ?? 'aktif');
                $isMaintenance = in_array($st, ['pemeliharaan', 'maintenance']);
                $isActive = $st === 'aktif';
                @endphp
                <div class="p-4 rounded-xl border transition-all group
                    @if($isMaintenance) border-red-200 dark:border-red-900/50 bg-red-50/30 dark:bg-red-900/10 hover:border-red-400 dark:hover:border-red-700
                    @elseif($isActive) border-slate-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-[#af101a] dark:hover:border-red-500 hover:shadow-sm
                    @else border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800/50 opacity-70 hover:opacity-100
                    @endif">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-base font-bold font-['Lexend']
                            @if($isMaintenance) text-red-700 dark:text-red-400
                            @elseif(!$isActive) text-slate-400 dark:text-gray-500
                            @else text-slate-900 dark:text-white @endif">
                            {{ substr($slot->waktu_mulai ?? '00:00', 0, 5) }} – {{ substr($slot->waktu_selesai ?? '00:00', 0, 5) }}
                        </span>
                        @if($isMaintenance)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#af101a] dark:bg-red-600 text-white">Pemeliharaan</span>
                        @else
                        <button type="button" onclick="toggleSlotStatus({{ $slot->id }})" id="statusBtn-{{ $slot->id }}"
                            class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider transition-colors
                            {{ $isActive ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 hover:bg-red-100 hover:text-red-700' : 'bg-slate-200 dark:bg-gray-700 text-slate-500 dark:text-gray-400 hover:bg-green-100 hover:text-green-700' }}">
                            {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                        </button>
                        @endif
                    </div>
                    <p class="text-xs text-slate-400 dark:text-gray-500 mb-1 truncate">{{ optional(optional($slot->waktuOperasional)->lapangan)->name ?? '-' }}</p>
                    <p class="text-[10px] font-bold text-blue-600 dark:text-blue-400 mb-3 truncate">{{ optional($slot->waktuOperasional)->hari ?? '-' }}</p>
                    <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-gray-700">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.slot-waktus.edit', $slot->id) }}"
                                class="p-1 text-slate-400 dark:text-gray-500 hover:text-[#af101a] dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-md transition-all" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button type="button" onclick="openDeleteModal('{{ route('admin.slot-waktus.destroy', $slot->id) }}', 'Slot Ini')" class="p-1 text-slate-400 dark:text-gray-500 hover:text-red-700 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-md transition-all" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Add Custom Slot --}}
                <a href="{{ route('admin.slot-waktus.create') }}"
                    class="p-4 rounded-xl border-2 border-dashed border-slate-200 dark:border-gray-700 flex flex-col items-center justify-center min-h-[112px] hover:border-[#af101a] dark:hover:border-red-500 hover:bg-red-50/10 dark:hover:bg-red-900/10 transition-all cursor-pointer group">
                    <svg class="text-slate-300 dark:text-gray-600 group-hover:text-[#af101a] dark:group-hover:text-red-500 transition-colors w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-gray-500 group-hover:text-[#af101a] dark:group-hover:text-red-500 transition-colors uppercase tracking-widest mt-2">Tambah Slot</p>
                </a>
            </div>

            @if(method_exists($slotCards, 'links'))
            <div class="mt-6">
                {{ $slotCards->links('components.pagination') }}
            </div>
            @endif

            @else
            <div class="py-16 text-center">
                <svg class="w-12 h-12 text-slate-300 dark:text-gray-600 block mb-3 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                </svg>
                <p class="font-semibold text-slate-400 dark:text-gray-500 mb-4">Belum ada slot waktu.</p>
                <a href="{{ route('admin.slot-waktus.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#af101a] dark:bg-red-600 text-white text-sm font-bold rounded-xl hover:opacity-90 dark:hover:bg-red-700 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg Tambah Slot Pertama
                        </a>
            </div>
            @endif

            {{-- Slot Detail Table --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-slate-100 dark:border-gray-700 shadow-sm overflow-hidden mb-8 mt-6">
                <div class="px-6 py-4 bg-slate-50 dark:bg-gray-900/50 border-b border-slate-100 dark:border-gray-700">
                    <h3 class="font-['Lexend'] text-sm font-semibold text-slate-600 dark:text-gray-300 uppercase tracking-wider">Tabel Detail Slot Waktu</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 dark:border-gray-700">
                                <th class="px-5 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Lapangan</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Jam Operasional</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Mulai</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Selesai</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 dark:text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-gray-700">
                            @forelse($slotWaktus as $slot)
                            <tr class="hover:bg-slate-50 dark:hover:bg-gray-700/20 transition-colors">
                                <td class="px-5 py-3 text-xs text-slate-400 dark:text-gray-500 font-mono">SLT-{{ str_pad($slot->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-5 py-3 text-sm font-semibold text-slate-800 dark:text-white">{{ optional(optional($slot->waktuOperasional)->lapangan)->name ?? '-' }}</td>
                                <td class="px-5 py-3">
                                    @if($slot->waktuOperasional)
                                    <span class="px-2.5 py-0.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-xs font-bold mr-1">{{ $slot->waktuOperasional->hari }}</span>
                                    <span class="text-xs font-mono text-slate-500 dark:text-gray-400">{{ substr($slot->waktuOperasional->waktu_buka, 0, 5) }} - {{ substr($slot->waktuOperasional->waktu_tutup, 0, 5) }}</span>
                                    @else
                                    <span class="text-xs text-slate-400 dark:text-gray-500">—</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-sm font-mono text-slate-600 dark:text-gray-400">{{ substr($slot->waktu_mulai ?? '--:--', 0, 5) }}</td>
                                <td class="px-5 py-3 text-sm font-mono text-slate-600 dark:text-gray-400">{{ substr($slot->waktu_selesai ?? '--:--', 0, 5) }}</td>
                                <td class="px-5 py-3">
                                    @php $st2 = strtolower($slot->status ?? 'aktif'); @endphp
                                    @if($st2 === 'aktif')
                                    <span class="px-3 py-1 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-xs font-bold border border-green-100 dark:border-green-800">Aktif</span>
                                    @elseif(in_array($st2, ['pemeliharaan','maintenance']))
                                    <span class="px-3 py-1 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg text-xs font-bold border border-red-100 dark:border-red-800">Pemeliharaan</span>
                                    @else
                                    <span class="px-3 py-1 bg-slate-100 dark:bg-gray-700 text-slate-500 dark:text-gray-400 rounded-lg text-xs font-bold border border-slate-200 dark:border-gray-600">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.slot-waktus.edit', $slot->id) }}"
                                            class="p-2 text-slate-400 dark:text-gray-500 hover:text-[#af101a] dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <button type="button" onclick="openDeleteModal('{{ route('admin.slot-waktus.destroy', $slot->id) }}', 'Slot Waktu Ini')" class="p-2 text-slate-400 dark:text-gray-500 hover:text-red-700 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center text-slate-400 dark:text-gray-500">
                                    <svg class="w-10 h-10 block mb-2 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                    </svg>
                                    <p class="font-medium">Belum ada data slot waktu.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Slot Table Pagination --}}
                <div class="px-5 py-4 bg-slate-50 dark:bg-gray-800/50 border-t border-slate-100 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-xs font-medium text-slate-500 dark:text-gray-400">
                        Showing {{ $slotWaktus->firstItem() ?? 0 }}–{{ $slotWaktus->lastItem() ?? 0 }}
                        of {{ $slotWaktus->total() }} slot
                    </p>
                    {{ $slotWaktus->links('components.pagination') }}
                </div>
            </div>
            <div id="ajax-modal-overlay" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 opacity-0 transition-opacity duration-300 font-['Inter']"
                :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
                <div id="ajax-modal-content" class="w-fit transform scale-95 opacity-0 transition-all duration-300"></div>
            </div>

        </div>

        <script>
            async function toggleSlotStatus(id) {
                const btn = document.getElementById(`statusBtn-${id}`);
                if (!btn) return;
                const originalText = btn.innerHTML;
                btn.innerHTML = '...';
                btn.disabled = true;

                try {
                    const response = await fetch(`{{ url('admin/slot-waktus') }}/${id}/toggle-status`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });
                    const data = await response.json();
                    if (response.ok && data.success) {
                        if (data.status === 'aktif') {
                            btn.className = "px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider transition-colors bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 hover:bg-red-100 hover:text-red-700";
                            btn.innerHTML = "Aktif";
                        } else {
                            btn.className = "px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider transition-colors bg-slate-200 dark:bg-gray-700 text-slate-500 dark:text-gray-400 hover:bg-green-100 hover:text-green-700";
                            btn.innerHTML = "Nonaktif";
                        }
                    } else {
                        alert(data.message || 'Gagal mengubah status');
                        btn.innerHTML = originalText;
                    }
                } catch (error) {
                    console.error(error);
                    alert('Terjadi kesalahan koneksi.');
                    btn.innerHTML = originalText;
                } finally {
                    btn.disabled = false;
                }
            }

            // AJAX Filter & Pagination
            async function fetchTimeData(url) {
                const container = document.getElementById('time-content-container');
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
                    const newContainer = doc.getElementById('time-content-container');

                    if (newContainer) {
                        container.innerHTML = newContainer.innerHTML;
                    }
                    window.history.pushState({}, '', url);
                } catch (error) {
                    console.error('AJAX Error:', error);
                } finally {
                    container.style.opacity = '1';
                    container.style.pointerEvents = 'auto';
                }
            }

            // Event Delegation for filtering and pagination
            document.addEventListener('change', function(e) {
                if (e.target.id === 'lapanganFilter' || e.target.id === 'hariFilter') {
                    const form = e.target.closest('form');
                    if (form) {
                        const url = new URL(form.action);
                        const formData = new FormData(form);
                        formData.forEach((value, key) => {
                            if (value) url.searchParams.append(key, value);
                        });
                        fetchTimeData(url.toString());
                    }
                }
            });

            document.addEventListener('click', function(e) {
                // Intercept Pagination Links
                const link = e.target.closest('#time-content-container nav a');
                if (link) {
                    e.preventDefault();
                    fetchTimeData(link.href);
                    return;
                }

                // Intercept Create/Edit Links to open as Modal over current page
                const modalLink = e.target.closest('a[href*="/create"], a[href*="/edit"]');
                if (modalLink && !modalLink.hasAttribute('data-no-modal')) {
                    e.preventDefault();
                    openAjaxModal(modalLink.href);
                }
            });

            // AJAX Modal Logic
            async function openAjaxModal(url) {
                const overlay = document.getElementById('ajax-modal-overlay');
                const contentContainer = document.getElementById('ajax-modal-content');

                if (!overlay || !contentContainer) return;

                // Show loading spinner
                contentContainer.innerHTML = '<div class="mx-auto w-10 h-10 border-4 border-[#af101a] border-t-transparent rounded-full animate-spin"></div>';

                // Trigger fade in
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
                void overlay.offsetWidth; // trigger reflow
                overlay.classList.remove('opacity-0');
                contentContainer.classList.remove('scale-95', 'opacity-0');
                contentContainer.classList.add('scale-100', 'opacity-100');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const html = await response.text();
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    let card = doc.querySelector('.min-h-\\[70vh\\] > div');

                    if (card) {
                        contentContainer.innerHTML = '';
                        card.className = "w-full bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-slate-100 dark:border-gray-700 relative";
                        contentContainer.appendChild(card);

                        // Add click outside to close
                        overlay.onclick = function(e) {
                            if (e.target === overlay) closeAjaxModal();
                        };

                        // Intercept close buttons inside the card (links going back to index)
                        const closeBtns = card.querySelectorAll('a[href*="index"]');
                        closeBtns.forEach(btn => {
                            btn.addEventListener('click', function(e) {
                                e.preventDefault();
                                closeAjaxModal();
                            });
                        });
                    } else {
                        // Fallback
                        window.location.href = url;
                    }
                } catch (error) {
                    console.error('Modal load error:', error);
                    window.location.href = url;
                }
            }

            function closeAjaxModal() {
                const overlay = document.getElementById('ajax-modal-overlay');
                const contentContainer = document.getElementById('ajax-modal-content');
                if (overlay) {
                    overlay.classList.add('opacity-0');
                    contentContainer.classList.remove('scale-100', 'opacity-100');
                    contentContainer.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                        overlay.classList.remove('flex');
                    }, 300);
                }
            }
        </script>

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
                initDeleteModal();
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
                initDeleteModal();
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
        @endsection
