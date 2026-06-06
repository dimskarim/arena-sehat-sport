@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.oprational-waktus.index') }}" class="hover:text-red-700 dark:hover:text-red-400 transition-colors">Oprational Waktu</a>
                <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-900 dark:text-white font-semibold">Ubah Jadwal</span>
            </div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white">Ubah Jadwal Operasional</h1>
            <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Perbarui informasi jadwal operasional untuk venue lapangan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.oprational-waktus.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Batal
            </a>
            <button type="submit" form="editForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95 dark:bg-red-600 dark:hover:bg-red-700">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </div>

    {{-- Form --}}
    <form id="editForm" action="{{ route('admin.oprational-waktus.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 dark:border-gray-700">
                <svg class="text-red-700 dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="font-['Lexend'] text-base font-semibold text-slate-900 dark:text-white">Informasi Jadwal</h2>
            </div>
            
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Venue Lapangan <span class="text-red-600">*</span>
                    </label>
                    <select name="lapangan_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30">
                        <option value="">Pilih Venue</option>
                        @foreach($lapangans as $lap)
                            <option value="{{ $lap->id }}" {{ old('lapangan_id', $item->lapangan_id) == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                        @endforeach
                    </select>
                    @error('lapangan_id') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Hari Operasional <span class="text-red-600">*</span>
                    </label>
                    <select name="hari" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30">
                        <option value="">Pilih Hari Operasional</option>
                        <option value="Senin" {{ old('hari', $item->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('hari', $item->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('hari', $item->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('hari', $item->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('hari', $item->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('hari', $item->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        <option value="Minggu" {{ old('hari', $item->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                    </select>
                    @error('hari') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Jam Buka <span class="text-red-600">*</span>
                    </label>
                    <input type="time" name="waktu_buka" value="{{ old('waktu_buka', substr($item->waktu_buka, 0, 5)) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" />
                    @error('waktu_buka') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Jam Tutup <span class="text-red-600">*</span>
                    </label>
                    <input type="time" name="waktu_tutup" value="{{ old('waktu_tutup', substr($item->waktu_tutup, 0, 5)) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" />
                    @error('waktu_tutup') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</div>
@endsection