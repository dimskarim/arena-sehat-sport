@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] tracking-tight">Daftar Kategori Olahraga</h2>
            <p class="text-[#5b403d] mt-1">Kelola kategori fasilitas olahraga yang tersedia di Arena Sehat.</p>
        </div>
        <a href="{{ route('admin.kategoris.create') }}"
            class="inline-flex items-center gap-2 px-6 py-3 bg-[#af101a] text-white rounded-xl font-bold shadow-lg shadow-red-900/20 hover:opacity-90 active:scale-95 transition-all">
            <span class="material-symbols-outlined">add_circle</span>
            Tambah Kategori Baru
        </a>
    </div>

    {{-- Success / Error Alerts --}}
    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-red-800 font-semibold text-sm">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Bento Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#e4beba]/50 flex items-center gap-4">
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[#af101a]">category</span>
            </div>
            <div>
                <p class="text-xs text-[#5b403d] font-bold uppercase tracking-wider">Total Kategori</p>
                <p class="text-2xl font-black font-['Lexend']">{{ $items->total() ?? count($items) }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#e4beba]/50 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-blue-600">stadium</span>
            </div>
            <div>
                <p class="text-xs text-[#5b403d] font-bold uppercase tracking-wider">Total Venue</p>
                <p class="text-2xl font-black font-['Lexend']">
                    {{ $items->sum(fn($i) => $i->lapangans_count ?? $i->lapangans()->count()) }}
                </p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#e4beba]/50 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
            </div>
            <div>
                <p class="text-xs text-[#5b403d] font-bold uppercase tracking-wider">Kategori Aktif</p>
                <p class="text-2xl font-black font-['Lexend'] text-green-600">
                    {{ $items instanceof \Illuminate\Pagination\LengthAwarePaginator ? $items->getCollection()->count() : count($items) }}
                </p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#e4beba]/50 flex items-center gap-4">
            <div class="w-12 h-12 bg-[#ffdad6] rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[#ba1a1a]">sports</span>
            </div>
            <div>
                <p class="text-xs text-[#5b403d] font-bold uppercase tracking-wider">Jenis Olahraga</p>
                <p class="text-2xl font-black font-['Lexend'] text-[#af101a]">
                    {{ $items->count() }}
                </p>
            </div>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="bg-white rounded-2xl shadow-sm border border-[#e4beba]/30 overflow-hidden">

        {{-- Toolbar --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-6 py-4 border-b border-[#e4beba]/40">
            <div class="relative w-full md:w-80">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg">search</span>
                <input type="text" placeholder="Cari kategori olahraga..."
                    class="w-full pl-10 pr-4 py-2.5 bg-[#f6f3f2] border border-[#e4beba] rounded-xl text-sm text-[#1b1c1c] placeholder-[#8f6f6c] focus:outline-none focus:ring-2 focus:ring-[#af101a]/20 focus:border-[#af101a]/50 transition-all" />
            </div>
            <p class="text-sm text-[#5b403d] shrink-0">
                Total <span class="font-bold text-[#1b1c1c]">{{ $items->total() ?? count($items) }}</span> kategori
            </p>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0eded] border-b border-[#e4beba]/50 text-[#5b403d]">
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Ikon</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Nama Kategori</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Slug</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Jumlah Venue</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba]/30">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] transition-colors group">

                        {{-- Ikon / Thumbnail --}}
                        <td class="px-6 py-4">
                            @if($item->icon ?? $item->gambar ?? null)
                                <div class="w-12 h-12 rounded-xl bg-[#f0eded] overflow-hidden border border-[#e4beba]/50">
                                    <img src="{{ asset('storage/' . ($item->icon ?? $item->gambar)) }}"
                                        alt="{{ $item->name }}" class="w-full h-full object-cover"/>
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-xl bg-[#fdcbd0] flex items-center justify-center border border-[#e4beba]/50">
                                    <span class="material-symbols-outlined text-[#af101a] text-xl"
                                        style="font-variation-settings: 'FILL' 1;">category</span>
                                </div>
                            @endif
                        </td>

                        {{-- Nama --}}
                        <td class="px-6 py-4">
                            <span class="font-bold text-[#1b1c1c] block">{{ $item->name }}</span>
                            <span class="text-xs text-[#5b403d]">ID #{{ $item->id }}</span>
                        </td>

                        {{-- Slug --}}
                        <td class="px-6 py-4">
                            <code class="font-mono text-sm text-[#af101a] bg-red-50 px-2 py-0.5 rounded-md">
                                {{ \Str::slug($item->name) }}
                            </code>
                        </td>

                        {{-- Jumlah Venue --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-[#e5e2e1] text-[#1b1c1c] text-sm font-bold">
                                    {{ $item->lapangans_count ?? $item->lapangans()->count() }}
                                </span>
                                <span class="text-xs text-[#5b403d]">Unit</span>
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600 animate-pulse"></span>
                                Active
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.kategoris.edit', $item->id) }}"
                                    class="p-2 hover:bg-[#fdcbd0]/50 text-[#7a5459] rounded-lg transition-all"
                                    title="Edit Kategori">
                                    <span class="material-symbols-outlined text-xl">edit</span>
                                </a>
                                <form action="{{ route('admin.kategoris.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Hapus kategori {{ $item->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 hover:bg-[#ffdad6]/50 text-[#ba1a1a] rounded-lg transition-all"
                                        title="Hapus Kategori">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-[#5b403d]">
                            <span class="material-symbols-outlined text-5xl block mb-3 text-[#e4beba]">category</span>
                            <p class="font-medium text-base mb-1">Belum ada data kategori.</p>
                            <a href="{{ route('admin.kategoris.create') }}" class="text-sm text-[#af101a] font-bold hover:underline">
                                + Tambah kategori pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="px-6 py-4 bg-[#f6f3f2] border-t border-[#e4beba]/30 flex flex-col sm:flex-row items-center justify-between gap-3">
            @if(method_exists($items, 'firstItem') && $items->hasPages())
                <p class="text-sm text-[#5b403d]">
                    Menampilkan <span class="font-bold text-[#1b1c1c]">{{ $items->firstItem() }}-{{ $items->lastItem() }}</span>
                    dari {{ number_format($items->total()) }} kategori
                </p>
                {{ $items->links() }}
            @else
                <p class="text-sm text-[#5b403d]">
                    Menampilkan <span class="font-bold text-[#1b1c1c]">{{ $items->count() }}</span> kategori
                </p>
            @endif
        </div>
    </div>

    {{-- Tips & Activity Row --}}
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-[#af101a]/5 rounded-2xl p-6 border border-[#af101a]/10 relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="text-[#af101a] font-bold text-lg mb-3">Saran Pengelolaan</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm text-[#5b403d]">
                        <span class="material-symbols-outlined text-[#af101a] text-lg shrink-0">info</span>
                        Gunakan nama kategori yang jelas dan mudah dipahami oleh pengguna saat melakukan booking.
                    </li>
                    <li class="flex gap-3 text-sm text-[#5b403d]">
                        <span class="material-symbols-outlined text-[#af101a] text-lg shrink-0">image</span>
                        Pastikan setiap kategori memiliki deskripsi singkat agar memudahkan pencarian venue.
                    </li>
                </ul>
            </div>
            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-8xl text-[#af101a]/5 select-none"
                style="font-variation-settings: 'FILL' 1;">lightbulb</span>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-[#e4beba]/50 shadow-sm">
            <h4 class="font-bold text-lg mb-4 flex items-center gap-2 font-['Lexend'] text-[#1b1c1c]">
                <span class="material-symbols-outlined text-[#7a5459]">history</span>
                Aktivitas Terbaru
            </h4>
            <div class="space-y-4">
                <div class="flex gap-3">
                    <div class="w-2 h-2 mt-1.5 rounded-full bg-[#af101a] shrink-0"></div>
                    <p class="text-sm text-[#5b403d]">Sistem menampilkan <span class="font-bold text-[#1b1c1c]">{{ $items->count() }}</span> kategori aktif saat ini.</p>
                </div>
                <div class="flex gap-3">
                    <div class="w-2 h-2 mt-1.5 rounded-full bg-green-500 shrink-0"></div>
                    <p class="text-sm text-[#5b403d]">Semua kategori tersedia untuk ditambahkan venue baru.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection