@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">
    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf
        
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <nav class="flex text-xs text-slate-500 dark:text-gray-400 mb-2 gap-2">
                    <a href="{{ route('admin.bookings.index') }}" class="hover:text-[#af101a] dark:hover:text-red-400 transition-colors">Daftar Reservasi</a>
                    <span>/</span>
                    <span class="text-[#af101a] dark:text-red-400 font-medium">Buat Reservasi Baru</span>
                </nav>
                <h1 class="text-3xl font-bold font-['Lexend'] tracking-tight dark:text-white">Buat Reservasi Baru</h1>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.bookings.index') }}" class="text-slate-500 dark:text-gray-400 hover:text-[#af101a] dark:hover:text-red-400 font-medium text-sm transition-colors">Kembali</a>
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
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold font-['Lexend'] flex items-center gap-2 dark:text-white">
                            <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Pilih Pelanggan <span class="text-red-500 dark:text-red-400">*</span>
                        </h2>
                    </div>
                    <div class="relative">
                        <select name="user_id" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] transition-all text-sm bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 tom-select-custom">
                            <option value="">-- Pilih Pengguna --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Venue Selection --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 dark:bg-gray-800 dark:border-gray-700">
                    <h2 class="text-lg font-bold font-['Lexend'] flex items-center gap-2 mb-6 dark:text-white">
                        <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Pilihan Venue & Lapangan
                    </h2>
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-2 block">Lapangan <span class="text-red-500 dark:text-red-400">*</span></label>
                        <div class="relative">
                            <select name="lapangan_id" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 transition-all tom-select-custom">
                                <option value="">-- Pilih Lapangan --</option>
                                @foreach($lapangans as $lap)
                                    <option value="{{ $lap->id }}" data-harga="{{ $lap->harga }}" {{ old('lapangan_id') == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('lapangan_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Date & Time Selection --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                        <h2 class="text-lg font-bold font-['Lexend'] flex items-center gap-2 dark:text-white">
                            <svg class="w-5 h-5 text-[#af101a] dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Penjadwalan Waktu
                        </h2>
                    </div>
                    
                    <div class="mb-6">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-2 block">Tanggal Reservasi <span class="text-red-500 dark:text-red-400">*</span></label>
                        <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking') }}" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 transition-all datepicker-custom bg-white" placeholder="Pilih tanggal" />
                        @error('tanggal_booking') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-2 block">Pilih Waktu / Slot <span class="text-red-500 dark:text-red-400">*</span></label>
                        <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-3" id="slots-container">
                            <div class="col-span-full text-center text-xs text-slate-500 py-4">
                                Silakan pilih Lapangan dan Tanggal terlebih dahulu untuk melihat slot tersedia.
                            </div>
                        </div>
                        @error('slot_waktu') 
                            <div class="mt-3 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 text-xs font-semibold flex items-start gap-2">
                                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-6 flex gap-6 items-center text-xs text-slate-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full border border-slate-200 bg-white dark:bg-gray-800 dark:border-gray-600"></span> Tersedia
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-[#af101a]"></span> Terpilih
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-slate-100 opacity-50 dark:bg-gray-600"></span> Terisi
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Column --}}
            <div class="space-y-6">
                
                {{-- Pricing & Status --}}
                <div class="bg-gradient-to-br from-[#af101a] to-[#7f0d13] text-white p-6 rounded-xl shadow-lg shadow-red-900/20 relative z-40">
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h2 class="text-lg font-bold font-['Lexend'] mb-6 relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pembayaran & Status
                    </h2>
                    
                    <div class="space-y-4 relative z-10">
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-red-200 mb-2 block">Total Harga (Rp) <span class="text-white">*</span></label>
                            <input type="number" name="total_harga" value="{{ old('total_harga') }}" required min="0" readonly class="w-full border border-red-800/50 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-white/50 text-slate-900 bg-slate-100 dark:bg-gray-800/80 dark:text-white dark:border-red-900/50 text-lg font-bold shadow-inner cursor-not-allowed" placeholder="Otomatis dihitung..." />
                            @error('total_harga') <span class="text-red-200 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4 border-t border-red-800/50 relative z-40">
                            <label class="text-xs font-bold uppercase tracking-wider text-red-200 mb-2 block">Status Reservasi <span class="text-white">*</span></label>
                            
                            <div class="relative w-full">
                                <select name="status" id="statusFilter" required class="hidden">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>🟡 PENDING</option>
                                    <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>🔵 CONFIRMED</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>🟢 COMPLETED</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>🔴 CANCELLED</option>
                                </select>

                                <div id="custom-status-btn" class="flex items-center justify-between w-full px-4 py-3 border-2 border-white/50 hover:bg-white/20 rounded-xl text-sm font-bold text-center appearance-none bg-white/10 dark:bg-gray-700/50 text-white transition-all cursor-pointer backdrop-blur-sm">
                                    <span id="custom-status-text" class="flex-1 text-center">
                                        @php
                                            $statusText = [
                                                'pending' => '🟡 PENDING',
                                                'confirmed' => '🔵 CONFIRMED',
                                                'completed' => '🟢 COMPLETED',
                                                'cancelled' => '🔴 CANCELLED',
                                            ];
                                            echo $statusText[old('status', 'pending')] ?? '🟡 PENDING';
                                        @endphp
                                    </span>
                                    <svg id="custom-status-icon" class="w-4 h-4 text-white transition-transform duration-200 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>

                                <div id="custom-status-menu" class="absolute left-0 top-[calc(100%+0.5rem)] w-full bg-white dark:bg-gray-800 rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-slate-200 dark:border-gray-700 hidden z-50">
                                    <div class="absolute -top-1.5 left-1/2 -translate-x-1/2 w-3 h-3 bg-white dark:bg-gray-800 transform rotate-45 border-t border-l border-slate-200 dark:border-gray-700"></div>
                                    <ul class="relative z-10 py-1" id="custom-status-options">
                                        <li data-value="pending" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status', 'pending') == 'pending' ? 'bg-red-100 text-[#af101a]' : 'text-slate-700 hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400 rounded-t-lg">🟡 PENDING</li>
                                        <li data-value="confirmed" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status') == 'confirmed' ? 'bg-red-100 text-[#af101a]' : 'text-slate-700 hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400">🔵 CONFIRMED</li>
                                        <li data-value="completed" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status') == 'completed' ? 'bg-red-100 text-[#af101a]' : 'text-slate-700 hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400">🟢 COMPLETED</li>
                                        <li data-value="cancelled" class="px-4 py-2.5 text-sm font-bold cursor-pointer transition-colors {{ old('status') == 'cancelled' ? 'bg-red-100 text-[#af101a]' : 'text-slate-700 hover:bg-red-100 hover:text-[#af101a]' }} dark:text-gray-300 dark:hover:bg-red-900/30 dark:hover:text-red-400 rounded-b-lg">🔴 CANCELLED</li>
                                    </ul>
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

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.tom-select-custom').forEach((el) => {
            new TomSelect(el, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                onChange: function() { 
                    if(typeof fetchSlots === 'function') fetchSlots(); 
                }
            });
        });

        flatpickr('.datepicker-custom', {
            dateFormat: "Y-m-d",
            minDate: "today",
            disableMobile: "true",
            onChange: function() { fetchSlots(); }
        });

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
                document.querySelector('input[name="total_harga"]').value = 0;
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

                const oldSlots = {!! json_encode(old('slot_waktu', [])) !!}.map(id => parseInt(id));

                slots.forEach(slot => {
                    const timeStr = slot.waktu_mulai.substring(0, 5);
                    const isDisabled = slot.is_booked ? 'disabled' : '';
                    const isChecked = oldSlots.includes(slot.id);

                    const bgClass = slot.is_booked 
                        ? 'bg-slate-100 text-slate-400 border-slate-200 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500' 
                        : 'bg-white border-slate-200 cursor-pointer hover:border-red-700 hover:text-red-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:border-red-500 dark:hover:text-red-400';
                    const peerCheckedClass = slot.is_booked 
                        ? '' 
                        : 'peer-checked:border-red-700 peer-checked:bg-red-700 peer-checked:text-white dark:peer-checked:bg-red-600 dark:peer-checked:border-red-500 dark:peer-checked:text-white';
                    
                    const html = `
                        <label class="${slot.is_booked ? '' : 'cursor-pointer group'}">
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
            if(selectEl && selectEl.tomselect) {
                const selectedValue = selectEl.tomselect.getValue();
                const optionEl = selectEl.querySelector('option[value="'+selectedValue+'"]');
                const harga = optionEl ? parseInt(optionEl.getAttribute('data-harga')) || 0 : 0;
                const checkedSlots = document.querySelectorAll('input[name="slot_waktu[]"]:checked').length;
                
                document.querySelector('input[name="total_harga"]').value = harga * checkedSlots;
            } else if (selectEl) {
                // fallback if tomselect not initialized yet
                const selectedOption = selectEl.options[selectEl.selectedIndex];
                const harga = selectedOption ? parseInt(selectedOption.getAttribute('data-harga')) || 0 : 0;
                const checkedSlots = document.querySelectorAll('input[name="slot_waktu[]"]:checked').length;
                document.querySelector('input[name="total_harga"]').value = harga * checkedSlots;
            }
        };

        const lapanganSelect = document.querySelector('select[name="lapangan_id"]');
        if(lapanganSelect) {
            lapanganSelect.addEventListener('change', fetchSlots);
        }
        
        // Initialize total calculation
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
                            opt.classList.remove('bg-red-100', 'text-[#af101a]');
                            opt.classList.add('text-slate-700');
                        });
                        
                        this.classList.remove('text-slate-700');
                        this.classList.add('bg-red-100', 'text-[#af101a]');
                        
                        statusMenu.classList.add('hidden');
                        statusIcon.classList.remove('rotate-180');
                    });
                });
            }
        }
    });
</script>
<style>
    .ts-wrapper.form-control {
        border: none;
        padding: 0;
        background: transparent;
    }
    .ts-control {
        border-radius: 0.75rem !important;
        padding: 0.75rem 1rem !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
        font-size: 0.875rem !important;
        min-height: 46px !important;
    }
    .dark .ts-control {
        border-color: #4b5563 !important;
        background-color: rgba(55, 65, 81, 0.5) !important;
        color: white !important;
    }
    .dark .ts-dropdown {
        background-color: #1f2937 !important;
        border-color: #374151 !important;
        color: white !important;
    }
    .dark .ts-dropdown .option {
        color: white !important;
    }
    .dark .ts-dropdown .option.active, .dark .ts-dropdown .option:hover {
        background-color: #374151 !important;
        color: white !important;
    }
</style>
@endpush
@endsection
