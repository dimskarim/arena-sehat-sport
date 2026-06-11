@extends('layouts.front')

@section('title', 'Venue Tersedia - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 max-w-7xl mx-auto px-6">
    <!-- Search and Filter Bar -->
    <section class="mb-lg motion-hidden">
        <form id="filter-form" action="{{ route('lapangan.index') }}" method="GET" class="bg-surface-container-lowest rounded-xl p-md shadow-[0_4px_20px_rgba(211,47,47,0.05)] border border-outline-variant/30">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter items-end">
                <!-- Sport Type -->
                <div class="space-y-xs">
                    <label class="text-label-md text-on-surface-variant block">Jenis Olahraga</label>
                    <div class="relative">
                        <select name="kategori" class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-body-md transition-all">
                            <option value="">Semua Olahraga</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-outline">expand_more</span>
                    </div>
                </div>
                <!-- Search -->
                <div class="space-y-xs">
                    <label class="text-label-md text-on-surface-variant block">Nama Venue</label>
                    <div class="relative">
                        <input name="search" value="{{ request('search') }}" class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-body-md transition-all" placeholder="Cari nama..." type="text"/>
                    </div>
                </div>
                <!-- Price Range -->
                <div class="space-y-xs">
                    <label class="text-label-md text-on-surface-variant block">Harga Maksimal</label>
                    <div class="relative">
                        <input name="harga_max" value="{{ request('harga_max') }}" class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-body-md transition-all" placeholder="Rp 500.000" type="number"/>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline">payments</span>
                    </div>
                </div>
            </div>
            @if(request()->anyFilled(['kategori', 'search', 'harga_max', 'sort']))
            <!-- Chips/Filters Active -->
            <div class="flex flex-wrap gap-sm mt-md pt-md border-t border-outline-variant/30">
                <a href="{{ route('lapangan.index') }}" class="px-4 py-1.5 rounded-full bg-primary text-on-primary font-label-md flex items-center gap-1 cursor-pointer transition-colors hover:brightness-110">
                    Reset Semua Filter <span class="material-symbols-outlined text-[16px]">close</span>
                </a>
            </div>
            @endif
        </form>
    </section>

    <!-- Main Title -->
    <div class="mb-md flex flex-col md:flex-row md:items-end justify-between gap-4 motion-hidden">
        <div>
            <h1 class="font-h2 text-h2 text-on-background">Venue Tersedia</h1>
            <p id="total-venue-count" class="text-body-lg text-on-surface-variant">Ditemukan {{ $lapangans->total() }} fasilitas olahraga profesional untuk Anda.</p>
        </div>
        <div class="flex items-center gap-2 text-label-md text-outline">
            <span class="material-symbols-outlined">sort</span>
            Urutkan: 
            <select name="sort" form="filter-form" id="sort-select" class="bg-transparent font-bold text-on-surface focus:outline-none cursor-pointer">
                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga: Terendah ke Tertinggi</option>
                <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga: Tertinggi ke Terendah</option>
            </select>
        </div>
    </div>

    <!-- Venue Grid Container -->
    <div id="lapangan-list-container">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter relative">
            <!-- Loading Overlay -->
            <div id="loading-overlay" class="absolute inset-0 bg-white/60 backdrop-blur-sm z-10 hidden flex items-center justify-center rounded-xl">
                <svg class="animate-spin h-10 w-10 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            
            @forelse($lapangans as $lapangan)
        <article class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_rgba(211,47,47,0.08)] border border-outline-variant/20 group hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all flex flex-col h-full">
            <div class="relative h-56 overflow-hidden">
                @if($lapangan->gambarLapangans->count() > 0)
                <img alt="{{ $lapangan->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('storage/' . $lapangan->gambarLapangans->first()->image_path) }}"/>
                @else
                <img alt="{{ $lapangan->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwJL8durSCNlaL__DnYui2ehrvuaF517XShJnybSlZKhq8Hvv3qpDdxb_bIPMLNAtxuQKVa9MTDL9y4SIcEpgp-bBED266PjaCJJ2jGSxmm8c9WEZjoZpYG0W5kHSqgPKlBQercIf3x1qviSBqumW0peujQ8VmqeWebkUF15MYpCmgp-aI6pw1yTm1Maewd1scAInsWLkGlgSu1XGNELEXfYaYQ7Y_CcLv2VkcAiIWulWUV2HLV0e_CnUQmbRfYDb1PZkO2F06JHw"/>
                @endif
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px] text-yellow-500" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="text-label-md text-on-surface">4.8</span>
                </div>
                <div class="absolute top-4 right-4 bg-green-500 text-white text-[12px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Tersedia
                </div>
            </div>
            <div class="p-md flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-h3 text-h3 text-on-surface leading-tight">{{ $lapangan->name }}</h3>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant mb-4">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span class="text-body-md">{{ $lapangan->kategori->name ?? 'Olahraga' }}</span>
                </div>
                <div class="mt-auto pt-md border-t border-outline-variant/30 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-1">Mulai dari</p>
                        <p class="text-primary font-bold text-lg">Rp {{ number_format($lapangan->harga, 0, ',', '.') }} <span class="text-on-surface-variant font-normal text-sm">/ jam</span></p>
                    </div>
                    <a href="{{ route('lapangan.show', $lapangan->id) }}" class="inline-block bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md transition-all hover:bg-primary/90 active:scale-95 shadow-md">Detail</a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full py-12 text-center text-on-surface-variant">
            <span class="material-symbols-outlined text-5xl mb-4 text-outline">search_off</span>
            <h3 class="text-h3 font-h3 mb-2">Tidak ada venue ditemukan</h3>
            <p>Silakan coba cari dengan kata kunci atau filter lain.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-xl flex justify-center">
        {{ $lapangans->links('components.pagination') }}
    </div>
