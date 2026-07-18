@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900 relative">

    <form action="{{ route('admin.bookings.update', $item->id) }}" method="POST" id="editBookingForm">
        @csrf
        @method('PUT')

        {{-- Header & Breadcrumb --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-gray-400 mb-2">
                    <a href="{{ route('admin.bookings.index') }}" class="hover:text-[#af101a] dark:hover:text-red-400 transition-colors">Daftar Reservasi</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-[#af101a] dark:text-red-400 font-medium">Reservasi #VR-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                </nav>
                <h1 class="text-3xl font-bold font-['Lexend'] tracking-tight dark:text-white">Detail Reservasi</h1>
            </div>
            <div class="flex items-center gap-3">
                @if($item->status == 'pending')
                <span class="px-4 py-1.5 bg-amber-100 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 dark:border-amber-800 text-xs font-bold rounded-full flex items-center gap-1.5 border border-amber-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    PENDING
                </span>
                @elseif($item->status == 'confirmed')
                <span class="px-4 py-1.5 bg-blue-100 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800 text-xs font-bold rounded-full flex items-center gap-1.5 border border-blue-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    CONFIRMED
                </span>
                @elseif($item->status == 'completed')
                <span class="px-4 py-1.5 bg-green-100 text-green-700 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800 text-xs font-bold rounded-full flex items-center gap-1.5 border border-green-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    COMPLETED
                </span>
                @else
                <span class="px-4 py-1.5 bg-slate-100 text-slate-600 dark:bg-slate-900/20 dark:text-slate-400 dark:border-slate-700 text-xs font-bold rounded-full flex items-center gap-1.5 border border-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    CANCELLED
                </span>
                @endif
                <span class="text-xs text-slate-400 dark:text-gray-500">Dibuat: {{ $item->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Venue & Schedule Card --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 dark:bg-gray-800 dark:border-gray-700 relative z-[60]">
                    <div class="p-6">
                        <h2 class="text-lg font-bold font-['Lexend'] mb-6 flex items-center gap-2 dark:text-white">
                            <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Informasi Lapangan & Jadwal
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-2 block">Pilih Lapangan</label>
                                <div class="relative custom-search-select" data-target="lapangan_id">
                                    <select name="lapangan_id" id="lapangan_id" required class="hidden">
                                        <option value="">-- Pilih Lapangan --</option>
                                        @foreach($lapangans as $lap)
                                        <option value="{{ $lap->id }}" data-harga="{{ $lap->harga }}" {{ old('lapangan_id', $item->lapangan_id) == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="select-btn flex items-center justify-between w-full border border-slate-200 rounded-xl py-3 px-4 text-sm bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:text-white transition-all cursor-pointer hover:border-[#af101a] dark:hover:border-red-500">
                                        <span class="select-text flex-1 text-left text-slate-500 dark:text-gray-400">-- Pilih Lapangan --</span>
                                        <svg class="w-4 h-4 text-slate-400 dark:text-gray-400 transition-transform duration-200 select-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                    <div class="select-menu absolute left-0 top-[calc(100%+0.5rem)] w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-slate-200 dark:border-gray-700 hidden z-50 overflow-hidden">
                                        <div class="p-3 border-b border-slate-100 dark:border-gray-700">
                                            <div class="relative">
                                                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                <input type="text" class="search-input w-full pl-9 pr-3 py-2 bg-slate-50 dark:bg-gray-700 border border-slate-200 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] dark:text-white transition-all" placeholder="Cari lapangan...">
                                            </div>
                                        </div>
                                        <ul class="max-h-60 overflow-y-auto py-1 select-options">
                                            <li data-value="" class="px-4 py-2.5 text-sm font-medium text-slate-500 dark:text-gray-400 cursor-pointer hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">-- Pilih Lapangan --</li>
                                            @foreach($lapangans as $lap)
                                            <li data-value="{{ $lap->id }}" class="px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-gray-200 cursor-pointer hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-[#af101a] dark:hover:text-red-400 transition-colors">{{ $lap->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @error('lapangan_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-2 block">Tanggal Reservasi</label>
                                <input type="text" name="tanggal_booking" value="{{ old('tanggal_booking', \Carbon\Carbon::parse($item->tanggal_booking)->format('Y-m-d')) }}" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm bg-white dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 transition-all datepicker-custom" placeholder="Pilih tanggal" />
                                @error('tanggal_booking') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-100 dark:border-gray-700">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-3 block">Waktu / Slot Reservasi</label>

                            <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-3" id="slots-container">
                                <div class="col-span-full text-center text-xs text-slate-500 py-4">
                                    Silakan pilih Lapangan dan Tanggal terlebih dahulu untuk melihat slot tersedia.
                                </div>
                            </div>
                            @error('slot_waktu')
                            <div class="mt-3 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 text-xs font-semibold flex items-start gap-2">
                                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="mt-5 flex gap-6 items-center text-xs text-slate-500 dark:text-gray-400">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full border border-slate-200 bg-white dark:bg-gray-800 dark:border-gray-600"></span> Tersedia
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-[#af101a]"></span> Terpilih
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Verification Details --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-bold font-['Lexend'] flex items-center gap-2 mb-6 dark:text-white">
                        <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Detail Pembayaran
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                        <div class="md:col-span-2">
                            {{-- Receipt Image Placeholder (If payment exists we can show it, else placeholder) --}}
                            <div class="aspect-[3/4] rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center text-slate-400 group relative overflow-hidden dark:bg-gray-800 dark:border-gray-600 dark:text-gray-500">
                                @if(optional($item->payment)->bukti_pembayaran)
                                <img src="{{ asset('storage/' . $item->payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-full h-full object-cover">
                                @else
                                <svg class="w-12 h-12 mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs font-semibold">Belum Ada Bukti</span>
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-3 space-y-6">
                            <div class="p-5 bg-slate-50 rounded-xl border border-slate-100 dark:bg-gray-700/30 dark:border-gray-700">
                                <p class="text-xs text-slate-500 dark:text-gray-400 font-bold uppercase mb-4 tracking-wider">Ringkasan Harga</p>

                                <div>
                                    <label class="text-sm font-semibold text-slate-700 dark:text-gray-300 block mb-2">Total Harga (Rp)</label>
                                    <input type="number" name="total_harga" value="{{ old('total_harga', $item->total_harga) }}" required min="0" readonly class="w-full border border-slate-200 rounded-lg py-2.5 px-4 font-bold text-lg text-[#af101a] bg-slate-100 cursor-not-allowed dark:bg-gray-800 dark:text-red-400 dark:border-gray-600" />
                                    @error('total_harga') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-200 dark:border-gray-700">
                                    <div class="flex items-start gap-2 p-3 bg-blue-50 border border-blue-100 rounded-lg text-sm text-blue-700 dark:bg-blue-900/20 dark:border-blue-800/50 dark:text-blue-400">
                                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="leading-relaxed text-xs">Pastikan nominal sesuai dengan bukti transfer. Harga akan otomatis diperbarui apabila Anda mengubah pilihan lapangan atau jadwal.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Column --}}
            <div class="space-y-6">

                {{-- Customer Information Card --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-bold font-['Lexend'] mb-5 flex items-center gap-2 dark:text-white">
                        <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Pelanggan
                    </h3>

                    <div class="mb-5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-2 block">Akun Pengguna</label>
                        <div class="relative">
                            <input type="text" value="{{ optional($item->user)->name }}" readonly disabled class="w-full border border-slate-200 rounded-xl py-2.5 px-4 text-sm bg-slate-100 cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-white font-semibold transition-all">
                            <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                        </div>
                        @error('user_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-gray-700">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest block mb-1">Alamat Email</span>
                            <p class="text-slate-800 dark:text-white font-medium text-sm">{{ optional($item->user)->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest block mb-1">Nomor Telepon</span>
                            <p class="text-slate-800 dark:text-white font-medium text-sm">{{ optional($item->user)->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Action / Status Card --}}
                <div class="bg-gradient-to-br from-[#af101a] to-[#7f0d13] p-1 rounded-2xl shadow-xl shadow-red-900/20 relative z-40">
                    <div class="bg-white dark:bg-gray-800 rounded-[14px] p-6">
                        <h3 class="text-center font-bold text-slate-900 dark:text-white mb-1">Aksi & Persetujuan</h3>
                        <p class="text-center text-xs text-slate-500 dark:text-gray-400 mb-6">Atur status reservasi ini</p>

                        <div class="mb-6 relative w-full z-40">
                            <select name="status" id="statusFilter" required class="hidden">
                                <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>🟡 PENDING</option>
                                <option value="confirmed" {{ old('status', $item->status) == 'confirmed' ? 'selected' : '' }}>🔵 CONFIRMED</option>
                                <option value="completed" {{ old('status', $item->status) == 'completed' ? 'selected' : '' }}>🟢 COMPLETED</option>
                                <option value="cancelled" {{ old('status', $item->status) == 'cancelled' ? 'selected' : '' }}>🔴 CANCELLED</option>
                            </select>

                            <div id="custom-status-btn" class="flex items-center justify-between w-full px-4 py-3 border-2 border-slate-200 hover:border-[#af101a] rounded-xl text-sm font-bold text-center appearance-none bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:hover:border-red-500 dark:text-white transition-all cursor-pointer">
                                <span id="custom-status-text" class="flex-1 text-center">
                                    @php
                                    $statusText = [
                                    'pending' => '🟡 PENDING',
                                    'confirmed' => '🔵 CONFIRMED',
                                    'completed' => '🟢 COMPLETED',
                                    'cancelled' => '🔴 CANCELLED',
                                    ];
                                    echo $statusText[old('status', $item->status)] ?? '🟡 PENDING';
                                    @endphp
                                </span>
                                <svg id="custom-status-icon" class="w-4 h-4 text-[#5b403d] dark:text-gray-400 transition-transform duration-200 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>

                            <div id="custom-status-menu" class="absolute left-0 top-[calc(100%+0.5rem)] w-full bg-white dark:bg-gray-800 rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-slate-200 dark:border-gray-700 hidden z-50">
                                <div class="absolute -top-1.5 left-1/2 -translate-x-1/2 w-3 h-3 bg-white dark:bg-gray-800 transform rotate-45 border-t border-l border-slate-200 dark:border-gray-700"></div>
                                <ul class="relative z-10 py-1" id="custom-status-options">
                                    <li data-value="pending" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status', $item->status) == 'pending' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-t-lg">🟡 PENDING</li>
                                    <li data-value="confirmed" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status', $item->status) == 'confirmed' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }}">🔵 CONFIRMED</li>
                                    <li data-value="completed" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status', $item->status) == 'completed' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }}">🟢 COMPLETED</li>
                                    <li data-value="cancelled" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status', $item->status) == 'cancelled' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-b-lg">🔴 CANCELLED</li>
                                </ul>
                            </div>
                            @error('status') <span class="text-red-500 text-xs mt-1 block text-center">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3">
                            <button type="submit" class="w-full py-3 bg-[#af101a] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 shadow-lg shadow-red-700/20 hover:bg-red-800 active:scale-95 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                            <button type="button" onclick="openDeleteModal('{{ route('admin.bookings.destroy', $item->id) }}', 'Reservasi dari {{ addslashes($item->user->name ?? '-') }}')" class="w-full py-3 bg-white dark:bg-gray-800 text-red-600 border-2 border-red-100 dark:border-red-900/50 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-200 active:scale-95 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus Reservasi
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    {{-- Safelist Tailwind Classes --}}
    <div class="hidden peer-checked:border-[#af101a] peer-checked:bg-[#af101a] peer-checked:text-white dark:peer-checked:bg-red-600 dark:peer-checked:border-red-500"></div>
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
                Kembali
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
                deleteFeedback.innerHTML = '<p class="flex items-center gap-2">✅ Berhasil dihapus. Mengalihkan...</p>';
                setTimeout(() => {
                    window.location.href = "{{ route('admin.bookings.index') }}";
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

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Robust Custom Searchable Select Logic
        window.initCustomSearchSelect = function() {
            document.querySelectorAll('.custom-search-select').forEach(container => {
                if (container.dataset.initialized) return;
                container.dataset.initialized = "true";
                
                const select = container.querySelector('select');
                const btn = container.querySelector('.select-btn');
                const text = container.querySelector('.select-text');
                const icon = container.querySelector('.select-icon');
                const menu = container.querySelector('.select-menu');
                const searchInput = container.querySelector('.search-input');
                const options = container.querySelectorAll('.select-options li');

                if (!select || !btn || !menu) return;

                const updateActiveOption = (val) => {
                    options.forEach(opt => {
                        if (opt.getAttribute('data-value') === val) {
                            opt.classList.add('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400');
                            opt.classList.remove('text-slate-700', 'dark:text-gray-200');
                        } else {
                            opt.classList.remove('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400');
                            if (opt.getAttribute('data-value') !== "") {
                                opt.classList.add('text-slate-700', 'dark:text-gray-200');
                            }
                        }
                    });
                };

                // Initialize text
                if (select.selectedIndex >= 0) {
                    const selectedOption = select.options[select.selectedIndex];
                    if (selectedOption && selectedOption.value) {
                        text.innerText = selectedOption.innerText;
                        text.classList.remove('text-slate-500', 'dark:text-gray-400');
                        updateActiveOption(selectedOption.value);
                    }
                }

                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isHidden = menu.classList.contains('hidden');
                    
                    document.querySelectorAll('.select-menu').forEach(m => m.classList.add('hidden'));
                    document.querySelectorAll('.select-icon').forEach(i => i.classList.remove('rotate-180'));
                    
                    if (isHidden) {
                        menu.classList.remove('hidden');
                        if (icon) icon.classList.add('rotate-180');
                        setTimeout(() => searchInput.focus(), 50);
                    }
                });

                menu.addEventListener('click', (e) => {
                    e.stopPropagation();
                });

                searchInput.addEventListener('input', (e) => {
                    const val = e.target.value.toLowerCase();
                    options.forEach(opt => {
                        const valAttr = opt.getAttribute('data-value');
                        if (valAttr === "") return;
                        if(opt.innerText.toLowerCase().includes(val)) {
                            opt.style.display = 'block';
                        } else {
                            opt.style.display = 'none';
                        }
                    });
                });

                options.forEach(opt => {
                    opt.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const val = opt.getAttribute('data-value');
                        select.value = val;
                        text.innerText = opt.innerText;
                        if(val) {
                            text.classList.remove('text-slate-500', 'dark:text-gray-400');
                        } else {
                            text.classList.add('text-slate-500', 'dark:text-gray-400');
                        }
                        
                        updateActiveOption(val);
                        select.dispatchEvent(new Event('change'));

                        menu.classList.add('hidden');
                        if (icon) icon.classList.remove('rotate-180');
                        searchInput.value = ''; 
                        options.forEach(o => o.style.display = 'block');
                    });
                });
            });
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', window.initCustomSearchSelect);
        } else {
            window.initCustomSearchSelect();
        }

        document.addEventListener('click', () => {
            document.querySelectorAll('.select-menu').forEach(m => m.classList.add('hidden'));
            document.querySelectorAll('.select-icon').forEach(i => i.classList.remove('rotate-180'));
        });

        const Indonesian = {
            weekdays: {
                shorthand: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                longhand: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
            },
            months: {
                shorthand: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                longhand: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            },
            firstDayOfWeek: 1,
            time_24hr: true
        };

        flatpickr('.datepicker-custom', {
            locale: Indonesian,
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "j F Y",
            disableMobile: "true",
            onChange: function() {
                fetchSlots();
            }
        });

        const originalLapanganId = "{{ $item->lapangan_id }}";
        const originalTanggal = "{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('Y-m-d') }}";
        const currentBookingSlots = [{{ implode(',', $item->bookingDetails->pluck('slot_waktu_id')->toArray()) }}];
        const oldSlots = {!! json_encode(old('slot_waktu', [])) !!}.map(id => parseInt(id));

        async function fetchSlots() {
            let lapanganId;
            const selectEl = document.querySelector('select[name="lapangan_id"]');
            if (selectEl && selectEl.tomselect) {
                lapanganId = selectEl.tomselect.getValue();
            } else if (selectEl) {
                lapanganId = selectEl.value;
            }
            const tanggal = document.querySelector('input[name="tanggal_booking"]').value;

            const container = document.getElementById('slots-container');

            if (!lapanganId || !tanggal) {
                container.innerHTML = '<div class="col-span-full text-center text-xs text-slate-500 py-4">Silakan pilih Lapangan dan Tanggal terlebih dahulu untuk melihat slot tersedia.</div>';
                calculateTotal();
                return;
            }

            container.innerHTML = '<div class="col-span-full text-center text-xs text-slate-500 py-4"><svg class="animate-spin h-5 w-5 mx-auto text-[#af101a]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memuat slot...</div>';

            try {
                const response = await fetch(`/lapangan/${lapanganId}/slots?tanggal=${tanggal}`);
                const slots = await response.json();

                container.innerHTML = '';

                if (slots.length === 0) {
                    container.innerHTML = '<div class="col-span-full text-center text-xs text-slate-500 py-4">Tidak ada slot tersedia untuk lapangan ini.</div>';
                }

                const isOriginalDateAndVenue = (lapanganId == originalLapanganId && tanggal == originalTanggal);

                slots.forEach(slot => {
                    const timeStr = slot.waktu_mulai.substring(0, 5);
                    const isCurrentBookingSlot = isOriginalDateAndVenue && currentBookingSlots.includes(slot.id);
                    const isBooked = slot.is_booked && !isCurrentBookingSlot; // disable only if it's booked by OTHERS

                    // If validation failed, use old inputs, else if original, check if part of booking
                    let isChecked = false;
                    if (oldSlots.length > 0) {
                        isChecked = oldSlots.includes(slot.id);
                    } else {
                        isChecked = isCurrentBookingSlot;
                    }

                    const isDisabled = isBooked ? 'disabled' : '';
                    const bgClass = isBooked ?
                        'bg-slate-100 text-slate-400 border-slate-200 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500' :
                        'bg-white border-slate-200 cursor-pointer hover:border-[#af101a] hover:text-[#af101a] dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300';
                    const peerCheckedClass = isBooked ?
                        '' :
                        'peer-checked:border-[#af101a] peer-checked:bg-[#af101a] peer-checked:text-white dark:peer-checked:bg-red-600 dark:peer-checked:border-red-500';

                    const html = `
                        <label class="${isBooked ? '' : 'cursor-pointer group'}">
                            <input type="checkbox" name="slot_waktu[]" value="${slot.id}" class="peer sr-only" ${isDisabled} ${isChecked ? 'checked' : ''} onchange="calculateTotal()" />
                            <div class="p-3 text-xs font-semibold rounded-lg border transition-all text-center ${bgClass} ${peerCheckedClass}">
                                ${timeStr}
                            </div>
                        </label>
                    `;
                    container.insertAdjacentHTML('beforeend', html);
                });
                calculateTotal();
            } catch (error) {
                console.error('Error fetching slots:', error);
                container.innerHTML = '<div class="col-span-full text-center text-xs text-red-500 py-4">Gagal memuat slot. Silakan coba lagi.</div>';
            }
        }

        window.calculateTotal = function() {
            const selectEl = document.querySelector('select[name="lapangan_id"]');
            let harga = 0;
            if (selectEl && selectEl.tomselect) {
                const selectedValue = selectEl.tomselect.getValue();
                const optionEl = selectEl.querySelector('option[value="' + selectedValue + '"]');
                harga = optionEl ? parseInt(optionEl.getAttribute('data-harga')) || 0 : 0;
            } else if (selectEl) {
                // fallback if tomselect not initialized yet
                const selectedOption = selectEl.options[selectEl.selectedIndex];
                harga = selectedOption ? parseInt(selectedOption.getAttribute('data-harga')) || 0 : 0;
            }
            const checkedSlots = document.querySelectorAll('input[name="slot_waktu[]"]:checked').length;
            document.querySelector('input[name="total_harga"]').value = harga * checkedSlots;
        };

        const lapanganSelect = document.querySelector('select[name="lapangan_id"]');
        if (lapanganSelect) {
            lapanganSelect.addEventListener('change', fetchSlots);
        }

        fetchSlots();

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

                        statusOptions.forEach(opt => {
                            opt.classList.remove('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400');
                            opt.classList.add('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                        });

                        this.classList.remove('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                        this.classList.add('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400');

                        statusMenu.classList.add('hidden');
                        statusIcon.classList.remove('rotate-180');
                    });
                });
            }
        }
    });
</script>

@endpush
@endsection