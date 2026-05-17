@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] mb-2">
                <a href="{{ route('admin.kategoris.index') }}" class="hover:text-[#af101a] transition-colors flex items-center gap-1">
                    <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kategori
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
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Batal
            </a>
            <button type="submit" form="kategoriCreateForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                </svg>
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
                    <svg class="text-[#af101a] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                    </svg>
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
                                <svg class="text-sm inline-block align-middle w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}
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
                                <svg class="text-[#8f6f6c] text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                </svg>
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
                    <svg class="text-[#af101a] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#1b1c1c]">Preview Kategori</h2>
                </div>
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-2xl bg-[#fdcbd0] flex items-center justify-center mb-4 border border-[#e4beba]">
                        <svg class="text-[#af101a] text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            style="font-variation-settings: 'FILL' 1;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <p class="font-bold text-[#1b1c1c] text-base" id="previewName">Nama Kategori</p>
                    <code class="text-xs font-mono text-[#af101a] mt-1" id="previewSlug">nama-kategori</code>
                    <span class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span>
                        Aktif
                    </span>
                </div>
            </div>

            {{-- Tips --}}
            <div class="bg-gradient-to-br from-red-50 to-[#fdcbd0]/30 rounded-xl border border-[#e4beba] p-5">
                <div class="flex items-start gap-3">
                    <svg class="text-[#af101a] mt-0.5 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
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