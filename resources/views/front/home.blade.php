@extends('layouts.front')

@section('title', 'ArenaFlow - High-Performance Sports Booking')

@section('content')
<main class="mt-16">
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover" data-alt="Cinematic wide shot of a modern indoor futsal arena with professional bright lighting and blue synthetic turf" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSzilZ-M7p2Yi7FB70_aep_Dt2F40Ap5fT6ylV31LOpBkvmdLna8j8XW63B0viOXwcRgMExCQaTMPxCV12csOcX-a-_FU8MmRu9nZl6bFWk9WSDmpmC4HIh8ApoeNGkNbxtpVjxYElF205pBlUbr_9IEd6WRBBvBXS52snTNZTu_1v3bmKJut-XuoJ0XoX5eY8-7MPsrHFbr-mVgOMbqNGJzLI1dgIvRL8Bt7wjRqLh0452evsYmvIHgIlnKst7yuKVkRsVO5fIuE" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
            <div class="max-w-2xl">
                <span class="inline-block px-4 py-2 mb-6 rounded-full bg-primary-container text-white text-label-md tracking-wider uppercase motion-hidden">
                    Pemesanan Super Cepat
                </span>
                <h1 class="font-h1 text-h1 text-white mb-6 leading-tight motion-hidden delay-100">
                    Pesan Lapangan <br /><span class="text-primary-container">Dalam Hitungan Detik</span>
                </h1>
                <p class="font-body-lg text-body-lg text-gray-200 mb-8 max-w-lg motion-hidden delay-200">
                    Venue olahraga elit dalam genggaman. Dari lapangan futsal lokal hingga klub padel premium, amankan jadwalmu secara instan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 motion-hidden delay-300">
                    <a href="{{ route('lapangan.index') }}" class="text-center bg-primary-container hover:bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl shadow-primary-container/20 transition-all hover:scale-105 active:scale-95">
                        Booking Sekarang
                    </a>
                    <a href="{{ route('lapangan.index') }}" class="text-center bg-white/10 backdrop-blur-md border border-white/20 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/20 transition-all">
                        Eksplorasi Venue
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section (Bento Style) -->
    <section class="py-xl bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-lg motion-hidden">
                <h2 class="font-h2 text-h2 text-on-surface mb-2">Jelajahi Olahraga Populer</h2>
                <p class="text-on-surface-variant max-w-xl mx-auto">Pilih dari fasilitas unggulan yang dikurasi khusus untuk performa maksimalmu.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Futsal -->
                <div class="md:col-span-2 group relative overflow-hidden rounded-xl h-80 shadow-[0_4px_20px_rgba(211,47,47,0.08)] motion-hidden delay-100">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Professional indoor futsal court with bright lights and vibrant yellow lines on blue synthetic floor" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQKryO8uNiXViw3OXFab8nargDCPj6JXgnNwYHfPh9inLyxSQr9L1Hb15QBCzJdEhsGfTN8KHn1ypoLVQ9akGFyMnvtklzqxlfgbr3jlqdDp3rhzvvRWYFct1YI_ETe3nsm19DGspLLu4a9e7USIyTJpzLdT8jum1rwI6LMgcadt83smICEd27vAUgEJbx0sONzSRXJu0S369PjjlnKu7h0wUVfduobhm9w6bJWCQcK2hTv7t9B-ccTjTIQmbXmVHfBoc1PKUuoUo" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 p-6">
                        <span class="material-symbols-outlined text-primary-container text-4xl mb-2" data-icon="sports_soccer">sports_soccer</span>
                        <h3 class="font-h3 text-h3 text-white">Futsal</h3>
                        <p class="text-gray-300 text-sm">12 Lapangan Premium Terdekat</p>
                    </div>
                </div>
                <!-- Badminton -->
                <div class="group relative overflow-hidden rounded-xl h-80 shadow-[0_4px_20px_rgba(211,47,47,0.08)] motion-hidden delay-200">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Professional badminton court with green mat and bright overhead arena lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTGKj7ZQjqSWm8FzxyIuZBcInr-J7sY8_1R7VWlt2zeRWVQlAQP3AlLzgSRHLoXRILIoDPKekd6Jg3P9AFSk8xjy_QYm8jNhJVfc7X6kiulfLJchSeTH2Pzr3d5Gx68ej7c8LN9EnO_Wxfarg5mVPSv40MsYsHyhtfwnptdOt13Qya6AhdlTLfO7hhNYioySMzVPyiTJ8XfmmPAy5XYLXLOYAkmkrQdarfwyav9paYgkjbXDHecBofe6TOOjj4TVSi9dju4jlqcmU" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 p-6">
                        <span class="material-symbols-outlined text-primary-container text-4xl mb-2" data-icon="sports_tennis">sports_tennis</span>
                        <h3 class="font-h3 text-h3 text-white">Badminton</h3>
                        <p class="text-gray-300 text-sm">8 Klub Eksklusif</p>
                    </div>
                </div>
                <!-- Voly -->
                <div class="group relative overflow-hidden rounded-xl h-80 shadow-[0_4px_20px_rgba(211,47,47,0.08)] motion-hidden delay-300">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Indoor volleyball court with polished wooden floor and high net at sunset" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxXWR9RRlSirAa_nylPhiNEaK0t_SuXvDfiC2FyWaNCn9SQpuWRioqw1nIcjxjzRrI6rX1pn5aVIt536Be9ffPoBkAbwoSnXD4pcLZAsq1zPvr_JUhmJL3Ud_JQKqWR7HVnKL-w9ya8rXdl0WH8yMy29sFyF6AdFoondkExV2i5FVq2Ls0f88LbHhNUFocx5xW3PhQzDxHAcWxFYTc3xLps0UOuqT2pma-7tbKdtqOz713ahYulAszmqMtAmQBIf7wAapoiQxCTlk" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 p-6">
                        <span class="material-symbols-outlined text-primary-container text-4xl mb-2" data-icon="sports_volleyball">sports_volleyball</span>
                        <h3 class="font-h3 text-h3 text-white">Voly</h3>
                        <p class="text-gray-300 text-sm">5 Arena Multifungsi</p>
                    </div>
                </div>
                <!-- Padel -->
                <div class="md:col-span-4 group relative overflow-hidden rounded-xl h-64 shadow-[0_4px_20px_rgba(211,47,47,0.08)] motion-hidden delay-400">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Ultra modern outdoor padel court with blue turf and glass walls during blue hour" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4LvdktLrzAZDKdXeTGngG5x1I1zN9tQ8yUPtAqG9BEvBDkPLRdmy6siNbTreKaEZm0fjwb4xN3SiJlQnG4bkIC4LN0B-KXgapiEIRwpExbwUynRqwJVjJnjJXYXfcnGmrhk6rfrfKWvMUcsOi41nLIdn5ijuCGg8i5njlvdoweOCPHozSjn4MzuPvLSrzL5QheRx_RuDxFubijRP2PwB_TniYfSavPFQ2gcZAr5DsNfviIfILpsLjoEd8Ok9maDi1iZBSGAtZqv4" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 p-8 flex justify-between items-end w-full">
                        <div>
                            <span class="material-symbols-outlined text-primary-container text-4xl mb-2" data-icon="sports_handball">sports_handball</span>
                            <h3 class="font-h3 text-h3 text-white">Padel</h3>
                            <p class="text-gray-300 text-sm">Rasakan sensasi olahraga paling tren</p>
                        </div>
                        <a href="{{ route('lapangan.index') }}" class="bg-white text-primary-container font-bold px-6 py-2 rounded-full hover:bg-primary-container hover:text-white transition-colors">
                            Lihat Padel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-xl bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12">
                <div class="flex flex-col items-center text-center p-8 rounded-2xl hover:bg-secondary-fixed/30 transition-all border border-transparent hover:border-outline-variant motion-hidden delay-100">
                    <div class="w-16 h-16 bg-primary-container/10 flex items-center justify-center rounded-2xl mb-6">
                        <span class="material-symbols-outlined text-primary-container text-4xl" data-icon="bolt">bolt</span>
                    </div>
                    <h3 class="font-h3 text-h3 text-on-surface mb-4">Sangat Cepat</h3>
                    <p class="font-body-md text-on-surface-variant">Pembaruan ketersediaan real-time. Pesan dan konfirmasi venue favoritmu di bawah 30 detik.</p>
                </div>
                <div class="flex flex-col items-center text-center p-8 rounded-2xl hover:bg-secondary-fixed/30 transition-all border border-transparent hover:border-outline-variant motion-hidden delay-200">
                    <div class="w-16 h-16 bg-primary-container/10 flex items-center justify-center rounded-2xl mb-6">
                        <span class="material-symbols-outlined text-primary-container text-4xl" data-icon="payments">payments</span>
                    </div>
                    <h3 class="font-h3 text-h3 text-on-surface mb-4">Pembayaran Mulus</h3>
                    <p class="font-body-md text-on-surface-variant">Berbagai opsi pembayaran aman dari E-wallet hingga transfer bank instan tanpa ribet.</p>
                </div>
                <div class="flex flex-col items-center text-center p-8 rounded-2xl hover:bg-secondary-fixed/30 transition-all border border-transparent hover:border-outline-variant motion-hidden delay-300">
                    <div class="w-16 h-16 bg-primary-container/10 flex items-center justify-center rounded-2xl mb-6">
                        <span class="material-symbols-outlined text-primary-container text-4xl" data-icon="schedule">schedule</span>
                    </div>
                    <h3 class="font-h3 text-h3 text-on-surface mb-4">Tersedia 24/7</h3>
                    <p class="font-body-md text-on-surface-variant">Sistem kami tak pernah tidur. Pesan kapan saja, di mana saja, dari sesi pagi buta hingga larut malam.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter / CTA Section -->
    <section class="py-xl bg-primary-container overflow-hidden relative">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-white/5 skew-x-12 transform translate-x-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="max-w-xl motion-hidden slide-right">
                <h2 class="font-h2 text-h2 text-white mb-4">Siap untuk pertandingan terbaikmu?</h2>
                <p class="text-white/80 font-body-lg">Bergabung dengan 10.000+ atlet yang memesan lapangan melalui ArenaFlow setiap minggunya.</p>
            </div>
            <div class="flex w-full md:w-auto gap-4 motion-hidden delay-200">
                <a href="{{ route('admin.login') }}" class="text-center bg-white text-primary-container px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-all flex-1 md:flex-none">
                    Daftar Sekarang
                </a>
                <a href="{{ route('lapangan.index') }}" class="text-center border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white/10 transition-all flex-1 md:flex-none">
                    Cek Lokasi
                </a>
            </div>
        </div>
    </section>
</main>
@endsection