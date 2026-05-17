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
            <svg class=" inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
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
                <svg class="text-[#af101a] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-[#5b403d] font-bold uppercase tracking-wider">Total Kategori</p>
                <p class="text-2xl font-black font-['Lexend']">{{ $items->total() ?? count($items) }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#e4beba]/50 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                <svg class="text-blue-600 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                </svg>
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
                <svg class="text-green-600 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
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
                <svg class="text-[#ba1a1a] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                </svg>
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
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
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
                                <img src="https://placehold.co/100x100/f3f4f6/a1a1aa?text=Image"
                                    alt="{{ $item->name }}" class="w-full h-full object-cover" />
                            </div>
                            @else
                            <div class="w-12 h-12 rounded-xl bg-[#fdcbd0] flex items-center justify-center border border-[#e4beba]/50">
                                <svg class="text-[#af101a] text-xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    style="font-variation-settings: 'FILL' 1;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                                </svg>
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
                                Aktif
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.kategoris.edit', $item->id) }}"
                                    class="p-2 hover:bg-[#fdcbd0]/50 text-[#7a5459] rounded-lg transition-all"
                                    title="Edit Kategori">
                                    <svg class="text-xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.kategoris.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Hapus kategori {{ $item->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 hover:bg-[#ffdad6]/50 text-[#ba1a1a] rounded-lg transition-all"
                                        title="Hapus Kategori">
                                        <svg class="text-xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-[#5b403d]">
                            <svg class="text-5xl block mb-3 text-[#e4beba] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                            </svg>
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
                        <svg class="text-[#af101a] text-lg shrink-0 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        Gunakan nama kategori yang jelas dan mudah dipahami oleh pengguna saat melakukan booking.
                    </li>
                    <li class="flex gap-3 text-sm text-[#5b403d]">
                        <svg class="text-[#af101a] text-lg shrink-0 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        Pastikan setiap kategori memiliki deskripsi singkat agar memudahkan pencarian venue.
                    </li>
                </ul>
            </div>
            <svg class="absolute -right-4 -bottom-4 text-8xl text-[#af101a]/5 select-none inline-block align-middle w-50 h-50" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                style="font-variation-settings: 'FILL' 1;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
            </svg>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-[#e4beba]/50 shadow-sm">
            <h4 class="font-bold text-lg mb-4 flex items-center gap-2 font-['Lexend'] text-[#1b1c1c]">
                <svg class="text-[#7a5459] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
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