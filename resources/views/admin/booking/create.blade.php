@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">
    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf
        
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <nav class="flex text-xs text-slate-500 mb-2 gap-2">
                    <a href="{{ route('admin.bookings.index') }}" class="hover:text-[#af101a] transition-colors">Daftar Reservasi</a>
                    <span>/</span>
                    <span class="text-[#af101a] font-medium">Buat Reservasi Baru</span>
                </nav>
                <h1 class="text-3xl font-bold font-['Lexend'] tracking-tight">Buat Reservasi Baru</h1>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.bookings.index') }}" class="text-slate-500 hover:text-[#af101a] font-medium text-sm transition-colors">Batal</a>
                <button type="submit" class="bg-[#af101a] hover:bg-red-800 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-md shadow-red-700/20 active:scale-95 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Simpan Reservasi
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- User Selection --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold font-['Lexend'] flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Pilih Pelanggan <span class="text-red-500">*</span>
                        </h2>
                    </div>
                    <div class="relative">
                        <select name="user_id" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] transition-all text-sm appearance-none bg-slate-50">
                            <option value="">-- Pilih Pengguna --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @error('user_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Venue Selection --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <h2 class="text-lg font-bold font-['Lexend'] flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Pilihan Venue & Lapangan
                    </h2>
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 block">Lapangan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="lapangan_id" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm appearance-none bg-slate-50 transition-all">
                                <option value="">-- Pilih Lapangan --</option>
                                @foreach($lapangans as $lap)
                                    <option value="{{ $lap->id }}" {{ old('lapangan_id') == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('lapangan_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Date & Time Selection --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                        <h2 class="text-lg font-bold font-['Lexend'] flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Penjadwalan Waktu
                        </h2>
                    </div>
                    
                    <div class="mb-6">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 block">Tanggal Reservasi <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking') }}" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm bg-slate-50 transition-all" />
                        @error('tanggal_booking') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 block">Pilih Waktu / Slot <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-3">
                            @for($i = 6; $i <= 22; $i++)
                                @php 
                                    $time = sprintf('%02d:00', $i); 
                                @endphp
                                <label class="cursor-pointer group">
                                    <input type="checkbox" name="slot_waktu[]" value="{{ $time }}" class="peer sr-only" />
                                    <div class="p-3 text-xs font-semibold rounded-lg border border-slate-200 bg-white group-hover:border-[#af101a] group-hover:text-[#af101a] peer-checked:border-[#af101a] peer-checked:bg-[#af101a] peer-checked:text-white transition-all text-center">
                                        {{ $time }}
                                    </div>
                                </label>
                            @endfor
                        </div>
                        <div class="mt-6 flex gap-6 items-center text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full border border-slate-200 bg-white"></span> Tersedia
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#af101a]"></span> Terpilih
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-slate-100 opacity-50"></span> Terisi
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Column --}}
            <div class="space-y-6">
                
                {{-- Pricing & Status --}}
                <div class="bg-gradient-to-br from-[#af101a] to-[#7f0d13] text-white p-6 rounded-xl shadow-lg shadow-red-900/20 relative overflow-hidden">
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h2 class="text-lg font-bold font-['Lexend'] mb-6 relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pembayaran & Status
                    </h2>
                    
                    <div class="space-y-4 relative z-10">
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-red-200 mb-2 block">Total Harga (Rp) <span class="text-white">*</span></label>
                            <input type="number" name="total_harga" value="{{ old('total_harga') }}" required min="0" class="w-full border border-red-800/50 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white/50 text-slate-900 text-lg font-bold shadow-inner" placeholder="Contoh: 150000" />
                            @error('total_harga') <span class="text-red-200 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4 border-t border-red-800/50">
                            <label class="text-xs font-bold uppercase tracking-wider text-red-200 mb-2 block">Status Reservasi <span class="text-white">*</span></label>
                            <div class="relative">
                                <select name="status" required class="w-full border border-red-800/50 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white/50 text-slate-900 text-sm font-bold appearance-none shadow-inner">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('status') <span class="text-red-200 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection