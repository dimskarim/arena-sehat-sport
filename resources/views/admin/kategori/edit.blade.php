@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] mb-2">
                <a href="{{ route('admin.kategoris.index') }}" class="hover:text-[#af101a] transition-colors flex items-center gap-1">
                    <svg class="text-base inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                    Kategori
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
                <svg class="text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                Hapus
            </button>
            <a href="{{ route('admin.kategoris.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#e4beba] text-[#5b403d] text-sm font-semibold rounded-xl hover:bg-[#f6f3f2] transition-colors shadow-sm">
                <svg class="text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Batal
            </a>
            <button type="submit" form="kategoriEditForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <svg class="text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12"/></svg>
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
                    <svg class="text-[#af101a] inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
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
                                    <svg class="text-sm inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>{{ $message }}
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
                                <svg class="text-[#8f6f6c] text-sm inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
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
                    <svg class="text-[#af101a] inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#1b1c1c]">Preview Kategori</h2>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-2xl bg-[#fdcbd0] flex items-center justify-center mb-4 border border-[#e4beba]">
                        <svg class="text-[#af101a] text-3xl inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                            style="font-variation-settings: 'FILL' 1;"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z"/></svg>
                    </div>
                    <p class="font-bold text-[#1b1c1c] text-base" id="previewName">{{ $item->name }}</p>
                    <code class="text-xs font-mono text-[#af101a] mt-1" id="previewSlug">{{ \Str::slug($item->name) }}</code>
                    <div class="mt-3 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span>
                            Aktif
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
                    <svg class="text-[#ba1a1a] inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#ba1a1a]">Zona Berbahaya</h2>
                </div>
                <div class="p-5">
                    <p class="text-xs text-[#5b403d] mb-4">Menghapus kategori ini akan mempengaruhi semua venue yang terhubung.</p>
                    <button type="button" onclick="openDeleteModal()"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#ffdad6]/50 border border-[#ffdad6] text-[#ba1a1a] text-sm font-bold rounded-lg hover:bg-[#ffdad6] transition-colors">
                        <svg class="text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
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
                <svg class="text-[#af101a] text-3xl inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
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
