@extends('layouts.front')

@section('title', 'Venue Tersedia - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 max-w-7xl mx-auto px-6">
    <!-- Main Title -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6 motion-hidden relative z-30">
        <div>
            <span class="text-red-600 dark:text-red-400 font-bold tracking-wider uppercase text-sm mb-2 block">Eksplorasi Venue</span>
            <h1 class="text-4xl md:text-5xl font-black font-['Lexend'] text-gray-900 dark:text-white tracking-tight mb-2">Temukan Lapangan <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-400">Terbaik</span></h1>
            <p id="total-venue-count" class="text-gray-500 dark:text-gray-400 text-lg">Ditemukan {{ $lapangans->total() }} fasilitas olahraga profesional untuk Anda.</p>
        </div>
        <div class="relative w-64 z-50 mt-4 md:mt-0">
            <!-- Hidden Select for Form Submission -->
            <select name="sort" form="filter-form" id="sort-select" class="hidden">
                <option value="terbaru" {{ request('sort', 'terbaru') == 'terbaru' ? 'selected' : '' }}>Relevance</option>
                <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Product Name: A-Z</option>
                <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Product Name: Z-A</option>
                <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>

            <!-- Custom Dropdown Button -->
            <div id="custom-dropdown-btn" class="flex items-center justify-between bg-white hover:bg-orange-50 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition-colors px-4 py-2.5 rounded-md border border-orange-500 cursor-pointer w-full z-50">
                <span class="text-gray-600 dark:text-white text-[15px]" id="custom-dropdown-text">
                    @php
                    $sortText = [
                    'terbaru' => 'Relevance',
                    'nama_asc' => 'Product Name: A-Z',
                    'nama_desc' => 'Product Name: Z-A',
                    'harga_asc' => 'Price: Low to High',
                    'harga_desc' => 'Price: High to Low',
                    ];
                    echo $sortText[request('sort', 'terbaru')];
                    @endphp
                </span>
                <svg id="custom-dropdown-icon" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>

            <!-- Custom Dropdown Menu -->
            <div id="custom-dropdown-menu" class="absolute left-0 top-[110%] w-full bg-[#f9fafa] dark:bg-gray-800 rounded-md shadow-[0_4px_15px_rgba(0,0,0,0.08)] border border-slate-100 dark:border-gray-700 hidden z-50">
                <!-- Upward Pointer -->
                <div class="absolute -top-1.5 left-8 w-3 h-3 bg-[#f9fafa] dark:bg-gray-800 transform rotate-45 shadow-[-2px_-2px_4px_rgba(0,0,0,0.02)] border-t border-l border-gray-100 dark:border-gray-700"></div>

                <ul class="relative z-10 py-1" id="custom-dropdown-options">
                    <li data-value="terbaru" class="px-4 py-2.5 text-[15px] cursor-pointer transition-colors {{ request('sort', 'terbaru') == 'terbaru' ? 'bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400' }}">Relevance</li>
                    <li data-value="nama_asc" class="px-4 py-2.5 text-[15px] cursor-pointer transition-colors {{ request('sort') == 'nama_asc' ? 'bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400' }}">Product Name: A-Z</li>
                    <li data-value="nama_desc" class="px-4 py-2.5 text-[15px] cursor-pointer transition-colors {{ request('sort') == 'nama_desc' ? 'bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400' }}">Product Name: Z-A</li>
                    <li data-value="harga_asc" class="px-4 py-2.5 text-[15px] cursor-pointer transition-colors {{ request('sort') == 'harga_asc' ? 'bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400' }}">Price: Low to High</li>
                    <li data-value="harga_desc" class="px-4 py-2.5 text-[15px] cursor-pointer transition-colors {{ request('sort') == 'harga_desc' ? 'bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400' }}">Price: High to Low</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <section class="mb-12 motion-hidden relative z-20">
        <form id="filter-form" action="{{ route('lapangan.index') }}" method="GET" class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-2xl p-5 shadow-xl shadow-gray-200/50 dark:shadow-black/50 border border-white/50 dark:border-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <!-- Sport Type -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest block">Jenis Olahraga</label>
                    <div class="relative w-full z-40">
                        <!-- Hidden Select -->
                        <select name="kategori" id="kategori-select" class="hidden">
                            <option value="">Semua Olahraga</option>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
                            @endforeach
                        </select>

                        <!-- Custom Dropdown Button -->
                        <div id="custom-dropdown-kat-btn" class="flex items-center justify-between bg-white hover:bg-orange-50 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition-colors px-4 py-2.5 rounded-md border border-orange-500 cursor-pointer w-full z-40">
                            <span class="text-gray-600 dark:text-white text-[15px]" id="custom-dropdown-kat-text">
                                @php
                                $selectedKat = 'Semua Olahraga';
                                foreach($kategoris as $kat) {
                                if (request('kategori') == $kat->id) {
                                $selectedKat = $kat->name;
                                break;
                                }
                                }
                                echo $selectedKat;
                                @endphp
                            </span>
                            <svg id="custom-dropdown-kat-icon" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <!-- Custom Dropdown Menu -->
                        <div id="custom-dropdown-kat-menu" class="absolute left-0 top-[110%] w-full bg-[#f9fafa] dark:bg-gray-800 rounded-md shadow-[0_4px_15px_rgba(0,0,0,0.08)] border border-slate-100 dark:border-gray-700 hidden z-40">
                            <!-- Upward Pointer -->
                            <div class="absolute -top-1.5 left-8 w-3 h-3 bg-[#f9fafa] dark:bg-gray-800 transform rotate-45 shadow-[-2px_-2px_4px_rgba(0,0,0,0.02)] border-t border-l border-gray-100 dark:border-gray-700"></div>

                            <ul class="relative z-10 py-1" id="custom-dropdown-kat-options">
                                <li data-value="" class="px-4 py-2.5 text-[15px] cursor-pointer transition-colors {{ request('kategori') == '' ? 'bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400' }}">Semua Olahraga</li>
                                @foreach($kategoris as $kat)
                                <li data-value="{{ $kat->id }}" class="px-4 py-2.5 text-[15px] cursor-pointer transition-colors {{ request('kategori') == $kat->id ? 'bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400' }}">{{ $kat->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Search -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest block">Nama Venue</label>
                    <div class="relative">
                        <input name="search" value="{{ request('search') }}" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl pl-11 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 text-gray-900 dark:text-white font-medium transition-all placeholder:text-gray-400" placeholder="Cari nama..." type="text" />
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    </div>
                </div>
                <!-- Price Range -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest block">Harga Maksimal</label>
                    <div class="relative">
                        <input name="harga_max" value="{{ request('harga_max') }}" class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl pl-11 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 text-gray-900 dark:text-white font-medium transition-all placeholder:text-gray-400" placeholder="Rp 500.000" type="number" />
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">payments</span>
                    </div>
                </div>
            </div>
            @if(request()->anyFilled(['kategori', 'search', 'harga_max', 'sort']))
            <!-- Chips/Filters Active -->
            <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('lapangan.index') }}" class="px-4 py-1.5 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm font-bold flex items-center gap-1.5 cursor-pointer transition-colors hover:bg-red-200 dark:hover:bg-red-900/50">
                    Reset Filter <span class="material-symbols-outlined text-[16px]">close</span>
                </a>
            </div>
            @endif
        </form>
    </section>

    <!-- Venue Grid Container -->
    <div id="lapangan-list-container">
        <!-- Loading State -->
        <div id="loading-overlay" class="hidden py-32 flex-col items-center justify-center">
            <svg class="animate-spin h-12 w-12 text-red-600 dark:text-red-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-500 dark:text-gray-400 font-medium text-lg animate-pulse">Memuat venue...</p>
        </div>

        <div id="venue-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
            @forelse($lapangans as $lapangan)
            <article class="bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-lg shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-gray-800 group hover:shadow-2xl hover:shadow-red-900/10 hover:-translate-y-1.5 transition-all duration-300 flex flex-col h-full relative">
                <div class="relative h-64 overflow-hidden">
                    @if($lapangan->gambarLapangans->count() > 0)
                    <img alt="{{ $lapangan->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ str_starts_with($lapangan->gambarLapangans->first()->gambar_file, 'http') ? $lapangan->gambarLapangans->first()->gambar_file : asset($lapangan->gambarLapangans->first()->gambar_file) }}" />
                    @else
                    <img alt="{{ $lapangan->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwJL8durSCNlaL__DnYui2ehrvuaF517XShJnybSlZKhq8Hvv3qpDdxb_bIPMLNAtxuQKVa9MTDL9y4SIcEpgp-bBED266PjaCJJ2jGSxmm8c9WEZjoZpYG0W5kHSqgPKlBQercIf3x1qviSBqumW0peujQ8VmqeWebkUF15MYpCmgp-aI6pw1yTm1Maewd1scAInsWLkGlgSu1XGNELEXfYaYQ7Y_CcLv2VkcAiIWulWUV2HLV0e_CnUQmbRfYDb1PZkO2F06JHw" />
                    @endif

                    {{-- Overlay gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>

                    <div class="absolute top-4 left-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                        <span class="material-symbols-outlined text-[16px] text-yellow-500" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">4.8</span>
                    </div>
                    <div class="absolute top-4 right-4 bg-green-500/90 backdrop-blur-md text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                        Tersedia
                    </div>

                    {{-- Floating price on image --}}
                    <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between z-10">
                        <div>
                            <span class="text-white/80 text-xs font-medium uppercase tracking-wider mb-1 block">Mulai dari</span>
                            <div class="text-white font-black text-2xl flex items-baseline gap-1">
                                Rp {{ number_format($lapangan->harga, 0, ',', '.') }}
                                <span class="text-white/70 font-normal text-sm">/ jam</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow bg-white dark:bg-gray-900">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold font-['Lexend'] text-gray-900 dark:text-white leading-tight group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">{{ $lapangan->name }}</h3>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-6">
                        <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-800 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                            <span class="material-symbols-outlined text-[18px] text-red-500">sports_score</span>
                            <span class="font-medium">{{ $lapangan->kategori->name ?? 'Olahraga' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-800 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                            <span class="material-symbols-outlined text-[18px] text-red-500">schedule</span>
                            <span class="font-medium">06:00 - 23:00</span>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-800">
                        <a href="{{ route('lapangan.show', $lapangan->id) }}" class="w-full flex items-center justify-center gap-2 bg-red-600 dark:bg-red-900/20 text-white dark:text-red-400 border border-red-100 dark:border-red-900/30 px-6 py-3 rounded-xl font-bold transition-all hover:bg-red-800 hover:text-white dark:hover:bg-red-600 dark:hover:text-white group-hover:shadow-lg group-hover:shadow-red-600/20">
                            Booking
                            <span class="material-symbols-outlined text-[20px] transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
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
            const venueGrid = document.getElementById('venue-grid');
            const pagination = document.querySelector('#lapangan-list-container .mt-xl');
            
            if (loadingOverlay) {
                loadingOverlay.classList.remove('hidden');
                loadingOverlay.classList.add('flex');
            }
            if (venueGrid) venueGrid.classList.add('hidden');
            if (pagination) pagination.classList.add('hidden');

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
                    filterForm.dispatchEvent(new Event('submit', {
                        cancelable: true
                    }));
                }, delay);
            });
        });

        // Handle sort select change
        sortSelect.addEventListener('change', function() {
            // Trigger form submit logic
            filterForm.dispatchEvent(new Event('submit', {
                cancelable: true
            }));
        });

        // Handle pagination clicks without reload
        document.addEventListener('click', function(e) {
            // Ensure we only intercept clicks on the pagination links, not the "Detail" buttons
            const paginationLink = e.target.closest('#lapangan-list-container nav[role="navigation"] a');
            if (paginationLink) {
                e.preventDefault();
                fetchFilteredData(paginationLink.href);
                // Scroll to top of grid
                document.getElementById('lapangan-list-container').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('custom-dropdown-btn');
        const menu = document.getElementById('custom-dropdown-menu');
        const icon = document.getElementById('custom-dropdown-icon');
        const select = document.getElementById('sort-select');
        const options = menu.querySelectorAll('li');
        const filterForm = document.getElementById('filter-form');

        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.classList.toggle('hidden');
            if (!katMenu.classList.contains('hidden')) {
                katMenu.classList.add('hidden');
                katIcon.classList.remove('rotate-180');
            }
            if (menu.classList.contains('hidden')) {
                icon.classList.remove('rotate-180');
            } else {
                icon.classList.add('rotate-180');
            }
        });

        const katBtn = document.getElementById('custom-dropdown-kat-btn');
        const katMenu = document.getElementById('custom-dropdown-kat-menu');
        const katIcon = document.getElementById('custom-dropdown-kat-icon');
        const katSelect = document.getElementById('kategori-select');
        const katOptions = katMenu.querySelectorAll('li');

        katBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            katMenu.classList.toggle('hidden');
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
            if (katMenu.classList.contains('hidden')) {
                katIcon.classList.remove('rotate-180');
            } else {
                katIcon.classList.add('rotate-180');
            }
        });

        document.addEventListener('click', function(e) {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
            if (!katBtn.contains(e.target) && !katMenu.contains(e.target)) {
                katMenu.classList.add('hidden');
                katIcon.classList.remove('rotate-180');
            }
        });

        options.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                select.value = value;
                
                const textElement = document.getElementById('custom-dropdown-text');
                if (textElement) textElement.innerText = this.innerText;
                
                menu.classList.add('hidden');
                icon.classList.remove('rotate-180');

                if (filterForm) {
                    filterForm.dispatchEvent(new Event('submit', { cancelable: true }));
                }
            });
        });

        katOptions.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                katSelect.value = value;
                
                const katTextElement = document.getElementById('custom-dropdown-kat-text');
                if (katTextElement) katTextElement.innerText = this.innerText;
                
                katMenu.classList.add('hidden');
                katIcon.classList.remove('rotate-180');

                if (filterForm) {
                    filterForm.dispatchEvent(new Event('submit', { cancelable: true }));
                }
            });
        });
    });
</script>
@endpush
@endsection