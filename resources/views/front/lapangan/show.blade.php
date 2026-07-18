@extends('layouts.front')

@section('title', 'Elite Badminton Center - ArenaFlow')

@push('styles')
<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-template-rows: 1fr 1fr;
        gap: 12px;
        height: 500px;
    }
    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(3, 200px);
            height: auto;
        }
    }
</style>
@endpush

@section('content')
<main class="pt-24 pb-20 max-w-7xl mx-auto px-6">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-8 text-gray-500 dark:text-gray-400 text-sm font-medium">
        <a class="hover:text-red-600 dark:hover:text-red-400 transition-colors flex items-center gap-1" href="{{ route('home') }}">
            <span class="material-symbols-outlined text-[18px]">home</span> Beranda
        </a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <a class="hover:text-red-600 dark:hover:text-red-400 transition-colors" href="{{ route('lapangan.index') }}">Venue</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="text-gray-900 dark:text-white font-semibold">{{ $lapangan->name }}</span>
    </div>
    
    <!-- Image Gallery -->
    <section class="gallery-grid mb-12 motion-hidden">
        @if($lapangan->gambarLapangans->count() > 0)
            <div class="row-span-2 relative overflow-hidden rounded-2xl group cursor-pointer shadow-sm border border-gray-100 dark:border-gray-800" onclick="openLightbox(0)">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ str_starts_with($lapangan->gambarLapangans[0]->gambar_file, 'http') ? $lapangan->gambarLapangans[0]->gambar_file : asset($lapangan->gambarLapangans[0]->gambar_file) }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md border border-white/30 text-white p-2.5 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center translate-y-2 group-hover:translate-y-0">
                    <span class="material-symbols-outlined text-[20px]">zoom_in</span>
                </div>
            </div>
            @if($lapangan->gambarLapangans->count() > 1)
            <div class="relative overflow-hidden rounded-2xl group cursor-pointer shadow-sm border border-gray-100 dark:border-gray-800" onclick="openLightbox(1)">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ str_starts_with($lapangan->gambarLapangans[1]->gambar_file, 'http') ? $lapangan->gambarLapangans[1]->gambar_file : asset($lapangan->gambarLapangans[1]->gambar_file) }}"/>
                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md border border-white/30 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center translate-y-2 group-hover:translate-y-0">
                    <span class="material-symbols-outlined text-[18px]">zoom_in</span>
                </div>
            </div>
            @endif
            @if($lapangan->gambarLapangans->count() > 2)
            <div class="relative overflow-hidden rounded-2xl group cursor-pointer shadow-sm border border-gray-100 dark:border-gray-800" onclick="openLightbox(2)">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ str_starts_with($lapangan->gambarLapangans[2]->gambar_file, 'http') ? $lapangan->gambarLapangans[2]->gambar_file : asset($lapangan->gambarLapangans[2]->gambar_file) }}"/>
                <div class="absolute inset-0 flex items-center justify-center bg-black/40 backdrop-blur-[2px] transition-all duration-300 group-hover:bg-black/50">
                    <button type="button" class="bg-white/90 dark:bg-gray-900/90 text-gray-900 dark:text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-xl hover:scale-105 transition-transform duration-300">
                        <span class="material-symbols-outlined text-[20px]" data-icon="grid_view">grid_view</span>
                        Lihat semua foto
                    </button>
                </div>
            </div>
            @endif
        @else
        <div class="row-span-2 relative overflow-hidden rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 group">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqpBhEvfDl0EYz-Gace0gou9P7Fz8VK0epdfEulBBrt60a_3uI6PmVnuKq1hKsDQ6RpTYiIzA1Do44n6D7G6tPZdYYQKXksWMQ2arzHNzsWuOSasPkS-hxzykxg_XoTW83v3aI5f-F-CK3jLmmVDF3ih-dUjIBFnbCv2bMFKVqrPfWaHxLr91Uit97LjalGAFA4r5-FKBTBQMQv8LwL9zOCCC1AUMomdHx-pwD-LbOH8NcyExW4o3fPDQTMwR5qKJ3zp99CvTablk"/>
        </div>
        @endif
    </section>
    
    <!-- Main Content & Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
        <!-- Left Column: Details & Booking -->
        <div class="lg:col-span-2 flex flex-col gap-10 motion-hidden delay-100">
            <!-- Venue Intro -->
            <div class="flex flex-col gap-4">
                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                    <div>
                        <h1 class="text-4xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-3">{{ $lapangan->name }}</h1>
                        <div class="flex flex-wrap items-center gap-4 text-gray-500 dark:text-gray-400 text-sm">
                            <div class="flex items-center gap-1.5 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-500 px-3 py-1 rounded-lg font-bold">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                4.9 <span class="font-normal text-yellow-600/70 dark:text-yellow-500/70 ml-1">(128 ulasan)</span>
                            </div>
                            <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-800 px-3 py-1 rounded-lg border border-gray-200 dark:border-gray-700">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                                <span class="font-medium">{{ $lapangan->kategori->name ?? 'Olahraga' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <button class="p-2.5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 rounded-full hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-red-600 dark:hover:text-red-400 hover:border-red-200 dark:hover:border-red-900/50 transition-all shadow-sm">
                            <span class="material-symbols-outlined">share</span>
                        </button>
                        <button class="p-2.5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 hover:border-red-200 dark:hover:border-red-900/50 transition-all shadow-sm group">
                            <span class="material-symbols-outlined group-hover:scale-110 transition-transform">favorite</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <section class="prose dark:prose-invert max-w-none">
                <h2 class="text-2xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-4">Deskripsi</h2>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                    {{ $lapangan->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}
                </p>
            </section>
            
            <!-- Facilities -->
            <section>
                <h2 class="text-2xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-4">Fasilitas</h2>
                @if($lapangan->fasilitas && $lapangan->fasilitas->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($lapangan->fasilitas as $fasilitas)
                    <div class="flex items-center gap-3 p-4 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-xl shadow-sm hover:shadow-md hover:border-red-200 dark:hover:border-red-900/50 transition-all">
                        <div class="w-8 h-8 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-600 dark:text-red-400">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        </div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $fasilitas->name }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-8 bg-gray-50 dark:bg-gray-800/50 border border-dashed border-gray-200 dark:border-gray-700 rounded-xl text-center">
                    <span class="material-symbols-outlined text-4xl text-gray-400 mb-3 block">info</span>
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada informasi fasilitas khusus yang ditambahkan.</p>
                </div>
                @endif
            </section>
            
            <!-- Interactive Booking -->
            <section class="bg-white dark:bg-gray-900 p-6 md:p-8 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-gray-800" id="booking-section">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-6 border-b border-gray-100 dark:border-gray-800">
                    <h2 class="text-2xl font-bold font-['Lexend'] text-gray-900 dark:text-white">Pilih Jadwal</h2>
                    <div class="flex items-center gap-4 text-sm font-medium bg-gray-50 dark:bg-gray-800 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                            <span class="text-gray-600 dark:text-gray-400">Penuh/Lewat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]"></div>
                            <span class="text-gray-900 dark:text-white font-bold">Tersedia</span>
                        </div>
                    </div>
                </div>
                <!-- Simple Date Selector -->
                <div class="flex gap-3 overflow-x-auto pb-4 mb-8 no-scrollbar" id="date-selector">
                    <!-- Dates injected via JS -->
                </div>
                <!-- Time Slot Grid -->
                <div id="slots-loading" class="hidden text-center py-12">
                    <span class="material-symbols-outlined animate-spin text-red-600 dark:text-red-500 text-4xl">autorenew</span>
                </div>
                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3" id="time-slots">
                    <div class="col-span-full text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-gray-300 dark:text-gray-600 mb-2 block">calendar_month</span>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Pilih tanggal untuk melihat jadwal tersedia.</p>
                    </div>
                </div>
            </section>
        </div>
        
        <!-- Right Column: Summary Card -->
        <aside class="sticky top-24">
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-6 md:p-8 shadow-xl shadow-gray-200/50 dark:shadow-black/20 flex flex-col gap-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-600 to-red-400"></div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">Tarif Sewa</p>
                        <h3 class="text-3xl font-black font-['Lexend'] text-red-600 dark:text-red-400 leading-none">Rp <span id="summary-price">{{ number_format($lapangan->harga, 0, ',', '.') }}</span></h3>
                    </div>
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">/ jam</span>
                </div>
                
                <div class="space-y-4 pt-6 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between text-sm font-medium text-gray-600 dark:text-gray-300">
                        <span>Tanggal Dipilih</span>
                        <span class="text-gray-900 dark:text-white font-bold" id="summary-date">-</span>
                    </div>
                    <div class="flex justify-between text-sm font-medium text-gray-600 dark:text-gray-300">
                        <span>Sesi (<span id="summary-session-count">0</span>)</span>
                        <div class="text-right" id="summary-sessions">
                            <p class="text-gray-400 dark:text-gray-500 italic">Belum ada sesi dipilih</p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-3 pt-6 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between text-gray-600 dark:text-gray-400 font-medium text-sm">
                        <span>Subtotal</span>
                        <span class="text-gray-900 dark:text-white">Rp <span id="summary-subtotal">0</span></span>
                    </div>
                    <div class="flex justify-between text-gray-600 dark:text-gray-400 font-medium text-sm">
                        <span>Biaya Layanan</span>
                        <span class="text-gray-900 dark:text-white">Rp <span id="summary-fee">0</span></span>
                    </div>
                    <div class="flex justify-between text-xl font-black font-['Lexend'] text-gray-900 dark:text-white pt-3 border-t border-dashed border-gray-200 dark:border-gray-700">
                        <span>Total Bayar</span>
                        <span class="text-red-600 dark:text-red-400">Rp <span id="summary-total">0</span></span>
                    </div>
                </div>
                
                <form action="{{ route('booking.create') }}" method="GET" id="booking-form" class="mt-2">
                    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                    <input type="hidden" name="tanggal" id="input-tanggal" value="">
                    <input type="hidden" name="slot_ids" id="input-slots" value="">
                    <button type="submit" id="btn-lanjut" disabled class="block text-center w-full bg-red-600 dark:bg-red-600 text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-red-600/20 transition-all hover:bg-red-700 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed group">
                        Lanjut ke Pembayaran
                        <span class="material-symbols-outlined text-[20px] inline-block align-middle ml-1 transition-transform group-hover:translate-x-1">arrow_right_alt</span>
                    </button>
                </form>
                
                <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-2 px-2">
                    Anda belum dikenakan biaya saat ini. Transaksi sepenuhnya aman dan dilindungi.
                </p>
            </div>
            
            <!-- Host Info Small -->
            <div class="mt-6 p-5 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400 font-bold text-lg border border-red-200 dark:border-red-900/50">
                    A
                </div>
                <div>
                    <p class="font-bold text-gray-900 dark:text-white">Admin ArenaFlow</p>
                    <div class="flex items-center gap-1 text-xs text-green-600 dark:text-green-400 font-medium">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        Respon cepat
                    </div>
                </div>
                <a href="{{ route('support') }}" class="ml-auto bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold text-xs px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Chat</a>
            </div>
        </aside>
    </div>
    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-[100] bg-black/95 hidden items-center justify-center backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeLightbox(event)">
        <!-- Top Bar -->
        <div class="absolute top-0 left-0 right-0 p-6 flex justify-between items-center z-10 bg-gradient-to-b from-black/60 to-transparent pointer-events-none">
            <div class="text-white font-label-md bg-black/50 px-3 py-1.5 rounded-full" id="lightbox-counter">1 / 1</div>
            <button class="text-white hover:text-red-400 bg-black/50 p-2 rounded-full transition-colors pointer-events-auto" onclick="closeLightbox(event)">
                <span class="material-symbols-outlined text-2xl">close</span>
            </button>
        </div>
        
        <!-- Prev Button -->
        <button id="lightbox-prev" class="absolute left-4 md:left-8 text-white hover:text-primary bg-black/50 hover:bg-black/80 p-3 rounded-full transition-all z-10" onclick="prevImage(event)">
            <span class="material-symbols-outlined text-3xl">chevron_left</span>
        </button>
        
        <!-- Image Container -->
        <div class="relative w-full h-full flex items-center justify-center p-4 md:p-12">
            <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain rounded-md shadow-2xl scale-95 transition-transform duration-300 select-none" onclick="event.stopPropagation()">
        </div>
        
        <!-- Next Button -->
        <button id="lightbox-next" class="absolute right-4 md:right-8 text-white hover:text-primary bg-black/50 hover:bg-black/80 p-3 rounded-full transition-all z-10" onclick="nextImage(event)">
            <span class="material-symbols-outlined text-3xl">chevron_right</span>
        </button>
    </div>
</main>
@endsection

@push('scripts')
<script>
    // Lightbox Logic
    let currentImageIndex = 0;
    const galleryImages = [
        @foreach($lapangan->gambarLapangans as $gambar)
        "{{ str_starts_with($gambar->gambar_file, 'http') ? $gambar->gambar_file : asset($gambar->gambar_file) }}",
        @endforeach
    ];

    function openLightbox(index) {
        if (galleryImages.length === 0) return;
        currentImageIndex = index;
        updateLightboxImage();
        
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        
        // Small delay to allow display block to apply before opacity transition
        setTimeout(() => {
            lightbox.classList.remove('opacity-0');
            document.getElementById('lightbox-img').classList.remove('scale-95');
            document.getElementById('lightbox-img').classList.add('scale-100');
        }, 10);
        
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeLightbox(e) {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('opacity-0');
        document.getElementById('lightbox-img').classList.remove('scale-100');
        document.getElementById('lightbox-img').classList.add('scale-95');
        
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }, 300);
    }

    function updateLightboxImage() {
        const lightboxImg = document.getElementById('lightbox-img');
        lightboxImg.src = galleryImages[currentImageIndex];
        
        // Handle Prev/Next visibility
        document.getElementById('lightbox-prev').style.display = currentImageIndex > 0 ? 'flex' : 'none';
        document.getElementById('lightbox-next').style.display = currentImageIndex < galleryImages.length - 1 ? 'flex' : 'none';
        
        // Update Counter
        document.getElementById('lightbox-counter').textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
    }
    
    function nextImage(e) {
        e.stopPropagation();
        if (currentImageIndex < galleryImages.length - 1) {
            currentImageIndex++;
            updateLightboxImage();
        }
    }
    
    function prevImage(e) {
        e.stopPropagation();
        if (currentImageIndex > 0) {
            currentImageIndex--;
            updateLightboxImage();
        }
    }

    // Keyboard navigation for lightbox
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextImage(e);
            if (e.key === 'ArrowLeft') prevImage(e);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const dateSelector = document.getElementById('date-selector');
        const timeSlots = document.getElementById('time-slots');
        const slotsLoading = document.getElementById('slots-loading');
        const lapanganId = {{ $lapangan->id }};
        const hargaPerJam = {{ $lapangan->harga }};
        const biayaLayanan = 5000;
        
        let selectedDate = null;
        let selectedSlots = new Map(); // id -> slot object

        // Generate next 14 days
        const today = new Date();
        const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for (let i = 0; i < 14; i++) {
            let d = new Date();
            d.setDate(today.getDate() + i);
            
            // Generate YYYY-MM-DD in local timezone safely
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            const dateStr = `${year}-${month}-${day}`;
            const dayName = days[d.getDay()];
            const dateNum = d.getDate();
            
            const btn = document.createElement('button');
            btn.className = 'date-btn flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-surface-container-low hover:bg-secondary-container transition-colors';
            btn.dataset.date = dateStr;
            btn.dataset.displayDate = `${dateNum} ${months[d.getMonth()]} ${d.getFullYear()}`;
            btn.innerHTML = `
                <span class="text-xs uppercase font-bold text-on-surface-variant">${dayName}</span>
                <span class="text-xl font-black text-on-surface">${dateNum}</span>
            `;
            
            btn.addEventListener('click', () => selectDate(btn, dateStr));
            dateSelector.appendChild(btn);
        }

        function selectDate(btn, dateStr) {
            // Update UI
            document.querySelectorAll('.date-btn').forEach(b => {
                b.classList.remove('bg-primary', 'text-white', 'shadow-lg');
                b.classList.add('bg-surface-container-low');
                b.querySelector('span:first-child').classList.remove('text-white');
                b.querySelector('span:first-child').classList.add('text-on-surface-variant');
                b.querySelector('span:last-child').classList.remove('text-white');
                b.querySelector('span:last-child').classList.add('text-on-surface');
            });
            
            btn.classList.remove('bg-surface-container-low');
            btn.classList.add('bg-primary', 'text-white', 'shadow-lg');
            btn.querySelector('span:first-child').classList.add('text-white');
            btn.querySelector('span:first-child').classList.remove('text-on-surface-variant');
            btn.querySelector('span:last-child').classList.add('text-white');
            btn.querySelector('span:last-child').classList.remove('text-on-surface');
            
            selectedDate = dateStr;
            document.getElementById('summary-date').textContent = btn.dataset.displayDate;
            document.getElementById('input-tanggal').value = dateStr;
            
            // Clear selections when date changes
            selectedSlots.clear();
            updateSummary();
            
            // Fetch slots
            fetchSlots(dateStr);
        }

        function fetchSlots(dateStr) {
            timeSlots.innerHTML = '';
            timeSlots.classList.add('hidden');
            slotsLoading.classList.remove('hidden');
            
            fetch(`/lapangan/${lapanganId}/slots?tanggal=${dateStr}`)
                .then(res => res.json())
                .then(data => {
                    slotsLoading.classList.add('hidden');
                    timeSlots.classList.remove('hidden');
                    
                    if(data.length === 0) {
                        timeSlots.innerHTML = '<div class="col-span-full text-center text-on-surface-variant py-4">Tidak ada jadwal operasional pada tanggal ini.</div>';
                        return;
                    }

                    // Check if selected date is today to disable past slots
                    const currentYear = today.getFullYear();
                    const currentMonth = String(today.getMonth() + 1).padStart(2, '0');
                    const currentDay = String(today.getDate()).padStart(2, '0');
                    const todayStr = `${currentYear}-${currentMonth}-${currentDay}`;
                    const isToday = dateStr === todayStr;
                    const currentHour = today.getHours();
                    const currentMinute = today.getMinutes();

                    data.forEach(slot => {
                        const startHour = parseInt(slot.waktu_mulai.split(':')[0]);
                        const startMin = parseInt(slot.waktu_mulai.split(':')[1]);
                        
                        let isPast = false;
                        if (isToday) {
                            if (startHour < currentHour || (startHour === currentHour && startMin <= currentMinute)) {
                                isPast = true;
                            }
                        }

                        const isUnavailable = slot.is_booked || isPast;
                        
                        const btn = document.createElement('button');
                        btn.className = `py-2 px-2 rounded-lg text-xs font-semibold transition-all ${isUnavailable ? 'bg-red-600 text-white cursor-not-allowed opacity-80' : 'bg-green-500 text-white hover:ring-2 hover:ring-green-600'}`;
                        btn.textContent = `${slot.waktu_mulai.substring(0, 5)} - ${slot.waktu_selesai.substring(0, 5)}`;
                        
                        if (!isUnavailable) {
                            btn.addEventListener('click', () => toggleSlot(btn, slot));
                        }
                        
                        timeSlots.appendChild(btn);
                    });
                })
                .catch(err => {
                    slotsLoading.classList.add('hidden');
                    timeSlots.classList.remove('hidden');
                    timeSlots.innerHTML = '<div class="col-span-full text-center text-red-600 py-4">Gagal memuat jadwal.</div>';
                });
        }

        function toggleSlot(btn, slot) {
            if (selectedSlots.has(slot.id)) {
                selectedSlots.delete(slot.id);
                btn.classList.remove('border-2', 'border-white', 'ring-2', 'ring-primary', 'bg-primary');
                btn.classList.add('bg-green-500');
            } else {
                selectedSlots.set(slot.id, slot);
                btn.classList.remove('bg-green-500');
                btn.classList.add('border-2', 'border-white', 'ring-2', 'ring-primary', 'bg-primary');
            }
            updateSummary();
        }

        function updateSummary() {
            const count = selectedSlots.size;
            document.getElementById('summary-session-count').textContent = count;
            
            const sessionsContainer = document.getElementById('summary-sessions');
            if (count === 0) {
                sessionsContainer.innerHTML = '<p class="text-on-surface text-sm italic">Belum ada sesi dipilih</p>';
                document.getElementById('summary-subtotal').textContent = '0';
                document.getElementById('summary-fee').textContent = '0';
                document.getElementById('summary-total').textContent = '0';
                document.getElementById('btn-lanjut').disabled = true;
                document.getElementById('input-slots').value = '';
                return;
            }

            sessionsContainer.innerHTML = '';
            let slotIds = [];
            
            // Sort selected slots by start time
            let sortedSlots = Array.from(selectedSlots.values()).sort((a, b) => {
                return a.waktu_mulai.localeCompare(b.waktu_mulai);
            });

            sortedSlots.forEach(slot => {
                slotIds.push(slot.id);
                const p = document.createElement('p');
                p.className = 'text-on-surface text-sm flex justify-between';
                p.innerHTML = `<span>${slot.waktu_mulai.substring(0, 5)} - ${slot.waktu_selesai.substring(0, 5)} WIB</span> <span class="font-bold">Rp ${hargaPerJam.toLocaleString('id-ID')}</span>`;
                sessionsContainer.appendChild(p);
            });

            const subtotal = count * hargaPerJam;
            const total = subtotal + biayaLayanan;

            document.getElementById('summary-subtotal').textContent = subtotal.toLocaleString('id-ID');
            document.getElementById('summary-fee').textContent = biayaLayanan.toLocaleString('id-ID');
            document.getElementById('summary-total').textContent = total.toLocaleString('id-ID');
            document.getElementById('input-slots').value = slotIds.join(',');
            
            document.getElementById('btn-lanjut').disabled = false;
        }

        // Auto select today
        const firstDateBtn = dateSelector.querySelector('.date-btn');
        if (firstDateBtn) {
            selectDate(firstDateBtn, firstDateBtn.dataset.date);
        }
    });
</script>
@endpush
