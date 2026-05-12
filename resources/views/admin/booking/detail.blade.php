@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white" style="font-family: 'Inter', sans-serif;">
        Edit History Booking
    </h2>

    <nav>
        <a href="{{ route('admin.bookings.index') }}" class="text-gray-500 hover:text-[#B22222] transition-colors font-medium">Kembali</a>
    </nav>
</div>

<div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-strokedark dark:bg-boxdark">
    <form action="{{ route('admin.bookings.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">User <span class="text-[#B22222]">*</span></label>
                    <select name="user_id" required class="w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 outline-none transition focus:border-[#B22222] focus:bg-white dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Pilih User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id') <span class="text-[#B22222] text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Lapangan <span class="text-[#B22222]">*</span></label>
                    <select name="lapangan_id" required class="w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 outline-none transition focus:border-[#B22222] focus:bg-white dark:border-form-strokedark dark:bg-form-input">
                        <option value="">Pilih Lapangan</option>
                        @foreach($lapangans as $lap)
                            <option value="{{ $lap->id }}" {{ old('lapangan_id', $item->lapangan_id) == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                        @endforeach
                    </select>
                    @error('lapangan_id') <span class="text-[#B22222] text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal Booking <span class="text-[#B22222]">*</span></label>
                    <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking', $item->tanggal_booking) }}" required class="w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 outline-none transition focus:border-[#B22222] focus:bg-white dark:border-form-strokedark dark:bg-form-input" />
                    @error('tanggal_booking') <span class="text-[#B22222] text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Total Harga (Rp) <span class="text-[#B22222]">*</span></label>
                    <input type="number" name="total_harga" value="{{ old('total_harga', $item->total_harga) }}" required min="0" class="w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 outline-none transition focus:border-[#B22222] focus:bg-white dark:border-form-strokedark dark:bg-form-input" />
                    @error('total_harga') <span class="text-[#B22222] text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4 sm:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-300">Status <span class="text-[#B22222]">*</span></label>
                    <select name="status" required class="w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-700 outline-none transition focus:border-[#B22222] focus:bg-white dark:border-form-strokedark dark:bg-form-input">
                        <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status', $item->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ old('status', $item->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $item->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status') <span class="text-[#B22222] text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-gray-100 pt-6">
                <button type="button" onclick="openDeleteModal()" class="flex justify-center items-center gap-2 rounded-lg border border-gray-300 bg-white py-2.5 px-6 font-semibold text-gray-700 shadow-sm transition-all hover:bg-gray-50 hover:text-red-600 focus:ring-4 focus:ring-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                    Hapus Booking
                </button>
                <button type="submit" class="flex justify-center items-center gap-2 rounded-lg bg-[#B22222] py-2.5 px-8 font-semibold text-white shadow-sm transition-all hover:bg-red-800 hover:shadow-md focus:ring-4 focus:ring-red-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0" id="deleteModalContent">
        <div class="flex items-center justify-center mb-5">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                <svg class="h-8 w-8 text-[#B22222]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-gray-900 mb-2">Hapus Booking Ini?</h3>
        <p class="text-center text-sm text-gray-500 mb-6">
            Apakah Anda yakin ingin menghapus data booking ini? Tindakan ini tidak dapat dibatalkan dan semua riwayat terkait akan dihapus secara permanen.
        </p>
        
        <!-- Feedback Alert -->
        <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>

        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center w-full">
            <button type="button" onclick="closeDeleteModal()" class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#B22222] focus:ring-offset-2">
                Batal
            </button>
            <button type="button" id="confirmDeleteBtn" onclick="executeDelete()" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg border border-transparent bg-[#B22222] px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
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
        // Trigger reflow
        void deleteModal.offsetWidth;
        deleteModal.classList.remove('opacity-0');
        deleteModalContent.classList.remove('scale-95', 'opacity-0');
        deleteModalContent.classList.add('scale-100', 'opacity-100');
        
        // Reset feedback
        deleteFeedback.classList.add('hidden');
        deleteFeedback.className = 'hidden mb-4 rounded-lg p-4 text-sm';
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
        // Show loading state
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
                // Show success message
                deleteFeedback.classList.remove('hidden');
                deleteFeedback.classList.add('bg-green-50', 'text-green-800', 'border', 'border-green-200');
                deleteFeedback.innerHTML = '<p class="flex items-center gap-2"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg> Berhasil dihapus. Mengalihkan...</p>';
                
                // Redirect after brief delay
                setTimeout(() => {
                    window.location.href = "{{ route('admin.bookings.index') }}";
                }, 1000);
            } else {
                throw new Error(data.message || 'Terjadi kesalahan saat menghapus data.');
            }
        } catch (error) {
            // Show error message
            deleteFeedback.classList.remove('hidden');
            deleteFeedback.classList.add('bg-red-50', 'text-red-800', 'border', 'border-red-200');
            deleteFeedback.innerHTML = `<p class="flex items-center gap-2"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg> ${error.message}</p>`;
            
            // Restore button
            confirmDeleteBtn.disabled = false;
            confirmDeleteBtn.innerHTML = originalBtnText;
        }
    }
</script>
@endsection