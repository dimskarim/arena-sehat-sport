@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c] dark:text-white">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] dark:text-white tracking-tight">Manajemen User</h2>
            <p class="text-[#5b403d] dark:text-gray-400 mt-1">Kelola profil pengguna, peran, dan status akses platform.</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center gap-2 px-6 py-3 bg-[#af101a] dark:bg-red-600 text-white rounded-lg font-bold shadow-lg shadow-red-900/20 hover:bg-opacity-90 dark:hover:bg-red-700 active:scale-[0.98] transition-all">
            <svg class=" inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
            </svg>
            <span>Tambah User</span>
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 dark:border-green-500 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 dark:text-green-400 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Stats & Filters Row --}}
    <div id="statsContainer" class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">

        {{-- Stat: Total User --}}
        <div class="bg-[#f6f3f2] dark:bg-gray-800 p-6 rounded-xl border border-[#e4beba] dark:border-gray-700 flex items-center gap-4 shadow-sm">
            <div class="bg-[#fdcbd0] dark:bg-red-900/30 p-3 rounded-full shrink-0">
                <svg class="text-[#795358] dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-wider">Total Pengguna</p>
                <p class="text-2xl font-black font-['Lexend'] text-slate-900 dark:text-white">
                    {{ method_exists($items, 'total') ? number_format($items->total()) : count($items) }}
                </p>
            </div>
        </div>

        {{-- Stat: Admin --}}
        <div class="bg-[#f6f3f2] dark:bg-gray-800 p-6 rounded-xl border border-[#e4beba] dark:border-gray-700 flex items-center gap-4 shadow-sm">
            <div class="bg-red-50 dark:bg-red-900/30 p-3 rounded-full shrink-0">
                <svg class="text-[#af101a] dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-wider">Admin Aktif</p>
                <p class="text-2xl font-black font-['Lexend'] text-[#af101a] dark:text-red-400">
                    {{ $items->where('role', 'admin')->count() }}
                </p>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-4 rounded-xl border border-[#e4beba] dark:border-gray-700 shadow-sm flex flex-wrap items-end gap-4">
            <form id="filterForm" method="GET" action="{{ route('admin.users.index') }}" onsubmit="event.preventDefault(); handleFilter();" class="flex flex-wrap items-end gap-4 w-full">
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-[10px] font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-1.5">Filter Peran</label>
                    <select name="role" onchange="handleFilter()" class="w-full px-3 py-2 bg-[#fcf9f8] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none appearance-none cursor-pointer">
                        <option value="">Semua Peran</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Pengguna</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-[10px] font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-1.5">Pencarian</label>
                    <input name="search" value="{{ request('search') }}" type="text" placeholder="Nama atau email..." onkeyup="debounceFilter()"
                        class="w-full px-3 py-2 bg-[#fcf9f8] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none" />
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-[#af101a] dark:bg-red-600 text-white text-sm font-bold rounded-lg hover:bg-red-800 dark:hover:bg-red-700 transition-colors">
                        Filter
                    </button>
                    <button type="button" onclick="document.querySelector('input[name=search]').value=''; document.querySelector('select[name=role]').value=''; handleFilter();" class="px-4 py-2 text-[#af101a] dark:text-red-400 text-sm font-bold hover:bg-[#fdcbd0] dark:hover:bg-red-900/30 rounded-lg transition-colors">
                        Clear
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table --}}
    <div id="tableContainer" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-[#e4beba] dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0eded] dark:bg-gray-900/50 text-[#5b403d] dark:text-gray-400 border-b border-[#e4beba] dark:border-gray-700">
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Detail Pengguna</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Info Kontak</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Peran</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Tgl. Daftar</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba] dark:divide-gray-700">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] dark:hover:bg-gray-700/20 transition-colors group">

                        {{-- User Details --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($item->foto_profile)
                                @php $imgUrl = str_starts_with($item->foto_profile, 'http') ? $item->foto_profile : asset($item->foto_profile); @endphp
                                <img src="{{ $imgUrl }}" alt="{{ $item->name }}"
                                    class="w-10 h-10 rounded-full object-cover border border-[#e4beba] dark:border-gray-600 shrink-0" />
                                @else
                                <div class="w-10 h-10 rounded-full bg-[#d32f2f] dark:bg-red-700 flex items-center justify-center text-white font-bold text-sm shrink-0 border border-[#af101a] dark:border-red-900">
                                    {{ strtoupper(substr($item->name ?? 'U', 0, 2)) }}
                                </div>
                                @endif
                                <div>
                                    <p class="font-bold text-[#1b1c1c] dark:text-white">{{ $item->name ?? '-' }}</p>
                                    <p class="text-xs text-[#5b403d] dark:text-gray-400">ID: VR-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Contact Info --}}
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-[#1b1c1c] dark:text-white">{{ $item->email ?? '-' }}</p>
                            <p class="text-xs text-[#5b403d] dark:text-gray-400">{{ $item->no_telp ?? '-' }}</p>
                        </td>

                        {{-- Role --}}
                        <td class="px-6 py-4">
                            @if(strtolower($item->role ?? '') === 'admin')
                            <span class="px-3 py-1 bg-[#af101a] dark:bg-red-600 text-white text-[10px] font-black uppercase rounded-full">Admin</span>
                            @else
                            <span class="px-3 py-1 bg-[#fdcbd0] dark:bg-gray-700 text-[#795358] dark:text-gray-300 text-[10px] font-black uppercase rounded-full">User</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @php $status = strtolower($item->status ?? 'aktif'); @endphp
                            @if($status === 'aktif')
                            <div class="flex items-center gap-1.5 text-green-600 dark:text-green-400">
                                <div class="w-2 h-2 bg-green-500 dark:bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-xs font-bold uppercase">Aktif</span>
                            </div>
                            @elseif($status === 'ditangguhkan' || $status === 'suspended')
                            <div class="flex items-center gap-1.5 text-[#ba1a1a] dark:text-red-400">
                                <div class="w-2 h-2 bg-[#ba1a1a] dark:bg-red-500 rounded-full"></div>
                                <span class="text-xs font-bold uppercase">Ditangguhkan</span>
                            </div>
                            @else
                            <div class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400">
                                <div class="w-2 h-2 bg-gray-400 dark:bg-gray-500 rounded-full"></div>
                                <span class="text-xs font-bold uppercase">Tidak Aktif</span>
                            </div>
                            @endif
                        </td>

                        {{-- Reg. Date --}}
                        <td class="px-6 py-4">
                            <p class="text-sm text-[#5b403d] dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}
                            </p>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.users.edit', $item->id) }}"
                                    class="p-2 text-[#5b403d] dark:text-gray-400 hover:text-[#af101a] dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all"
                                    title="Ubah Profil">
                                    <svg class="text-[20px] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ route('admin.users.destroy', $item->id) }}', '{{ addslashes($item->name) }}')"
                                    class="p-2 text-[#5b403d] dark:text-gray-400 hover:text-[#ba1a1a] dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-all"
                                    title="Hapus Pengguna">
                                    <svg class="text-[20px] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-[#5b403d] dark:text-gray-400">
                            <svg class="text-4xl block mb-2 text-[#e4beba] dark:text-gray-600 inline-block align-middle w-5 h-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                            <p class="font-medium">Tidak ada data user.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="pagination-wrapper px-6 py-4 bg-[#f6f3f2] dark:bg-gray-800/50 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-[#e4beba] dark:border-gray-700">
            @if(method_exists($items, 'firstItem'))
            <p class="text-sm text-[#5b403d] dark:text-gray-400">
                Menampilkan <span class="font-bold text-[#1b1c1c] dark:text-white">{{ $items->firstItem() }} - {{ $items->lastItem() }}</span>
                dari {{ number_format($items->total()) }} pengguna
            </p>
            @endif
            @if(method_exists($items, 'links'))
            {{ $items->links('components.pagination') }}
            @endif
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0 font-['Inter'] text-[#1b1c1c] dark:text-white"
        :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
        <div class="w-fit transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 border border-[#e4beba] dark:border-gray-700" id="deleteModalContent">
            <div class="flex items-center justify-center mb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                    <svg class="text-[#af101a] dark:text-red-400 text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </div>
            </div>
            <h3 class="text-center text-xl font-bold text-[#1b1c1c] dark:text-white mb-2">Hapus User Ini?</h3>
            <p class="text-center text-sm text-[#5b403d] dark:text-gray-400 mb-6">
                Apakah Anda yakin ingin menghapus <strong id="deleteUserName"></strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
            <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
                <button type="button" onclick="closeDeleteModal()"
                    class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-[#e4beba] dark:border-gray-600 bg-white dark:bg-gray-800 px-5 py-2.5 text-sm font-semibold text-[#5b403d] dark:text-gray-300 hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" onclick="executeDelete()"
                    class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] dark:bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800 dark:hover:bg-red-700 transition-colors">
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
    const deleteUserName = document.getElementById('deleteUserName');

    let deleteUrl = '';
    let debounceTimer;

    // AJAX Fetch Function
    async function fetchData(url) {
        const tableContainer = document.getElementById('tableContainer');
        tableContainer.style.opacity = '0.5';
        tableContainer.style.pointerEvents = 'none';
        
        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Update Table & Pagination
            const newTableContainer = doc.getElementById('tableContainer');
            if (newTableContainer) {
                tableContainer.innerHTML = newTableContainer.innerHTML;
            }
            
            // Update Stats
            const currentStats = document.getElementById('statsContainer');
            const newStats = doc.getElementById('statsContainer');
            if (currentStats && newStats) {
                const statBlocks = currentStats.querySelectorAll('p.text-2xl');
                const newStatBlocks = newStats.querySelectorAll('p.text-2xl');
                if(statBlocks.length >= 2 && newStatBlocks.length >= 2) {
                    statBlocks[0].innerHTML = newStatBlocks[0].innerHTML; // Total Pengguna
                    statBlocks[1].innerHTML = newStatBlocks[1].innerHTML; // Admin Aktif
                }
            }
            
            // Update URL
            window.history.pushState({}, '', url);
        } catch (error) {
            console.error('Error fetching data:', error);
        } finally {
            tableContainer.style.opacity = '1';
            tableContainer.style.pointerEvents = 'auto';
        }
    }

    function handleFilter() {
        const form = document.getElementById('filterForm');
        const url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();
        fetchData(url);
    }

    function debounceFilter() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(handleFilter, 300);
    }

    // Handle Pagination Clicks
    document.addEventListener('click', function(e) {
        const paginationLink = e.target.closest('.pagination-wrapper a');
        if (paginationLink && paginationLink.href) {
            e.preventDefault();
            fetchData(paginationLink.href);
        }
    });

    // Handle Browser Back/Forward
    window.addEventListener('popstate', function() {
        fetchData(window.location.href);
        const urlParams = new URLSearchParams(window.location.search);
        const form = document.getElementById('filterForm');
        if (form) {
            form.querySelector('input[name="search"]').value = urlParams.get('search') || '';
            form.querySelector('select[name="role"]').value = urlParams.get('role') || '';
        }
    });

    function openDeleteModal(url, name) {
        deleteUrl = url;
        deleteUserName.textContent = name || 'User';

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
        if (!deleteUrl) return;

        const originalBtnText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memproses...`;

        try {
            const response = await fetch(deleteUrl, {
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
                deleteFeedback.innerHTML = '<p class="flex items-center gap-2">✅ Berhasil dihapus. Merefresh...</p>';
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
</script>
@endsection
