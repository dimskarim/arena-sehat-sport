@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('admin.lapangans.index') }}" class="hover:text-red-700 transition-colors">Venues</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <span class="text-slate-900 font-semibold">Edit Venue</span>
            </div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900">Edit Venue Details</h1>
            <p class="text-slate-500 text-sm mt-1">Update court information, pricing, and operational status.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.lapangans.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Cancel
            </a>
            <button type="submit" form="lapanganForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <span class="material-symbols-outlined text-lg">save</span>
                Save Venue
            </button>
        </div>
    </div>

    {{-- Form --}}
    <form id="lapanganForm" action="{{ route('admin.lapangans.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column: General Info --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- General Information Card --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-700">info</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">General Information</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Nama Lapangan --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Venue Name <span class="text-red-600">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $item->name) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all"
                                placeholder="e.g. Grand Central Court A" />
                            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Venue Type <span class="text-red-600">*</span></label>
                            <select name="kategori_id" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_id', $item->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Price per Hour (Rp) <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-semibold">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga', $item->harga) }}" required min="0"
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all"
                                    placeholder="0" />
                            </div>
                            @error('harga') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Description</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all resize-none"
                                placeholder="Describe the court's features, dimensions, flooring type...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Amenities Placeholder --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-red-700">checklist</span>
                            <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Amenities & Features</h2>
                        </div>
                    </div>
                    <div class="p-6 flex flex-wrap gap-2">
                        @foreach(['Air Conditioning', 'Locker Rooms', 'Parking', 'Shower', 'Lighting', 'Scoreboard'] as $amenity)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-semibold rounded-full border border-slate-200 cursor-pointer hover:border-red-200 hover:bg-red-50 hover:text-red-700 transition-all select-none">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                            {{ $amenity }}
                        </span>
                        @endforeach
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-slate-400 text-xs font-semibold rounded-full border border-dashed border-slate-300 cursor-pointer hover:border-red-300 transition-all select-none">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Add New
                        </span>
                    </div>
                </div>
            </div>

            {{-- Right Column: Media & Status --}}
            <div class="space-y-6">

                {{-- Venue Gallery --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-700">photo_library</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Venue Gallery</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        {{-- Preview gambar lama --}}
                        @if($item->gambar)
                        <div class="h-36 w-full rounded-xl overflow-hidden border border-slate-100">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Current Image" class="w-full h-full object-cover"/>
                        </div>
                        @endif
                        {{-- Upload area --}}
                        <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-slate-200 rounded-xl cursor-pointer hover:border-red-300 hover:bg-red-50/30 transition-all group">
                            <span class="material-symbols-outlined text-3xl text-red-400 group-hover:scale-110 transition-transform">upload</span>
                            <p class="text-xs font-semibold text-slate-500 mt-1">Click or drag to upload</p>
                            <p class="text-[10px] text-slate-400">PNG, JPG up to 5MB</p>
                            <input type="file" name="gambar" class="hidden" accept="image/*"/>
                        </label>
                        @error('gambar') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Publishing Status --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-700">toggle_on</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Publishing Status</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ strtolower($item->status ?? '') === 'tersedia' ? 'bg-green-500' : 'bg-slate-300' }}"></span>
                                <span class="text-sm font-semibold {{ strtolower($item->status ?? '') === 'tersedia' ? 'text-green-700' : 'text-slate-500' }}">
                                    {{ strtolower($item->status ?? '') === 'tersedia' ? 'Active & Visible' : 'Inactive' }}
                                </span>
                            </div>
                            <button type="button" onclick="openDeleteModal()" class="text-red-600 text-xs font-bold hover:underline">Archive</button>
                        </div>
                        <select name="status" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer">
                            <option value="tersedia" {{ old('status', $item->status) == 'tersedia' ? 'selected' : '' }}>Tersedia (Active)</option>
                            <option value="tidak tersedia" {{ old('status', $item->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia (Inactive)</option>
                        </select>
                        <p class="text-xs text-slate-400 mt-3">Last updated: {{ $item->updated_at?->format('d M Y, H:i') ?? '-' }}</p>
                    </div>
                </div>

                {{-- Danger Zone --}}
                <div class="bg-white rounded-xl border border-red-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-red-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-700">warning</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-red-700">Danger Zone</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-4">Permanently delete this venue. This action cannot be undone and all related data will be removed.</p>
                        <button type="button" onclick="openDeleteModal()"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 border border-red-200 text-red-600 text-sm font-semibold rounded-lg hover:bg-red-50 transition-all">
                            <span class="material-symbols-outlined text-lg">delete_forever</span>
                            Delete This Venue
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0" id="deleteModalContent">
        <div class="flex items-center justify-center mb-5">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                <span class="material-symbols-outlined text-[#af101a] text-3xl">delete_forever</span>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-slate-900 mb-2">Delete This Venue?</h3>
        <p class="text-center text-sm text-slate-500 mb-6">
            Are you sure you want to permanently delete <strong>{{ $item->name }}</strong>? This action cannot be undone.
        </p>
        <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
            <button type="button" onclick="closeDeleteModal()" class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Cancel
            </button>
            <button type="button" id="confirmDeleteBtn" onclick="executeDelete()" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800">
                Yes, Delete
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
        void deleteModal.offsetWidth;
        deleteModal.classList.remove('opacity-0');
        deleteModalContent.classList.remove('scale-95', 'opacity-0');
        deleteModalContent.classList.add('scale-100', 'opacity-100');
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
        const originalBtnText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Processing...`;

        try {
            const response = await fetch("{{ route('admin.lapangans.destroy', $item->id) }}", {
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
                setTimeout(() => { window.location.href = "{{ route('admin.lapangans.index') }}"; }, 1000);
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