@extends('layouts.app')

@section('content')
<div id="time-content-container" class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900 dark:text-white transition-opacity duration-300 relative">
    <div class="min-h-[70vh] m-auto flex items-center justify-center p-4 font-['Inter']">
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-slate-100 dark:border-gray-700 relative">

            {{-- Header --}}
            <div class="rounded-t-2xl px-6 py-5 border-b border-slate-100 dark:border-gray-700 bg-slate-50/50 dark:bg-gray-900/20 flex items-center justify-between">
                <div>
                    <h2 class="font-['Lexend'] text-xl font-bold text-slate-900 dark:text-white">Tambah Jadwal Operasional</h2>
                    <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Lengkapi form di bawah untuk membuat jadwal baru.</p>
                </div>
                <a href="{{ route('admin.oprational-waktus.index') }}" class="p-2 text-slate-400 hover:text-red-600 transition-colors rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.oprational-waktus.store') }}" method="POST">
                @csrf

                <div class="p-6 space-y-5">
                    <div class="relative z-50" x-data="{
                        open: false,
                        search: '',
                        value: '{{ old('lapangan_id', request('lapangan_id')) }}',
                        text: 'Pilih Venue Lapangan',
                        options: [
                            @foreach($lapangans as $lap)
                            { id: '{{ $lap->id }}', name: '{{ addslashes($lap->name) }}' },
                            @endforeach
                        ],
                        get filteredOptions() {
                            if (this.search === '') return this.options;
                            return this.options.filter(opt => opt.name.toLowerCase().includes(this.search.toLowerCase()));
                        },
                        selectOption(opt) {
                            this.value = opt.id;
                            this.text = opt.name;
                            this.open = false;
                            this.search = '';
                        },
                        init() {
                            if (this.value) {
                                const selected = this.options.find(o => o.id == this.value);
                                if (selected) this.text = selected.name;
                            }
                            this.$watch('open', val => {
                                if (val) setTimeout(() => this.$refs.searchInput.focus(), 50);
                            });
                        }
                    }" @click.outside="open = false">
                        <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                            Venue Lapangan <span class="text-red-600">*</span>
                        </label>
                        
                        <input type="hidden" name="lapangan_id" x-model="value" required>
                        
                        <button type="button" @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 bg-slate-50 border {{ $errors->has('lapangan_id') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-slate-200 dark:border-gray-600' }} rounded-xl text-sm transition-all focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none dark:bg-gray-700/50 dark:focus:ring-red-500/30">
                            <span class="truncate" :class="value ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-gray-400'" x-text="text"></span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" style="display: none;" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-xl shadow-lg">
                            <div class="p-2 border-b border-slate-100 dark:border-gray-700">
                                <input type="text" x-model="search" x-ref="searchInput" class="w-full px-3 py-2 bg-slate-50 dark:bg-gray-700 border border-slate-200 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] dark:text-white" placeholder="Cari venue lapangan..." autocomplete="off">
                            </div>
                            <ul class="max-h-60 overflow-y-auto p-1">
                                <li class="px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-gray-700 rounded-md cursor-pointer transition-colors"
                                    :class="value === '' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-200'"
                                    @click="value = ''; text = 'Pilih Venue Lapangan'; open = false; search = ''">Pilih Venue Lapangan</li>
                                
                                <template x-for="opt in filteredOptions" :key="opt.id">
                                    <li class="px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-gray-700 rounded-md cursor-pointer transition-colors"
                                        :class="value == opt.id ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-200'"
                                        @click="selectOption(opt)" x-text="opt.name">
                                    </li>
                                </template>
                                
                                <li x-show="filteredOptions.length === 0" class="px-3 py-4 text-center text-sm text-slate-500 dark:text-gray-400">
                                    Tidak ada hasil ditemukan
                                </li>
                            </ul>
                        </div>
                        @error('lapangan_id') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative z-40" x-data="{
                        open: false,
                        search: '',
                        value: '{{ old('hari') }}',
                        text: 'Pilih Hari',
                        options: [
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            { id: '{{ $hari }}', name: '{{ $hari }}' },
                            @endforeach
                        ],
                        get filteredOptions() {
                            if (this.search === '') return this.options;
                            return this.options.filter(opt => opt.name.toLowerCase().includes(this.search.toLowerCase()));
                        },
                        selectOption(opt) {
                            this.value = opt.id;
                            this.text = opt.name;
                            this.open = false;
                            this.search = '';
                        },
                        init() {
                            if (this.value) {
                                const selected = this.options.find(o => o.id == this.value);
                                if (selected) this.text = selected.name;
                            }
                            this.$watch('open', val => {
                                if (val) setTimeout(() => this.$refs.searchInput.focus(), 50);
                            });
                        }
                    }" @click.outside="open = false">
                        <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                            Hari Operasional <span class="text-red-600">*</span>
                        </label>
                        
                        <input type="hidden" name="hari" x-model="value" required>
                        
                        <button type="button" @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 bg-slate-50 border {{ $errors->has('hari') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-slate-200 dark:border-gray-600' }} rounded-xl text-sm transition-all focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none dark:bg-gray-700/50 dark:focus:ring-red-500/30">
                            <span class="truncate" :class="value ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-gray-400'" x-text="text"></span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" style="display: none;" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 rounded-xl shadow-lg">
                            <div class="p-2 border-b border-slate-100 dark:border-gray-700">
                                <input type="text" x-model="search" x-ref="searchInput" class="w-full px-3 py-2 bg-slate-50 dark:bg-gray-700 border border-slate-200 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] dark:text-white" placeholder="Cari hari..." autocomplete="off">
                            </div>
                            <ul class="max-h-60 overflow-y-auto p-1">
                                <li class="px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-gray-700 rounded-md cursor-pointer transition-colors"
                                    :class="value === '' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-200'"
                                    @click="value = ''; text = 'Pilih Hari'; open = false; search = ''">Pilih Hari</li>
                                
                                <template x-for="opt in filteredOptions" :key="opt.id">
                                    <li class="px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-gray-700 rounded-md cursor-pointer transition-colors"
                                        :class="value == opt.id ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-200'"
                                        @click="selectOption(opt)" x-text="opt.name">
                                    </li>
                                </template>
                                
                                <li x-show="filteredOptions.length === 0" class="px-3 py-4 text-center text-sm text-slate-500 dark:text-gray-400">
                                    Tidak ada hasil ditemukan
                                </li>
                            </ul>
                        </div>
                        @error('hari') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                                Jam Buka <span class="text-red-600">*</span>
                            </label>
                            <input type="time" name="waktu_buka" value="{{ old('waktu_buka') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 timepicker-custom" />
                            @error('waktu_buka') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                                Jam Tutup <span class="text-red-600">*</span>
                            </label>
                            <input type="time" name="waktu_tutup" value="{{ old('waktu_tutup') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 timepicker-custom" />
                            @error('waktu_tutup') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="rounded-b-2xl px-6 py-4 bg-slate-50/50 dark:bg-gray-900/20 border-t border-slate-100 dark:border-gray-700 flex justify-end gap-3">
                    <a href="{{ route('admin.oprational-waktus.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-bold text-slate-600 hover:bg-slate-100 transition-colors dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#af101a] text-white text-sm font-bold hover:bg-red-800 transition-all shadow-md shadow-red-700/20 dark:bg-red-600 dark:hover:bg-red-700">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
