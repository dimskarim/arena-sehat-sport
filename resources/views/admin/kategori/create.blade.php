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
                <span class="text-[#1b1c1c] font-semibold">Tambah Kategori</span>
            </div>
            <h1 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] tracking-tight">Tambah Kategori Baru</h1>
            <p class="text-[#5b403d] mt-1 text-sm">Tambahkan kategori venue / olahraga baru ke dalam sistem.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.kategoris.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#e4beba] text-[#5b403d] text-sm font-semibold rounded-xl hover:bg-[#f6f3f2] transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Cancel
            </a>
            <button type="submit" form="kategoriCreateForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <span class="material-symbols-outlined text-lg">save</span>
                Simpan Kategori
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
                    <span class="material-symbols-outlined text-[#af101a]">category</span>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#1b1c1c]">Informasi Kategori</h2>
                </div>

                <form id="kategoriCreateForm" action="{{ route('admin.kategoris.store') }}" method="POST">
                    @csrf
                    <div class="p-6 space-y-5">

                        {{-- Nama Kategori --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                Nama Kategori <span class="text-[#ba1a1a]">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
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
                                placeholder="Deskripsi singkat tentang kategori ini...">{{ old('description') }}</textarea>
                        </div>

                        {{-- Preview Slug --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Preview Slug</label>
                            <div class="flex items-center gap-2 px-4 py-3 bg-[#f0eded] border border-[#e4beba] rounded-lg">
                                <span class="material-symbols-outlined text-[#8f6f6c] text-sm">link</span>
                                <code id="slugPreview" class="text-sm font-mono text-[#af101a]">nama-kategori</code>
                            </div>
                            <p class="text-[10px] text-[#8f6f6c] mt-1">Slug otomatis dibuat dari nama kategori.</p>
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
                    <p class="font-bold text-[#1b1c1c] text-base" id="previewName">Nama Kategori</p>
                    <code class="text-xs font-mono text-[#af101a] mt-1" id="previewSlug">nama-kategori</code>
                    <span class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span>
                        Active
                    </span>
                </div>
            </div>

            {{-- Tips --}}
            <div class="bg-gradient-to-br from-red-50 to-[#fdcbd0]/30 rounded-xl border border-[#e4beba] p-5">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[#af101a] mt-0.5">tips_and_updates</span>
                    <div>
                        <h4 class="text-sm font-bold text-[#ba1a1a] mb-2">Tips</h4>
                        <ul class="text-xs text-[#5b403d] space-y-1.5 list-disc list-inside">
                            <li>Gunakan nama yang mudah dipahami pengguna</li>
                            <li>Kategori bisa digunakan di banyak venue</li>
                            <li>Slug otomatis dibuat dari nama</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const nameInput = document.querySelector('input[name="name"]');
    const slugPreview = document.getElementById('slugPreview');
    const previewName = document.getElementById('previewName');
    const previewSlug = document.getElementById('previewSlug');

    function toSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    nameInput.addEventListener('input', function() {
        const slug = toSlug(this.value) || 'nama-kategori';
        slugPreview.textContent = slug;
        previewName.textContent = this.value || 'Nama Kategori';
        previewSlug.textContent = slug;
    });
</script>
@endsection
