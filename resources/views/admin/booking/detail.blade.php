@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900 relative">
    
    <form action="{{ route('admin.bookings.update', $item->id) }}" method="POST" id="editBookingForm">
        @csrf
        @method('PUT')
        
        {{-- Header & Breadcrumb --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <nav class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                    <a href="{{ route('admin.bookings.index') }}" class="hover:text-[#af101a] transition-colors">Daftar Reservasi</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-[#af101a] font-medium">Reservasi #VR-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                </nav>
                <h1 class="text-3xl font-bold font-['Lexend'] tracking-tight">Detail Reservasi</h1>
            </div>
            <div class="flex items-center gap-3">
                @if($item->status == 'pending')
                    <span class="px-4 py-1.5 bg-amber-100 text-amber-700 text-xs font-bold rounded-full flex items-center gap-1.5 border border-amber-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        PENDING
                    </span>
                @elseif($item->status == 'confirmed')
                    <span class="px-4 py-1.5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full flex items-center gap-1.5 border border-blue-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        CONFIRMED
                    </span>
                @elseif($item->status == 'completed')
                    <span class="px-4 py-1.5 bg-green-100 text-green-700 text-xs font-bold rounded-full flex items-center gap-1.5 border border-green-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        COMPLETED
                    </span>
                @else
                    <span class="px-4 py-1.5 bg-slate-100 text-slate-600 text-xs font-bold rounded-full flex items-center gap-1.5 border border-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        CANCELLED
                    </span>
                @endif
                <span class="text-xs text-slate-400">Dibuat: {{ $item->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Venue & Schedule Card --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-lg font-bold font-['Lexend'] mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Informasi Lapangan & Jadwal
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 block">Pilih Lapangan</label>
                                <div class="relative">
                                    <select name="lapangan_id" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm appearance-none bg-slate-50 transition-all">
                                        <option value="">Pilih Lapangan</option>
                                        @foreach($lapangans as $lap)
                                            <option value="{{ $lap->id }}" {{ old('lapangan_id', $item->lapangan_id) == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                @error('lapangan_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 block">Tanggal Reservasi</label>
                                <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking', $item->tanggal_booking) }}" required class="w-full border border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm bg-slate-50 transition-all" />
                                @error('tanggal_booking') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 block">Waktu / Slot Reservasi</label>
                            
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
                                        $time = sprintf('%02d:00', $i); 
                                        $isChecked = in_array($time, $oldSlots);
                                    @endphp
                                    <label class="cursor-pointer group">
                                        <input type="checkbox" name="slot_waktu[]" value="{{ $time }}" class="peer sr-only" {{ $isChecked ? 'checked' : '' }} />
                                        <div class="p-3 text-xs font-semibold rounded-lg border border-slate-200 bg-white group-hover:border-[#af101a] group-hover:text-[#af101a] peer-checked:border-[#af101a] peer-checked:bg-[#af101a] peer-checked:text-white transition-all text-center">
                                            {{ $time }}
                                        </div>
                                    </label>
                                @endfor
                            </div>
                            
                            <div class="mt-5 flex gap-6 items-center text-xs text-slate-500">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full border border-slate-200 bg-white"></span> Tersedia
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-[#af101a]"></span> Terpilih
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Verification Details --}}
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-bold font-['Lexend'] flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Detail Pembayaran
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                        <div class="md:col-span-2">
                            {{-- Receipt Image Placeholder (If payment exists we can show it, else placeholder) --}}
                            <div class="aspect-[3/4] rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center text-slate-400 group relative overflow-hidden">
                                @if(optional($item->payment)->bukti_pembayaran)
                                    <img src="{{ asset('storage/' . $item->payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-12 h-12 mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs font-semibold">Belum Ada Bukti</span>
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-3 space-y-6">
                            <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-xs text-slate-500 font-bold uppercase mb-4 tracking-wider">Ringkasan Harga</p>
                                
                                <div>
                                    <label class="text-sm font-semibold text-slate-700 block mb-2">Ubah Total Harga (Rp)</label>
                                    <input type="number" name="total_harga" value="{{ old('total_harga', $item->total_harga) }}" required min="0" class="w-full border border-slate-200 rounded-lg py-2.5 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] font-bold text-lg text-[#af101a] transition-all bg-white" />
                                    @error('total_harga') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-slate-200">
                                    <div class="flex items-start gap-2 p-3 bg-blue-50 border border-blue-100 rounded-lg text-sm text-blue-700">
                                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-bold font-['Lexend'] mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#af101a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Pelanggan
                    </h3>
                    
                    <div class="mb-5">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 block">Akun Pengguna</label>
                        <div class="relative">
                            <select name="user_id" required class="w-full border border-slate-200 rounded-xl py-2.5 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm appearance-none bg-slate-50 font-semibold transition-all">
                                <option value="">Pilih User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('user_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-4 pt-4 border-t border-slate-100">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest block mb-1">Alamat Email</span>
                            <p class="text-slate-800 font-medium text-sm">{{ optional($item->user)->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest block mb-1">Nomor Telepon</span>
                            <p class="text-slate-800 font-medium text-sm">{{ optional($item->user)->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Action / Status Card --}}
                <div class="bg-gradient-to-br from-[#af101a] to-[#7f0d13] p-1 rounded-2xl shadow-xl shadow-red-900/20 overflow-hidden">
                    <div class="bg-white rounded-[14px] p-6">
                        <h3 class="text-center font-bold text-slate-900 mb-1">Aksi & Persetujuan</h3>
                        <p class="text-center text-xs text-slate-500 mb-6">Atur status reservasi ini</p>
                        
                        <div class="mb-6">
                            <select name="status" required class="w-full border-2 border-slate-200 rounded-xl py-3 px-4 focus:border-[#af101a] focus:ring-1 focus:ring-[#af101a] text-sm font-bold text-center appearance-none bg-slate-50 transition-all cursor-pointer">
                                <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>🟡 PENDING</option>
                                <option value="confirmed" {{ old('status', $item->status) == 'confirmed' ? 'selected' : '' }}>🔵 CONFIRMED</option>
                                <option value="completed" {{ old('status', $item->status) == 'completed' ? 'selected' : '' }}>🟢 COMPLETED</option>
                                <option value="cancelled" {{ old('status', $item->status) == 'cancelled' ? 'selected' : '' }}>🔴 CANCELLED</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs mt-1 block text-center">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-3">
                            <button type="submit" class="w-full py-3 bg-[#af101a] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 shadow-lg shadow-red-700/20 hover:bg-red-800 active:scale-95 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Perubahan
                            </button>
                            <button type="button" onclick="openDeleteModal()" class="w-full py-3 bg-white text-red-600 border-2 border-red-100 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-50 hover:border-red-200 active:scale-95 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus Reservasi
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0" id="deleteModalContent">
        <div class="flex items-center justify-center mb-5">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-50">
                <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-slate-900 mb-2 font-['Lexend']">Hapus Reservasi Ini?</h3>
        <p class="text-center text-sm text-slate-500 mb-6">
            Apakah Anda yakin ingin menghapus data reservasi ini? Tindakan ini tidak dapat dibatalkan.
        </p>
        
        <!-- Feedback Alert -->
        <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm font-medium"></div>

        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center w-full">
            <button type="button" onclick="closeDeleteModal()" class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-bold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none transition-colors">
                Batal
            </button>
            <button type="button" id="confirmDeleteBtn" onclick="executeDelete()" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-xl border border-transparent bg-red-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none transition-colors">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    const deleteModalContent = document.getElementById('deleteModalContent');
    const deleteFeedback = document.getElementById('deleteFeedback');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    
    function openDeleteModal() {
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
        void deleteModal.offsetWidth; // Trigger reflow
        deleteModal.classList.remove('opacity-0');
        deleteModalContent.classList.remove('scale-95', 'opacity-0');
        deleteModalContent.classList.add('scale-100', 'opacity-100');
        
        deleteFeedback.classList.add('hidden');
        deleteFeedback.className = 'hidden mb-4 rounded-lg p-4 text-sm font-medium';
    }

    function closeDeleteModal() {
        deleteModal.classList.add('opacity-0');
        deleteModalContent.classList.remove('scale-100', 'opacity-100');
        deleteModalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        }, 300);
    }

    async function executeDelete() {
        const originalBtnText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memproses...
        `;
        
        try {
            const response = await fetch("{{ route('admin.bookings.destroy', $item->id) }}", {
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
                deleteFeedback.innerHTML = '<p class="flex items-center gap-2"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg> Berhasil dihapus. Mengalihkan...</p>';
                
                setTimeout(() => {
                    window.location.href = "{{ route('admin.bookings.index') }}";
                }, 1000);
            } else {
                throw new Error(data.message || 'Terjadi kesalahan saat menghapus data.');
            }
        } catch (error) {
            deleteFeedback.classList.remove('hidden');
            deleteFeedback.classList.add('bg-red-50', 'text-red-800', 'border', 'border-red-200');
            deleteFeedback.innerHTML = `<p class="flex items-center gap-2"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg> ${error.message}</p>`;
            
            confirmDeleteBtn.disabled = false;
            confirmDeleteBtn.innerHTML = originalBtnText;
        }
    }
</script>
@endsection