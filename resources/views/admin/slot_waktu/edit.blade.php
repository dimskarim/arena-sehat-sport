@extends('layouts.app')

@section('content')
<div id="time-content-container" class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900 dark:text-white transition-opacity duration-300 relative">
    <div class="min-h-[70vh] m-auto flex items-center justify-center p-4 font-['Inter']">
        <div class="w-fit bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-slate-100 dark:border-gray-700 relative">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-slate-100 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-900/20 flex items-center justify-between">
                <div>
                    <h2 class="font-['Lexend'] text-xl font-bold text-slate-900 dark:text-white">Ubah Data Slot Waktu</h2>
                    <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Perbarui jadwal jam operasional untuk penyewaan.</p>
                </div>
                <a href="{{ route('admin.slot-waktus.index') }}" class="p-2 text-slate-400 hover:text-red-600 transition-colors rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.slot-waktus.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                            Hari Operasional Lapangan <span class="text-red-600">*</span>
                        </label>
                        <select name="waktu_operasional_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30">
                            <option value="">Pilih Hari Operasional Lapangan</option>
                            @foreach($waktuOperasionals as $wo)
                            <option value="{{ $wo->id }}" {{ old('waktu_operasional_id', $item->waktu_operasional_id) == $wo->id ? 'selected' : '' }}>
                                {{ optional($wo->lapangan)->name }} - Hari {{ $wo->hari }} ({{ substr($wo->waktu_buka, 0, 5) }} - {{ substr($wo->waktu_tutup, 0, 5) }})
                            </option>
                            @endforeach
                        </select>
                        @error('waktu_operasional_id') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                                Jam Mulai <span class="text-red-600">*</span>
                            </label>
                            <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai', substr($item->waktu_mulai, 0, 5)) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" />
                            @error('waktu_mulai') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                                Jam Selesai <span class="text-red-600">*</span>
                            </label>
                            <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', substr($item->waktu_selesai, 0, 5)) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" />
                            @error('waktu_selesai') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 bg-slate-50/50 dark:bg-gray-900/20 border-t border-slate-100 dark:border-gray-700 flex justify-end gap-3">
                    <a href="{{ route('admin.slot-waktus.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-600 hover:bg-slate-100 transition-colors dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#af101a] text-white text-sm font-bold hover:bg-red-800 transition-all shadow-md shadow-red-700/20 dark:bg-red-600 dark:hover:bg-red-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection