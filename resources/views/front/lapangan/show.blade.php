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
    <div class="flex items-center gap-2 mb-6 text-on-surface-variant font-label-md">
        <a class="hover:text-primary" href="{{ route('home') }}">Beranda</a>
        <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
        <a class="hover:text-primary" href="{{ route('lapangan.index') }}">Venue</a>
        <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
        <span class="text-on-surface">Elite Badminton Center</span>
    </div>
    
    <!-- Image Gallery -->
    <section class="gallery-grid mb-gutter motion-hidden">
        @if($lapangan->gambarLapangans->count() > 0)
            <div class="row-span-2 relative overflow-hidden rounded-xl group">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('storage/' . $lapangan->gambarLapangans[0]->image_path) }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            </div>
            @if($lapangan->gambarLapangans->count() > 1)
            <div class="relative overflow-hidden rounded-xl group">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('storage/' . $lapangan->gambarLapangans[1]->image_path) }}"/>
            </div>
            @endif
            @if($lapangan->gambarLapangans->count() > 2)
            <div class="relative overflow-hidden rounded-xl group">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ asset('storage/' . $lapangan->gambarLapangans[2]->image_path) }}"/>
                <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button class="bg-surface-container-lowest text-on-surface px-4 py-2 rounded-lg font-label-md flex items-center gap-2">
                        <span class="material-symbols-outlined" data-icon="grid_view">grid_view</span>
                        Lihat semua foto
                    </button>
                </div>
            </div>
            @endif
        @else
        <div class="row-span-2 relative overflow-hidden rounded-xl group">
            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqpBhEvfDl0EYz-Gace0gou9P7Fz8VK0epdfEulBBrt60a_3uI6PmVnuKq1hKsDQ6RpTYiIzA1Do44n6D7G6tPZdYYQKXksWMQ2arzHNzsWuOSasPkS-hxzykxg_XoTW83v3aI5f-F-CK3jLmmVDF3ih-dUjIBFnbCv2bMFKVqrPfWaHxLr91Uit97LjalGAFA4r5-FKBTBQMQv8LwL9zOCCC1AUMomdHx-pwD-LbOH8NcyExW4o3fPDQTMwR5qKJ3zp99CvTablk"/>
        </div>
        @endif
    </section>
    
    <!-- Main Content & Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
        <!-- Left Column: Details & Booking -->
        <div class="lg:col-span-2 flex flex-col gap-lg motion-hidden delay-100">
            <!-- Venue Intro -->
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="font-h1 text-h1 text-on-surface">{{ $lapangan->name }}</h1>
                        <div class="flex items-center gap-4 mt-2 text-on-surface-variant">
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-yellow-500" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-bold">4.9</span>
                                <span>(128 ulasan)</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined" data-icon="location_on">location_on</span>
                                <span>{{ $lapangan->kategori->name ?? 'Olahraga' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 border border-outline-variant rounded-full hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined" data-icon="share">share</span>
                        </button>
                        <button class="p-2 border border-outline-variant rounded-full hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined" data-icon="favorite">favorite</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Description -->
            <section>
                <h2 class="font-h2 text-h2 mb-4">Deskripsi</h2>
                <p class="font-body-lg text-on-surface-variant leading-relaxed">
                    {{ $lapangan->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}
                </p>
            </section>
            <!-- Facilities -->
            <section>
                <h2 class="font-h2 text-h2 mb-4">Fasilitas</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex items-center gap-3 p-4 bg-surface-container-low rounded-xl">
                        <span class="material-symbols-outlined text-primary" data-icon="shower">shower</span>
                        <span class="font-label-md">Air Panas</span>
                    </div>
                    <div class="flex items-center gap-3 p-4 bg-surface-container-low rounded-xl">
                        <span class="material-symbols-outlined text-primary" data-icon="local_parking">local_parking</span>
                        <span class="font-label-md">Parkir Gratis</span>
                    </div>
                    <div class="flex items-center gap-3 p-4 bg-surface-container-low rounded-xl">
                        <span class="material-symbols-outlined text-primary" data-icon="ac_unit">ac_unit</span>
                        <span class="font-label-md">Full AC</span>
                    </div>
                    <div class="flex items-center gap-3 p-4 bg-surface-container-low rounded-xl">
                        <span class="material-symbols-outlined text-primary" data-icon="lock">lock</span>
                        <span class="font-label-md">Ruang Ganti</span>
                    </div>
                    <div class="flex items-center gap-3 p-4 bg-surface-container-low rounded-xl">
                        <span class="material-symbols-outlined text-primary" data-icon="sports_tennis">sports_tennis</span>
                        <span class="font-label-md">Toko Olahraga</span>
                    </div>
                    <div class="flex items-center gap-3 p-4 bg-surface-container-low rounded-xl">
                        <span class="material-symbols-outlined text-primary" data-icon="wifi">wifi</span>
                        <span class="font-label-md">Wi-Fi Gratis</span>
                    </div>
                </div>
            </section>
            <!-- Interactive Booking -->
            <section class="bg-surface-container-lowest p-gutter rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.08)] border border-outline-variant/50" id="booking-section">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-h2 text-h2">Pilih Tanggal &amp; Waktu</h2>
                    <div class="flex items-center gap-4 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-600"></div>
                            <span>Penuh/Lewat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span>Tersedia</span>
                        </div>
                    </div>
                </div>
                <!-- Simple Date Selector -->
                <div class="flex gap-4 overflow-x-auto pb-4 mb-8 no-scrollbar" id="date-selector">
                    <!-- Dates injected via JS -->
                </div>
                <!-- Time Slot Grid -->
                <div id="slots-loading" class="hidden text-center py-8">
                    <span class="material-symbols-outlined animate-spin text-primary text-4xl">autorenew</span>
                </div>
                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3" id="time-slots">
                    <div class="col-span-full text-center text-on-surface-variant py-4">Pilih tanggal untuk melihat jadwal tersedia.</div>
                </div>
            </section>
        </div>
        <!-- Right Column: Summary Card -->
        <aside class="sticky top-24">
            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 shadow-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <span class="text-h3 font-h3 text-primary">Rp <span id="summary-price">{{ number_format($lapangan->harga, 0, ',', '.') }}</span><span class="text-sm font-normal text-on-surface-variant">/jam</span></span>
                </div>
                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between font-label-md text-on-surface-variant">
                        <span>Tanggal Dipilih</span>
                        <span class="text-on-surface" id="summary-date">-</span>
                    </div>
                    <div class="flex justify-between font-label-md text-on-surface-variant">
                        <span>Sesi (<span id="summary-session-count">0</span>)</span>
                        <div class="text-right" id="summary-sessions">
                            <p class="text-on-surface text-sm italic">Belum ada sesi dipilih</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-on-surface-variant font-body-md">
                        <span>Subtotal</span>
                        <span>Rp <span id="summary-subtotal">0</span></span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant font-body-md">
                        <span>Biaya Layanan</span>
                        <span>Rp <span id="summary-fee">0</span></span>
                    </div>
                    <div class="flex justify-between font-h3 text-h3 text-on-surface pt-2">
                        <span>Total</span>
                        <span>Rp <span id="summary-total">0</span></span>
                    </div>
                </div>
                <form action="{{ route('booking.create') }}" method="GET" id="booking-form">
                    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                    <input type="hidden" name="tanggal" id="input-tanggal" value="">
                    <input type="hidden" name="slot_ids" id="input-slots" value="">
                    <button type="submit" id="btn-lanjut" disabled class="block text-center w-full bg-primary text-on-primary py-4 rounded-xl font-h3 shadow-lg transition-all hover:brightness-110 active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                        Lanjut ke Booking
                    </button>
                </form>
                <p class="text-xs text-center text-on-surface-variant px-4">
                    Dengan mengklik tombol di atas, Anda menyetujui Syarat & Ketentuan serta Kebijakan Pembatalan kami.
                </p>
            </div>
            <!-- Host Info Small -->
            <div class="mt-6 p-4 bg-surface-container-low rounded-xl flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-white font-bold">
                    A
                </div>
                <div>
                    <p class="font-label-md text-on-surface">Admin ArenaFlow</p>
                    <p class="text-xs text-on-surface-variant">Respon cepat</p>
                </div>
                <a href="{{ route('support') }}" class="ml-auto text-primary font-bold text-sm hover:underline">Hubungi</a>
            </div>
        </aside>
    </div>
</main>
@endsection

@push('scripts')
<script>
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
            
            const dateStr = d.toISOString().split('T')[0];
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
                    const isToday = dateStr === today.toISOString().split('T')[0];
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
                        btn.className = `py-3 px-2 rounded-lg font-label-md transition-all ${isUnavailable ? 'bg-red-600 text-white cursor-not-allowed opacity-80' : 'bg-green-500 text-white hover:ring-2 hover:ring-green-600'}`;
                        btn.textContent = slot.waktu_mulai.substring(0, 5);
                        
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
                p.className = 'text-on-surface text-sm';
                p.textContent = `${slot.waktu_mulai.substring(0, 5)} - ${slot.waktu_selesai.substring(0, 5)}`;
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