</div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const sortSelect = document.getElementById('sort-select');
    
    function fetchFilteredData(url) {
        const loadingOverlay = document.getElementById('loading-overlay');
        if (loadingOverlay) loadingOverlay.classList.remove('hidden');
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Update the grid and pagination
            const newContainer = doc.getElementById('lapangan-list-container');
            const oldContainer = document.getElementById('lapangan-list-container');
            if (newContainer && oldContainer) {
                oldContainer.replaceWith(newContainer);
            }
            
            // Update total venue text
            const newTotal = doc.getElementById('total-venue-count');
            const oldTotal = document.getElementById('total-venue-count');
            if (newTotal && oldTotal) {
                oldTotal.replaceWith(newTotal);
            }
            
            // Push state to browser history
            window.history.pushState({}, '', url);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Fallback to normal submit on error
            window.location.href = url;
        });
    }

    // Handle form submit
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = new URL(this.action);
        const formData = new FormData(this);
        
        // Append all form inputs to URLSearchParams
        const searchParams = new URLSearchParams();
        for (const pair of formData) {
            if (pair[1]) {
                searchParams.append(pair[0], pair[1]);
            }
        }
        
        // Append sort manually if it's not inside the form (using form attribute)
        if (sortSelect.value) {
            searchParams.append('sort', sortSelect.value);
        }
        
        url.search = searchParams.toString();
        fetchFilteredData(url.toString());
    });

    // Auto-submit filter on input change (with debounce for text inputs)
    let filterDebounceTimer;
    filterForm.querySelectorAll('input, select').forEach(input => {
        const eventType = input.tagName === 'SELECT' ? 'change' : 'input';
        input.addEventListener(eventType, function() {
            clearTimeout(filterDebounceTimer);
            // Submit immediately for select, delay 600ms for text inputs
            const delay = input.tagName === 'SELECT' ? 0 : 600;
            filterDebounceTimer = setTimeout(() => {
                filterForm.dispatchEvent(new Event('submit', { cancelable: true }));
            }, delay);
        });
    });

    // Handle sort select change
    sortSelect.addEventListener('change', function() {
        // Trigger form submit logic
        filterForm.dispatchEvent(new Event('submit', { cancelable: true }));
    });
    
    // Handle pagination clicks without reload
    document.addEventListener('click', function(e) {
        // Ensure we only intercept clicks on the pagination links, not the "Detail" buttons
        const paginationLink = e.target.closest('#lapangan-list-container nav[role="navigation"] a');
        if (paginationLink) {
            e.preventDefault();
            fetchFilteredData(paginationLink.href);
            // Scroll to top of grid
            document.getElementById('lapangan-list-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>
@endpush
@endsection
