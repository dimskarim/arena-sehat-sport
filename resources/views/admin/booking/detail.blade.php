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
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
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
                                <div class="relative">
                                    <select name="lapangan_id" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm appearance-none bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 transition-all">
                                        <option value="">Pilih Lapangan</option>
                                        @foreach($lapangans as $lap)
                                        <option value="{{ $lap->id }}" {{ old('lapangan_id', $item->lapangan_id) == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('lapangan_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-2 block">Tanggal Reservasi</label>
                                <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking', $item->tanggal_booking) }}" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 transition-all" />
                                @error('tanggal_booking') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-100 dark:border-gray-700">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-3 block">Waktu / Slot Reservasi</label>

                            {{-- Simulated selected slots based on old relations if any. Assuming $item->bookingDetails has slotWaktu --}}
                            @php
                            $selectedSlots = [];
                            if(isset($item->bookingDetails)) {
                            foreach($item->bookingDetails as $bd) {
                            if($bd->slotWaktu) {
                            $selectedSlots[] = substr($bd->slotWaktu->waktu_mulai, 0, 5);
                            }
                            }
                            }
                            // Dummy fallback or old input
                            $oldSlots = old('slot_waktu', $selectedSlots);
                            @endphp

                            <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-3">
                                @for($i = 6; $i <= 22; $i++)
                                    @php
                                    $time=sprintf('%02d:00', $i);
                                    $isChecked=in_array($time, $oldSlots);
                                    @endphp
                                    <label class="cursor-pointer group">
                                    <input type="checkbox" name="slot_waktu[]" value="{{ $time }}" class="peer sr-only" {{ $isChecked ? 'checked' : '' }} />
                                    <div class="p-3 text-xs font-semibold rounded-lg border border-slate-200 bg-white group-hover:border-[#af101a] group-hover:text-[#af101a] peer-checked:border-[#af101a] peer-checked:bg-[#af101a] peer-checked:text-white transition-all text-center dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                        {{ $time }}
                                    </div>
                                    </label>
                                    @endfor
                            </div>

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
                                    <label class="text-sm font-semibold text-slate-700 dark:text-gray-300 block mb-2">Ubah Total Harga (Rp)</label>
                                    <input type="number" name="total_harga" value="{{ old('total_harga', $item->total_harga) }}" required min="0" class="w-full border border-slate-200 rounded-lg py-2.5 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] font-bold text-lg text-[#af101a] dark:text-red-400 transition-all bg-white dark:bg-gray-800/50 dark:border-gray-600" />
                                    @error('total_harga') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-200 dark:border-gray-700">
                                    <div class="flex items-start gap-2 p-3 bg-blue-50 border border-blue-100 rounded-lg text-sm text-blue-700 dark:bg-blue-900/20 dark:border-blue-800/50 dark:text-blue-400">
                                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="leading-relaxed text-xs">Pastikan nominal sesuai dengan bukti transfer. Jika tidak, Anda dapat mengedit harga di atas.</span>
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
                            <select name="user_id" required class="w-full border border-slate-200 rounded-xl py-2.5 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm appearance-none bg-slate-50 dark:bg-gray-700/50 dark:border-gray-600 dark:text-white font-semibold transition-all">
                                <option value="">Pilih User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
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
                <div class="bg-gradient-to-br from-[#af101a] to-[#7f0d13] p-1 rounded-2xl shadow-xl shadow-red-900/20 overflow-hidden">
                    <div class="bg-white dark:bg-gray-800 rounded-[14px] p-6">
                        <h3 class="text-center font-bold text-slate-900 dark:text-white mb-1">Aksi & Persetujuan</h3>
                        <p class="text-center text-xs text-slate-500 dark:text-gray-400 mb-6">Atur status reservasi ini</p>

                        <div class="mb-6">
                            <select name="status" required class="w-full border-2 border-slate-200 dark:border-gray-600 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm font-bold text-center appearance-none bg-slate-50 dark:bg-gray-700/50 dark:text-white transition-all cursor-pointer">
                                <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>🟡 PENDING</option>
                                <option value="confirmed" {{ old('status', $item->status) == 'confirmed' ? 'selected' : '' }}>🔵 CONFIRMED</option>
                                <option value="completed" {{ old('status', $item->status) == 'completed' ? 'selected' : '' }}>🟢 COMPLETED</option>
                                <option value="cancelled" {{ old('status', $item->status) == 'cancelled' ? 'selected' : '' }}>🔴 CANCELLED</option>
                            </select>
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
@endsection
