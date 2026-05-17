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
        <div class="row-span-2 relative overflow-hidden rounded-xl group">
            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="ultra-modern indoor badminton court with bright professional lighting and polished wood flooring in a high-performance athletic facility" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqpBhEvfDl0EYz-Gace0gou9P7Fz8VK0epdfEulBBrt60a_3uI6PmVnuKq1hKsDQ6RpTYiIzA1Do44n6D7G6tPZdYYQKXksWMQ2arzHNzsWuOSasPkS-hxzykxg_XoTW83v3aI5f-F-CK3jLmmVDF3ih-dUjIBFnbCv2bMFKVqrPfWaHxLr91Uit97LjalGAFA4r5-FKBTBQMQv8LwL9zOCCC1AUMomdHx-pwD-LbOH8NcyExW4o3fPDQTMwR5qKJ3zp99CvTablk"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>
        <div class="relative overflow-hidden rounded-xl group">
            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="close-up of professional badminton nets and equipment in a bright sports hall with high ceilings" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXqwdOdMsl8tLv7g7Q1wPVnhxRmyS43aV7RLjTDx5CiIsshFOWr2sR5vbA3qXsD51t68Ik7y7-9T81c-UvuQbJQP9kXv-ci8xcyrP8OdsM-efiM1WNUGej0noHD4tV4b5hQGEeoZeZR-XlCIzUsFA7ybzwBVpmb3TpcphZY19kVnUrZopIDHtC4tHFNOSH6aQCEW8ai7hyJliT8G-UDXiu_kNDLkFbW8k2RnIOwcSxLXNFqIc2H9LAtitljXf_nBr1A1-pCAIebfE"/>
        </div>
        <div class="relative overflow-hidden rounded-xl group">
            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="view of spectator seating area and modern lounge within a premium sports arena" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCGCfD1zD6A7MVyLruXUiX08IYRywO9zU92eiJ63FxEfmFnirlu9wcJa9cESFJN75cZbI8XkhrEU3xXbWWnyEg4tmYr8I-vOmbkEiGw847CBV6jMHMiVMcDn2aPI0GIJGawi0AFT6NJI4SGjFdFWixC8fryuuRNxCd1VT4ohgiLoYhFuakYVyESospG5hbXZFplnJppGSr55sn7AMlmtwAdk8dh0wIVgPfa-ZlOR9BSjNZnY3-Ufe-yioXaakdJnoa2sfcdX6e7A-k"/>
            <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity">
                <button class="bg-white text-on-surface px-4 py-2 rounded-lg font-label-md flex items-center gap-2">
                    <span class="material-symbols-outlined" data-icon="grid_view">grid_view</span>
                    Lihat semua foto
                </button>
            </div>
        </div>
    </section>
    
    <!-- Main Content & Sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-start">
        <!-- Left Column: Details & Booking -->
        <div class="lg:col-span-2 flex flex-col gap-lg motion-hidden delay-100">
            <!-- Venue Intro -->
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="font-h1 text-h1 text-on-surface">Elite Badminton Center</h1>
                        <div class="flex items-center gap-4 mt-2 text-on-surface-variant">
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-yellow-500" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-bold">4.9</span>
                                <span>(128 ulasan)</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined" data-icon="location_on">location_on</span>
                                <span>Jakarta Selatan, ID</span>
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
                    Rasakan fasilitas badminton kelas dunia di Elite Badminton Center. Venue kami dilengkapi 12 lapangan berstandar internasional dengan lantai vinyl berdaya cengkeram tinggi dan pencahayaan stadion LED anti-silau. Dirancang khusus untuk atlet maupun penggemar olahraga yang ingin performa maksimal, kami juga menyediakan sistem sirkulasi udara terbaik untuk menjaga stamina Anda.
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
            <section class="bg-white p-gutter rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.08)] border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-h2 text-h2">Pilih Tanggal &amp; Waktu</h2>
                    <div class="flex items-center gap-4 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-600"></div>
                            <span>Dipesan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span>Tersedia</span>
                        </div>
                    </div>
                </div>
                <!-- Simple Date Selector -->
                <div class="flex gap-4 overflow-x-auto pb-4 mb-8 no-scrollbar">
                    <button class="flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-primary text-white shadow-lg">
                        <span class="text-xs uppercase font-bold">Sen</span>
                        <span class="text-xl font-black">20</span>
                    </button>
                    <button class="flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-surface-container-low hover:bg-secondary-container transition-colors">
                        <span class="text-xs uppercase font-bold text-on-surface-variant">Sel</span>
                        <span class="text-xl font-black">21</span>
                    </button>
                    <button class="flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-surface-container-low hover:bg-secondary-container transition-colors">
                        <span class="text-xs uppercase font-bold text-on-surface-variant">Rab</span>
                        <span class="text-xl font-black">22</span>
                    </button>
                    <button class="flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-surface-container-low hover:bg-secondary-container transition-colors">
                        <span class="text-xs uppercase font-bold text-on-surface-variant">Kam</span>
                        <span class="text-xl font-black">23</span>
                    </button>
                    <button class="flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-surface-container-low hover:bg-secondary-container transition-colors">
                        <span class="text-xs uppercase font-bold text-on-surface-variant">Jum</span>
                        <span class="text-xl font-black">24</span>
                    </button>
                    <button class="flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-surface-container-low hover:bg-secondary-container transition-colors">
                        <span class="text-xs uppercase font-bold text-on-surface-variant">Sab</span>
                        <span class="text-xl font-black">25</span>
                    </button>
                    <button class="flex flex-col items-center min-w-[70px] p-3 rounded-xl bg-surface-container-low hover:bg-secondary-container transition-colors">
                        <span class="text-xs uppercase font-bold text-on-surface-variant">Min</span>
                        <span class="text-xl font-black">26</span>
                    </button>
                </div>
                <!-- Time Slot Grid -->
                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                    <!-- Morning -->
                    <button class="py-3 px-2 rounded-lg bg-red-600 text-white font-label-md cursor-not-allowed opacity-80">08:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">09:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">10:00</button>
                    <button class="py-3 px-2 rounded-lg bg-red-600 text-white font-label-md cursor-not-allowed opacity-80">11:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">12:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">13:00</button>
                    <!-- Afternoon -->
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">14:00</button>
                    <button class="py-3 px-2 rounded-lg border-2 border-primary bg-primary-container text-white font-label-md">15:00</button>
                    <button class="py-3 px-2 rounded-lg border-2 border-primary bg-primary-container text-white font-label-md">16:00</button>
                    <button class="py-3 px-2 rounded-lg bg-red-600 text-white font-label-md cursor-not-allowed opacity-80">17:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">18:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">19:00</button>
                    <!-- Evening -->
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">20:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">21:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">22:00</button>
                    <button class="py-3 px-2 rounded-lg bg-green-500 text-white font-label-md hover:ring-2 hover:ring-green-600 transition-all">23:00</button>
                </div>
            </section>
        </div>
        <!-- Right Column: Summary Card -->
        <aside class="sticky top-24">
            <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-xl flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <span class="text-h3 font-h3 text-primary">Rp 120.000<span class="text-sm font-normal text-on-surface-variant">/jam</span></span>
                </div>
                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between font-label-md text-on-surface-variant">
                        <span>Tanggal Dipilih</span>
                        <span class="text-on-surface">20 Mei 2024</span>
                    </div>
                    <div class="flex justify-between font-label-md text-on-surface-variant">
                        <span>Sesi (2)</span>
                        <div class="text-right">
                            <p class="text-on-surface">15:00 - 16:00</p>
                            <p class="text-on-surface">16:00 - 17:00</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-on-surface-variant font-body-md">
                        <span>Subtotal</span>
                        <span>Rp 240.000</span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant font-body-md">
                        <span>Biaya Layanan</span>
                        <span>Rp 5.000</span>
                    </div>
                    <div class="flex justify-between font-h3 text-h3 text-on-surface pt-2">
                        <span>Total</span>
                        <span>Rp 245.000</span>
                    </div>
                </div>
                <a href="{{ route('booking.create') }}" class="block text-center w-full bg-primary text-on-primary py-4 rounded-xl font-h3 shadow-lg transition-all hover:brightness-110 active:scale-[0.98]">
                    Lanjut ke Booking
                </a>
                <p class="text-xs text-center text-on-surface-variant px-4">
                    Dengan mengklik tombol di atas, Anda menyetujui Syarat & Ketentuan serta Kebijakan Pembatalan kami.
                </p>
            </div>
            <!-- Host Info Small -->
            <div class="mt-6 p-4 bg-surface-container-low rounded-xl flex items-center gap-4">
                <img class="w-12 h-12 rounded-full object-cover" data-alt="professional sports facility manager headshot with friendly expression" src="https://lh3.googleusercontent.com/aida-public/AB6AXuApk_uo1vhB6iTb20CjZv4emmd4PfRoL-T4fvGf_1NxOjA7MjdiGjc8kFwpB3dmxulLmwD394Lhiogtgbj6oik23LgZ5t9rml1JNOnj1b6Uj1msj062UnQOGoT7riaUKfKLe6JT_5avEVVcnvh6VxK-V6DMnLKj643T92RNUBuL6hIYEgYLCXtP_d3S3kiwWGTjIHFZE7XvFZ-7bdJolOnLmpTVVb15SYWTdCShI3u2gIhcuKdkfsfDU1YXMgB50ZgbKbknOLFwXyQ"/>
                <div>
                    <p class="font-label-md text-on-surface">Elite Center Management</p>
                    <p class="text-xs text-on-surface-variant">Membalas dalam 5 menit</p>
                </div>
                <button class="ml-auto text-primary font-bold text-sm">Hubungi</button>
            </div>
        </aside>
    </div>
</main>
@endsection
