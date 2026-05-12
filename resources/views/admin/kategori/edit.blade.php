@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] mb-2">
                <a href="{{ route('admin.kategoris.index') }}" class="hover:text-[#af101a] transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Categories
                </a>
                <span class="text-[#e4beba]">/</span>
                <span class="text-[#1b1c1c] font-semibold">Edit Kategori</span>
            </div>
            <h1 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] tracking-tight">Edit Kategori</h1>
            <p class="text-[#5b403d] mt-1 text-sm">Ubah informasi kategori <strong>{{ $item->name }}</strong>.</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" onclick="openDeleteModal()"
                class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#ffdad6] text-[#ba1a1a] text-sm font-semibold rounded-xl hover:bg-[#ffdad6]/30 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">delete</span>
                Hapus
            </button>
            <a href="{{ route('admin.kategoris.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#e4beba] text-[#5b403d] text-sm font-semibold rounded-xl hover:bg-[#f6f3f2] transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Cancel
            </a>
            <button type="submit" form="kategoriEditForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <span class="material-symbols-outlined text-lg">save</span>
                Simpan Perubahan
            </button>
        </div>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-6 py-4 shadow-sm rounded-r-xl">
        <div>
            <p class="text-red-800 font-bold text-sm mb-1">Mohon perbaiki kesalahan berikut:</p>
            <ul class="list-disc list-inside text-red-700 text-xs space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Card (2/3 width) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-[#e4beba]/50 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#e4beba]/50 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#af101a]">edit</span>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#1b1c1c]">Informasi Kategori</h2>
                </div>

                <form id="kategoriEditForm" action="{{ route('admin.kategoris.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-5">

                        {{-- Nama Kategori --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                Nama Kategori <span class="text-[#ba1a1a]">*</span>
                            </label>
                            <input type="text" id="nameInput" name="name" value="{{ old('name', $item->name) }}" required
                                class="w-full px-4 py-3 bg-[#f6f3f2] border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-[#e4beba]' }} rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                placeholder="Contoh: Lapangan Futsal, Badminton, Tennis..." />
                            @error('name')
                                <p class="text-[#ba1a1a] text-xs mt-1.5 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">error</span>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Deskripsi (opsional) --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                Deskripsi
                                <span class="text-[10px] normal-case font-normal text-[#8f6f6c] ml-1">(opsional)</span>
                            </label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all resize-none"
                                placeholder="Deskripsi singkat tentang kategori ini...">{{ old('description', $item->description ?? '') }}</textarea>
                        </div>

                        {{-- Preview Slug --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Preview Slug</label>
                            <div class="flex items-center gap-2 px-4 py-3 bg-[#f0eded] border border-[#e4beba] rounded-lg">
                                <span class="material-symbols-outlined text-[#8f6f6c] text-sm">link</span>
                                <code id="slugPreview" class="text-sm font-mono text-[#af101a]">{{ \Str::slug($item->name) }}</code>
                            </div>
                            <p class="text-[10px] text-[#8f6f6c] mt-1">Slug otomatis dibuat dari nama kategori.</p>
                        </div>

                        {{-- Meta Info --}}
                        <div class="pt-2 border-t border-[#e4beba]/50 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-[#5b403d] font-medium">Dibuat pada</p>
                                <p class="text-sm font-semibold text-[#1b1c1c]">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-[#5b403d] font-medium">Terakhir diubah</p>
                                <p class="text-sm font-semibold text-[#1b1c1c]">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar Info (1/3 width) --}}
        <div class="space-y-6">

            {{-- Preview Card --}}
            <div class="bg-white rounded-xl border border-[#e4beba]/50 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#e4beba]/50 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#af101a]">preview</span>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#1b1c1c]">Preview Kategori</h2>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-2xl bg-[#fdcbd0] flex items-center justify-center mb-4 border border-[#e4beba]">
                        <span class="material-symbols-outlined text-[#af101a] text-3xl"
                            style="font-variation-settings: 'FILL' 1;">category</span>
                    </div>
                    <p class="font-bold text-[#1b1c1c] text-base" id="previewName">{{ $item->name }}</p>
                    <code class="text-xs font-mono text-[#af101a] mt-1" id="previewSlug">{{ \Str::slug($item->name) }}</code>
                    <div class="mt-3 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span>
                            Active
                        </span>
                    </div>
                    <div class="mt-4 pt-4 border-t border-[#e4beba]/50 w-full text-center">
                        <p class="text-xs text-[#5b403d] font-medium">Total Venue</p>
                        <p class="text-xl font-black font-['Lexend'] text-[#1b1c1c]">
                            {{ $item->lapangans_count ?? $item->lapangans()->count() }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div class="bg-white rounded-xl border border-[#ffdad6] shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#ffdad6] flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#ba1a1a]">warning</span>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#ba1a1a]">Danger Zone</h2>
                </div>
                <div class="p-5">
                    <p class="text-xs text-[#5b403d] mb-4">Menghapus kategori ini akan mempengaruhi semua venue yang terhubung.</p>
                    <button type="button" onclick="openDeleteModal()"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#ffdad6]/50 border border-[#ffdad6] text-[#ba1a1a] text-sm font-bold rounded-lg hover:bg-[#ffdad6] transition-colors">
                        <span class="material-symbols-outlined text-lg">delete_forever</span>
                        Hapus Kategori Ini
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div id="deleteModalContent" class="w-full max-w-md bg-white rounded-2xl p-6 shadow-xl scale-95 opacity-0 transition-all">
        <div class="flex items-center justify-center mb-4">
            <div class="w-14 h-14 bg-[#ffdad6] rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-[#af101a] text-3xl">delete_forever</span>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-[#1b1c1c] mb-2">Hapus Kategori Ini?</h3>
        <p class="text-center text-sm text-[#5b403d] mb-6">
            Apakah Anda yakin ingin menghapus <strong>{{ $item->name }}</strong>?
            Semua venue terkait perlu dipindah ke kategori lain terlebih dahulu.
        </p>
        <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
            <button type="button" onclick="closeDeleteModal()"
                class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-[#e4beba] bg-white px-5 py-2.5 text-sm font-semibold text-[#5b403d] hover:bg-[#f6f3f2]">
                Batal
            </button>
            <button type="button" id="confirmDeleteBtn" onclick="executeDelete()"
                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800">
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

    // Live preview
    const nameInput = document.getElementById('nameInput');
    const slugPreview = document.getElementById('slugPreview');
    const previewName = document.getElementById('previewName');
    const previewSlug = document.getElementById('previewSlug');

    function toSlug(text) {
        return text.toLowerCase().trim().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    }

    nameInput.addEventListener('input', function () {
        const slug = toSlug(this.value) || 'nama-kategori';
        slugPreview.textContent = slug;
        previewName.textContent = this.value || 'Nama Kategori';
        previewSlug.textContent = slug;
    });

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
        const originalText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memproses...`;
        try {
            const response = await fetch("{{ route('admin.kategoris.destroy', $item->id) }}", {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                deleteFeedback.classList.remove('hidden');
                deleteFeedback.classList.add('bg-green-50', 'text-green-800', 'border', 'border-green-200');
                deleteFeedback.innerHTML = '<p>✅ Berhasil dihapus. Mengalihkan...</p>';
                setTimeout(() => { window.location.href = "{{ route('admin.kategoris.index') }}"; }, 1000);
            } else {
                const data = await response.json().catch(() => ({}));
                throw new Error(data.message || 'Terjadi kesalahan.');
            }
        } catch (error) {
            deleteFeedback.classList.remove('hidden');
            deleteFeedback.classList.add('bg-red-50', 'text-red-800', 'border', 'border-red-200');
            deleteFeedback.innerHTML = `<p>❌ ${error.message}</p>`;
            confirmDeleteBtn.disabled = false;
            confirmDeleteBtn.innerHTML = originalText;
        }
    }
</script>
@endsection
