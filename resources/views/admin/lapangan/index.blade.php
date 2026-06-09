@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-2 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white mb-2">Daftar Lapangan</h1>
            <p class="text-slate-500 dark:text-gray-400 text-[16px]">Kelola ketersediaan, harga, dan status operasional semua lapangan di arena Anda.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 text-[14px] font-semibold rounded-xl hover:bg-slate-50 shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Ekspor PDF
            </button>
            <a href="{{ route('admin.lapangans.create') }}" class="flex items-center gap-2 px-6 py-3 bg-[#af101a] text-white text-[14px] font-semibold rounded-xl hover:opacity-90 shadow-lg shadow-red-700/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Lapangan
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Bento Dashboard Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col gap-2 dark:bg-gray-800 dark:border-gray-700">
            <span class="text-slate-400 dark:text-gray-500 text-xs font-bold uppercase tracking-widest">Total Lapangan</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 dark:text-white">{{ $items->total() ?? count($items) }}</span>
                <span class="text-green-600 dark:text-green-400 text-xs font-bold">data aktif</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col gap-2 dark:bg-gray-800 dark:border-gray-700">
            <span class="text-slate-400 dark:text-gray-500 text-xs font-bold uppercase tracking-widest">Rata-rata Hunian</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 dark:text-white">82%</span>
                <span class="text-red-600 dark:text-red-400 text-xs font-bold">-4% hari ini</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col gap-2 dark:bg-gray-800 dark:border-gray-700">
            <span class="text-slate-400 dark:text-gray-500 text-xs font-bold uppercase tracking-widest">Aktif Saat Ini</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900 dark:text-white">{{ $items->where('status', 'tersedia')->count() }}</span>
                <span class="text-slate-500 dark:text-gray-400 text-xs">lapangan beroperasi</span>
            </div>
        </div>
        <div class="bg-red-50 p-6 rounded-xl border border-red-100 shadow-sm flex flex-col gap-2 dark:bg-red-900/20 dark:border-red-900/50">
            <span class="text-red-700 dark:text-red-400 text-xs font-bold uppercase tracking-widest">Proyeksi Pendapatan</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-red-700 dark:text-red-400">+12%</span>
                <span class="text-red-600 dark:text-red-500 text-xs font-bold">bulan ini</span>
            </div>
        </div>
    </div>

    {{-- Search Bar --}}
    <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-wrap items-center justify-between gap-4 mb-6 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center gap-4 flex-1">
            <div class="relative w-full md:w-80">
                <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input id="searchInput" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-red-100 focus:border-red-500 text-sm outline-none dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" placeholder="Cari nama lapangan..." type="text" />
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden mb-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 dark:bg-gray-900/50 dark:border-gray-700">
                        <th class="px-6 py-4 text-xs font-black text-slate-500 dark:text-gray-400 uppercase tracking-wider">Nama Lapangan</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 dark:text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 dark:text-gray-400 uppercase tracking-wider text-center">Harga per Jam</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 dark:text-gray-400 uppercase tracking-wider">Status Operasional</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 dark:text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-gray-700">
                    @forelse($items as $item)
                    <tr class="hover:bg-slate-50/50 group dark:hover:bg-gray-700/20">
                        {{-- Venue Name --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-16 rounded-lg bg-slate-100 overflow-hidden shrink-0 dark:bg-gray-700">
                                    @php
                                    $firstImage = $item->gambarLapangans->first();
                                    $imgUrl = null;
                                    if($firstImage) {
                                    $imgUrl = str_starts_with($firstImage->gambar_file, 'http') ? $firstImage->gambar_file : asset($firstImage->gambar_file);
                                    }
                                    @endphp
                                    @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $item->name }}" class="w-full h-full object-cover" />
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400 dark:text-gray-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $item->name ?? '-' }}</p>
                                    <p class="text-xs text-slate-400 dark:text-gray-400">ID: LPN-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Type / Kategori --}}
                        <td class="px-6 py-4">
                            @php
                            $kategoriColors = [
                            'futsal' => 'bg-blue-50 text-blue-700 bg-blue-500',
                            'badminton' => 'bg-orange-50 text-orange-700 bg-orange-500',
                            'tennis' => 'bg-emerald-50 text-emerald-700 bg-emerald-500',
                            'basketball' => 'bg-purple-50 text-purple-700 bg-purple-500',
                            'voli' => 'bg-yellow-50 text-yellow-700 bg-yellow-500',
                            ];
                            $namaKat = strtolower($item->kategori->name ?? '');
                            $matched = null;
                            foreach ($kategoriColors as $key => $classes) {
                            if (str_contains($namaKat, $key)) {
                            $matched = $classes;
                            break;
                            }
                            }
                            $colorParts = $matched ? explode(' ', $matched) : ['bg-slate-50', 'text-slate-700', 'bg-slate-500'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $colorParts[0] }} {{ $colorParts[1] }} rounded-full text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full {{ $colorParts[2] }}"></span>
                                {{ $item->kategori->name ?? '-' }}
                            </span>
                        </td>

                        {{-- Hourly Rate --}}
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-bold text-slate-900 dark:text-white">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</span>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @if(strtolower($item->status ?? '') === 'tersedia')
                            <span class="px-3 py-1 bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800 rounded-lg text-xs font-bold border border-green-100">Aktif</span>
                            @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-500 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 rounded-lg text-xs font-bold border border-slate-200">Tidak Aktif</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.lapangans.edit', $item->id) }}" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ route('admin.lapangans.destroy', $item->id) }}', '{{ addslashes($item->name) }}')"
                                    class="p-2 text-slate-400 hover:text-red-700 hover:bg-red-50 rounded-lg" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 dark:text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-2 text-slate-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <p class="font-medium">Belum ada data lapangan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 dark:bg-gray-800/50 dark:border-gray-700">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs font-medium text-slate-500 dark:text-gray-400">Menampilkan {{ $items->firstItem() ?? 0 }} hingga {{ $items->lastItem() ?? 0 }} dari {{ $items->total() ?? 0 }} lapangan</p>
            @endif
            @if(method_exists($items, 'links'))
            {{ $items->links('components.pagination') }}
            @endif
        </div>
    </div>

    {{-- Promo / Help Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-8 rounded-2xl bg-gradient-to-br from-red-600 to-red-800 text-white relative overflow-hidden">
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <h3 class="font-['Lexend'] text-xl font-semibold mb-2">Analisis Lanjutan</h3>
                    <p class="text-red-100 text-sm">Dapatkan wawasan mendalam mengenai performa lapangan dan jam sibuk untuk meningkatkan strategi penjadwalan.</p>
                </div>
                <button class="mt-8 px-6 py-2.5 bg-white text-red-700 font-bold rounded-lg text-sm self-start hover:bg-red-50">Lihat Analisis</button>
            </div>
            <svg class="absolute -right-4 -bottom-4 w-[120px] h-[120px] opacity-10 rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
        </div>
        <div class="p-8 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-start gap-6 dark:bg-gray-800 dark:border-gray-700">
            <div class="h-16 w-16 rounded-full bg-red-50 flex items-center justify-center shrink-0 dark:bg-red-900/20">
                <svg class="w-8 h-8 text-red-700 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            <div>
                <h3 class="font-['Lexend'] text-xl font-semibold mb-1 dark:text-white">Butuh Bantuan?</h3>
                <p class="text-slate-500 text-sm mb-4 dark:text-gray-400">Tim dukungan arena kami selalu siap 24/7 membantu Anda mengelola fasilitas olahraga secara optimal.</p>
                <a class="text-red-700 font-bold text-sm flex items-center gap-1 hover:underline dark:text-red-400" href="#">
                    Buka Pusat Bantuan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0"
        :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
        <div class="w-1/3 transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 dark:bg-gray-800 dark:border dark:border-gray-700" id="deleteModalContent">
            <div class="flex items-center justify-center mb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                    <svg class="text-[#af101a] dark:text-red-400 text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </div>
            </div>
            <h3 class="text-center text-xl font-bold text-slate-900 mb-2 dark:text-white">Hapus Lapangan Ini?</h3>
            <p class="text-center text-sm text-slate-500 mb-6 dark:text-gray-400">
                Apakah Anda yakin ingin menghapus lapangan <strong id="deleteItemName"></strong> secara permanen? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
            <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
                <button type="button" onclick="closeDeleteModal()" class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" onclick="executeDelete()" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    const deleteModalContent = document.getElementById('deleteModalContent');
    const deleteFeedback = document.getElementById('deleteFeedback');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const deleteItemName = document.getElementById('deleteItemName');
    let currentDeleteUrl = '';

    function openDeleteModal(url, name) {
        currentDeleteUrl = url;
        deleteItemName.textContent = name;

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
        if (!currentDeleteUrl) return;

        const originalBtnText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white inline-block align-middle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Processing...`;

        try {
            const response = await fetch(currentDeleteUrl, {
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
                    window.location.reload();
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

    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            let nameElement = row.querySelector('td:nth-child(1) p.font-bold');
            if (nameElement) {
                let text = nameElement.textContent || nameElement.innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        });
    });
</script>
@endsection