@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-2 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 mb-1">Manajemen Operasional Waktu</h1>
            <p class="text-slate-500 text-[15px]">Atur jam buka dan kelola slot waktu ketersediaan lapangan</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.oprational-waktus.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tambah Jam Operasional
            </a>
            <a href="{{ route('admin.slot-waktus.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tambah Slot Waktu
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 border-l-4 border-green-500 bg-green-50 px-5 py-4 rounded-r-xl shadow-sm">
        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Filter Bar --}}
    <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-wrap items-center gap-4 mb-6">
        <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-center gap-3 w-full">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Filter:</span>
            <select name="lapangan_id" onchange="this.form.submit()"
                class="py-2 px-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-red-100 focus:border-[#af101a] transition-all text-sm outline-none">
                <option value="">Semua Lapangan</option>
                @foreach($lapangans as $lap)
                <option value="{{ $lap->id }}" {{ request('lapangan_id') == $lap->id ? 'selected' : '' }}>
                    {{ $lap->name }}
                </option>
                @endforeach
            </select>
            <select name="hari" onchange="this.form.submit()"
                class="py-2 px-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-red-100 focus:border-[#af101a] transition-all text-sm outline-none">
                <option value="">Semua Hari</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                @endforeach
            </select>
            @if(request('lapangan_id') || request('hari'))
            <a href="{{ url()->current() }}" class="text-xs text-slate-400 hover:text-red-700 flex items-center gap-1 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg> Reset
            </a>
            @endif
        </form>
    </div>

    {{-- Top Grid: Jam Operasional Table + Stats --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Jam Operasional Table (spans 2 cols) --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Jam Operasional</h2>
                        <p class="text-xs text-slate-400">Tabel <code class="bg-slate-100 px-1 rounded text-[10px]">oprational_waktu</code></p>
                    </div>
                </div>
                <a href="{{ route('admin.oprational-waktus.create') }}"
                    class="flex items-center gap-1 px-3 py-1.5 bg-[#af101a] text-white text-xs font-bold rounded-lg hover:opacity-90 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg> Tambah
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-4 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Lapangan</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Hari</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Buka</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Tutup</th>
                            <th class="px-4 py-3 text-xs font-black text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($oprationalWaktus as $opw)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800">
                                {{ optional($opw->lapangan)->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-0.5 bg-blue-50 text-blue-700 rounded-full text-xs font-bold">
                                    {{ $opw->hari ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-mono text-slate-600">
                                {{ substr($opw->waktu_buka ?? '--:--', 0, 5) }}
                            </td>
                            <td class="px-4 py-3 text-sm font-mono text-slate-600">
                                {{ substr($opw->waktu_tutup ?? '--:--', 0, 5) }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.oprational-waktus.edit', $opw->id) }}"
                                        class="p-1.5 text-slate-400 hover:text-[#af101a] hover:bg-red-50 rounded-lg transition-all" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.oprational-waktus.destroy', $opw->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Hapus jam operasional ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-slate-400">
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
            <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">
                {{ $oprationalWaktus->links() }}
            </div>
            @endif
        </div>

        {{-- Right column: Stats + Info --}}
        <div class="flex flex-col gap-4">
            {{-- Summary Stats --}}
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-5">
                <h3 class="font-['Lexend'] text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Ringkasan Slot</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                        <span class="text-sm text-slate-600 font-medium">Total Slot</span>
                        <span class="text-lg font-black text-slate-900">{{ $slotAll->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <span class="text-sm text-green-700 font-medium flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Aktif
                        </span>
                        <span class="text-lg font-black text-green-700">
                            {{ $slotAll->where('status', 'aktif')->count() }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-slate-100 rounded-lg">
                        <span class="text-sm text-slate-500 font-medium flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span> Nonaktif
                        </span>
                        <span class="text-lg font-black text-slate-500">
                            {{ $slotAll->where('status', 'nonaktif')->count() }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <span class="text-sm text-red-700 font-medium flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span> Pemeliharaan
                        </span>
                        <span class="text-lg font-black text-red-700">
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
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-['Lexend'] text-lg font-semibold text-slate-900">Konfigurasi Slot Harian</h2>
                    <p class="text-xs text-slate-400">Pratinjau dan atur ketersediaan slot spesifik per lapangan
                        — tabel <code class="bg-slate-100 px-1 rounded text-[10px]">slot_waktu</code>
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.slot-waktus.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-[#af101a] text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all shadow-md shadow-red-700/20 active:scale-95 self-start sm:self-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tambah Slot
            </a>
        </div>

        <div class="p-6">
            @if($slotWaktus->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($slotWaktus as $slot)
                @php
                $st = strtolower($slot->status ?? 'aktif');
                $isMaintenance = in_array($st, ['pemeliharaan', 'maintenance']);
                $isActive = $st === 'aktif';
                @endphp
                <div class="p-4 rounded-xl border transition-all group
                    @if($isMaintenance) border-red-200 bg-red-50/30 hover:border-red-400
                    @elseif($isActive) border-slate-200 bg-white hover:border-[#af101a] hover:shadow-sm
                    @else border-slate-200 bg-slate-50 opacity-70 hover:opacity-100
                    @endif">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-base font-bold font-['Lexend']
                            @if($isMaintenance) text-red-700
                            @elseif(!$isActive) text-slate-400
                            @else text-slate-900 @endif">
                            {{ substr($slot->waktu_mulai ?? '00:00', 0, 5) }} – {{ substr($slot->waktu_selesai ?? '00:00', 0, 5) }}
                        </span>
                        @if($isMaintenance)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#af101a] text-white">Pemeliharaan</span>
                        @elseif($isActive)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-700">Aktif</span>
                        @else
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-200 text-slate-500">Nonaktif</span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-400 mb-3 truncate">{{ optional($slot->lapangan)->name ?? '-' }}</p>
                    <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.slot-waktus.edit', $slot->id) }}"
                                class="p-1 text-slate-400 hover:text-[#af101a] hover:bg-red-50 rounded-md transition-all" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.slot-waktus.destroy', $slot->id) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Hapus slot ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1 text-slate-400 hover:text-red-700 hover:bg-red-50 rounded-md transition-all" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Add Custom Slot --}}
                <a href="{{ route('admin.slot-waktus.create') }}"
                    class="p-4 rounded-xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center min-h-[112px] hover:border-[#af101a] hover:bg-red-50/10 transition-all cursor-pointer group">
                    <svg class="text-slate-300 group-hover:text-[#af101a] transition-colors w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-[10px] font-bold text-slate-400 group-hover:text-[#af101a] transition-colors uppercase tracking-widest mt-2">Tambah Slot</p>
                </a>
            </div>

            @if(method_exists($slotWaktus, 'links'))
            <div class="mt-6">
                {{ $slotWaktus->links() }}
            </div>
            @endif

            @else
            <div class="py-16 text-center">
                <svg class="w-12 h-12 text-slate-300 block mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                </svg>
                <p class="font-semibold text-slate-400 mb-4">Belum ada slot waktu.</p>
                <a href="{{ route('admin.slot-waktus.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#af101a] text-white text-sm font-bold rounded-xl hover:opacity-90 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg> Tambah Slot Pertama
                </a>
            </div>
            @endif

            {{-- Slot Detail Table --}}
            <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden mb-8">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100">
                    <h3 class="font-['Lexend'] text-sm font-semibold text-slate-600 uppercase tracking-wider">Tabel Detail Slot Waktu</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="px-5 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">#</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Lapangan</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Jam Operasional</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Mulai</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Selesai</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 uppercase tracking-wider">Status</th>
                                <th class="px-5 py-3 text-xs font-black text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($slotWaktus as $slot)
                            <td class="px-5 py-3 text-xs text-slate-400 font-mono">SLT-{{ str_pad($slot->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-5 py-3 text-sm font-semibold text-slate-800">{{ optional($slot->lapangan)->name ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="text-xs text-slate-400">—</span>
                            </td>
                            <td class="px-5 py-3 text-sm font-mono text-slate-600">{{ substr($slot->waktu_mulai ?? '--:--', 0, 5) }}</td>
                            <td class="px-5 py-3 text-sm font-mono text-slate-600">{{ substr($slot->waktu_selesai ?? '--:--', 0, 5) }}</td>
                            <td class="px-5 py-3">
                                @php $st2 = strtolower($slot->status ?? 'aktif'); @endphp
                                @if($st2 === 'aktif')
                                <span class="px-3 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-bold border border-green-100">Aktif</span>
                                @elseif(in_array($st2, ['pemeliharaan','maintenance']))
                                <span class="px-3 py-1 bg-red-50 text-red-700 rounded-lg text-xs font-bold border border-red-100">Pemeliharaan</span>
                                @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-xs font-bold border border-slate-200">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.slot-waktus.edit', $slot->id) }}"
                                        class="p-2 text-slate-400 hover:text-[#af101a] hover:bg-red-50 rounded-lg transition-all" title="Edit">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.slot-waktus.destroy', $slot->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Hapus slot ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 block mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                <div class="px-5 py-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-xs font-medium text-slate-500">
                        Showing {{ $slotWaktus->firstItem() ?? 0 }}–{{ $slotWaktus->lastItem() ?? 0 }}
                        of {{ $slotWaktus->total() }} slot
                    </p>
                    {{ $slotWaktus->links() }}
                </div>
            </div>

        </div>
        @endsection