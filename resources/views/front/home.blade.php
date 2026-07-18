@extends('layouts.front')

@section('title', 'ArenaFlow - High-Performance Sports Booking')

@section('content')
<main class="mt-16">
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover scale-105 animate-[pulse_10s_ease-in-out_infinite]" data-alt="Cinematic wide shot of a modern indoor futsal arena with professional bright lighting and blue synthetic turf" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSzilZ-M7p2Yi7FB70_aep_Dt2F40Ap5fT6ylV31LOpBkvmdLna8j8XW63B0viOXwcRgMExCQaTMPxCV12csOcX-a-_FU8MmRu9nZl6bFWk9WSDmpmC4HIh8ApoeNGkNbxtpVjxYElF205pBlUbr_9IEd6WRBBvBXS52snTNZTu_1v3bmKJut-XuoJ0XoX5eY8-7MPsrHFbr-mVgOMbqNGJzLI1dgIvRL8Bt7wjRqLh0452evsYmvIHgIlnKst7yuKVkRsVO5fIuE" />
            <div class="absolute inset-0 bg-gradient-to-r from-gray-950 via-gray-900/80 to-transparent"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-red-900/40 via-transparent to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 rounded-full bg-red-600/20 border border-red-500/30 text-red-400 font-bold text-xs tracking-widest uppercase motion-hidden backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                    Pemesanan Super Cepat
                </div>
                <h1 class="text-5xl md:text-7xl font-black font-['Lexend'] text-white mb-6 leading-[1.1] motion-hidden delay-100 uppercase tracking-tight">
                    Pesan Lapangan <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-300">Dalam Hitungan Detik</span>
                </h1>
                <p class="text-lg md:text-xl font-medium text-gray-300 mb-10 max-w-xl motion-hidden delay-200 border-l-4 border-red-500 pl-4">
                    Venue olahraga elit dalam genggaman. Dari lapangan futsal lokal hingga klub padel premium, amankan jadwalmu secara instan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 motion-hidden delay-300">
                    <a href="{{ route('lapangan.index') }}" class="group relative overflow-hidden text-center bg-red-600 text-white px-8 py-4 rounded-xl font-black text-lg shadow-[0_0_20px_rgba(220,38,38,0.4)] transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <span class="relative z-10">Booking Sekarang</span>
                        <span class="material-symbols-outlined relative z-10 transition-transform group-hover:translate-x-1" style="font-variation-settings: 'FILL' 1;">arrow_forward</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-red-700 to-red-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                    <a href="{{ route('lapangan.index') }}" class="text-center bg-white/5 backdrop-blur-md border border-white/10 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 hover:border-white/20 transition-all flex items-center justify-center gap-2 group">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-white transition-colors">travel_explore</span>
                        Eksplorasi Venue
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative Sports Elements -->
        <div class="absolute bottom-0 right-0 p-8 hidden lg:block motion-hidden delay-500">
            <div class="flex gap-4 opacity-30">
                <span class="material-symbols-outlined text-[120px] text-white">sports_soccer</span>
                <span class="material-symbols-outlined text-[120px] text-white -mt-12">sports_tennis</span>
            </div>
        </div>
    </section>

    <!-- Categories Section (Bento Style) -->
    <section class="py-20 bg-gray-50 dark:bg-gray-950 transition-colors duration-300 relative overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-red-600/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 motion-hidden flex flex-col items-center">
                <span class="text-red-600 dark:text-red-500 font-bold tracking-widest uppercase text-sm mb-3 block">Fasilitas Premium</span>
                <h2 class="text-4xl md:text-5xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-4 uppercase tracking-tight">Jelajahi <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-400">Kategori</span></h2>
                <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto font-medium">Pilih dari fasilitas unggulan yang dikurasi khusus untuk performa maksimalmu.</p>
                <div class="w-24 h-1 bg-red-600 rounded-full mt-6"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Futsal -->
                <div class="md:col-span-2 group relative overflow-hidden rounded-3xl h-[340px] shadow-xl shadow-gray-200/50 dark:shadow-black/40 border border-gray-100 dark:border-gray-800 motion-hidden delay-100">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Professional indoor futsal court with bright lights and vibrant yellow lines on blue synthetic floor" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQKryO8uNiXViw3OXFab8nargDCPj6JXgnNwYHfPh9inLyxSQr9L1Hb15QBCzJdEhsGfTN8KHn1ypoLVQ9akGFyMnvtklzqxlfgbr3jlqdDp3rhzvvRWYFct1YI_ETe3nsm19DGspLLu4a9e7USIyTJpzLdT8jum1rwI6LMgcadt83smICEd27vAUgEJbx0sONzSRXJu0S369PjjlnKu7h0wUVfduobhm9w6bJWCQcK2hTv7t9B-ccTjTIQmbXmVHfBoc1PKUuoUo" />
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-0 p-8 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform">
                        <div class="w-14 h-14 bg-red-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-red-600/30">
                            <span class="material-symbols-outlined text-white text-[28px]" data-icon="sports_soccer">sports_soccer</span>
                        </div>
                        <h3 class="text-3xl font-black font-['Lexend'] text-white mb-1 uppercase tracking-wider">Futsal</h3>
                        <p class="text-gray-300 font-medium">12 Lapangan Premium Terdekat</p>
                    </div>
                </div>
                
                <!-- Badminton -->
                <div class="group relative overflow-hidden rounded-3xl h-[340px] shadow-xl shadow-gray-200/50 dark:shadow-black/40 border border-gray-100 dark:border-gray-800 motion-hidden delay-200">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Professional badminton court with green mat and bright overhead arena lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTGKj7ZQjqSWm8FzxyIuZBcInr-J7sY8_1R7VWlt2zeRWVQlAQP3AlLzgSRHLoXRILIoDPKekd6Jg3P9AFSk8xjy_QYm8jNhJVfc7X6kiulfLJchSeTH2Pzr3d5Gx68ej7c8LN9EnO_Wxfarg5mVPSv40MsYsHyhtfwnptdOt13Qya6AhdlTLfO7hhNYioySMzVPyiTJ8XfmmPAy5XYLXLOYAkmkrQdarfwyav9paYgkjbXDHecBofe6TOOjj4TVSi9dju4jlqcmU" />
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-0 p-8 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform">
                        <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center mb-4 border border-white/20 group-hover:bg-red-600 group-hover:border-transparent transition-all">
                            <span class="material-symbols-outlined text-white text-[24px]" data-icon="sports_tennis">sports_tennis</span>
                        </div>
                        <h3 class="text-2xl font-black font-['Lexend'] text-white mb-1 uppercase tracking-wider">Badminton</h3>
                        <p class="text-gray-300 text-sm font-medium">8 Klub Eksklusif</p>
                    </div>
                </div>
                
                <!-- Voly -->
                <div class="group relative overflow-hidden rounded-3xl h-[340px] shadow-xl shadow-gray-200/50 dark:shadow-black/40 border border-gray-100 dark:border-gray-800 motion-hidden delay-300">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Indoor volleyball court with polished wooden floor and high net at sunset" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxXWR9RRlSirAa_nylPhiNEaK0t_SuXvDfiC2FyWaNCn9SQpuWRioqw1nIcjxjzRrI6rX1pn5aVIt536Be9ffPoBkAbwoSnXD4pcLZAsq1zPvr_JUhmJL3Ud_JQKqWR7HVnKL-w9ya8rXdl0WH8yMy29sFyF6AdFoondkExV2i5FVq2Ls0f88LbHhNUFocx5xW3PhQzDxHAcWxFYTc3xLps0UOuqT2pma-7tbKdtqOz713ahYulAszmqMtAmQBIf7wAapoiQxCTlk" />
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-0 p-8 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform">
                        <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center mb-4 border border-white/20 group-hover:bg-red-600 group-hover:border-transparent transition-all">
                            <span class="material-symbols-outlined text-white text-[24px]" data-icon="sports_volleyball">sports_volleyball</span>
                        </div>
                        <h3 class="text-2xl font-black font-['Lexend'] text-white mb-1 uppercase tracking-wider">Voly</h3>
                        <p class="text-gray-300 text-sm font-medium">5 Arena Multifungsi</p>
                    </div>
                </div>
                
                <!-- Padel -->
                <div class="md:col-span-4 group relative overflow-hidden rounded-3xl h-72 shadow-xl shadow-gray-200/50 dark:shadow-black/40 border border-gray-100 dark:border-gray-800 motion-hidden delay-400">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Ultra modern outdoor padel court with blue turf and glass walls during blue hour" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4LvdktLrzAZDKdXeTGngG5x1I1zN9tQ8yUPtAqG9BEvBDkPLRdmy6siNbTreKaEZm0fjwb4xN3SiJlQnG4bkIC4LN0B-KXgapiEIRwpExbwUynRqwJVjJnjJXYXfcnGmrhk6rfrfKWvMUcsOi41nLIdn5ijuCGg8i5njlvdoweOCPHozSjn4MzuPvLSrzL5QheRx_RuDxFubijRP2PwB_TniYfSavPFQ2gcZAr5DsNfviIfILpsLjoEd8Ok9maDi1iZBSGAtZqv4" />
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/60 to-transparent"></div>
                    <div class="absolute inset-0 p-8 md:p-12 flex flex-col md:flex-row justify-between items-start md:items-end w-full h-full">
                        <div class="max-w-md">
                            <div class="inline-flex items-center gap-2 bg-red-600/20 text-red-400 border border-red-500/30 px-3 py-1 rounded-full text-xs font-bold tracking-widest uppercase mb-4 backdrop-blur-md">
                                <span class="material-symbols-outlined text-[16px]">trending_up</span> Tren Baru
                            </div>
                            <h3 class="text-4xl md:text-5xl font-black font-['Lexend'] text-white mb-2 uppercase tracking-tight">Padel Tennis</h3>
                            <p class="text-gray-300 font-medium text-lg">Rasakan sensasi olahraga paling tren tahun ini dengan lapangan berstandar internasional.</p>
                        </div>
                        <a href="{{ route('lapangan.index') }}" class="mt-6 md:mt-0 bg-white text-gray-900 font-black px-8 py-4 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-lg active:scale-95 flex items-center gap-2 group-hover:shadow-red-600/20 uppercase tracking-wider text-sm">
                            Eksplor Padel
                            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 motion-hidden">
                <span class="text-red-600 dark:text-red-500 font-bold tracking-widest uppercase text-sm mb-3 block">Keunggulan Kami</span>
                <h2 class="text-4xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-4 uppercase">Kenapa Memilih <span class="text-red-600">ArenaFlow?</span></h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8 md:gap-12">
                <div class="flex flex-col items-center text-center p-8 rounded-3xl bg-gray-50 dark:bg-gray-800/50 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all border border-gray-100 dark:border-gray-800 hover:border-red-200 dark:hover:border-red-900/50 motion-hidden delay-100 group">
                    <div class="w-20 h-20 bg-white dark:bg-gray-800 flex items-center justify-center rounded-2xl mb-6 shadow-md shadow-gray-200/50 dark:shadow-none group-hover:bg-red-600 group-hover:text-white transition-colors border border-gray-100 dark:border-gray-700">
                        <span class="material-symbols-outlined text-red-600 dark:text-red-500 group-hover:text-white text-[40px] transition-colors" style="font-variation-settings: 'FILL' 1;">bolt</span>
                    </div>
                    <h3 class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-3 uppercase tracking-wider">Instant Booking</h3>
                    <p class="text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Konfirmasi real-time tanpa menunggu. Jadwalmu langsung diamankan saat pembayaran selesai.</p>
                </div>
                <div class="flex flex-col items-center text-center p-8 rounded-3xl bg-gray-50 dark:bg-gray-800/50 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all border border-gray-100 dark:border-gray-800 hover:border-red-200 dark:hover:border-red-900/50 motion-hidden delay-200 group">
                    <div class="w-20 h-20 bg-white dark:bg-gray-800 flex items-center justify-center rounded-2xl mb-6 shadow-md shadow-gray-200/50 dark:shadow-none group-hover:bg-red-600 group-hover:text-white transition-colors border border-gray-100 dark:border-gray-700">
                        <span class="material-symbols-outlined text-red-600 dark:text-red-500 group-hover:text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                    </div>
                    <h3 class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-3 uppercase tracking-wider">Verified Venues</h3>
                    <p class="text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Setiap fasilitas telah melewati inspeksi standar tinggi untuk kualitas lantai, pencahayaan, dan fasilitas pendukung.</p>
                </div>
                <div class="flex flex-col items-center text-center p-8 rounded-3xl bg-gray-50 dark:bg-gray-800/50 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all border border-gray-100 dark:border-gray-800 hover:border-red-200 dark:hover:border-red-900/50 motion-hidden delay-300 group">
                    <div class="w-20 h-20 bg-white dark:bg-gray-800 flex items-center justify-center rounded-2xl mb-6 shadow-md shadow-gray-200/50 dark:shadow-none group-hover:bg-red-600 group-hover:text-white transition-colors border border-gray-100 dark:border-gray-700">
                        <span class="material-symbols-outlined text-red-600 dark:text-red-500 group-hover:text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">support_agent</span>
                    </div>
                    <h3 class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-3 uppercase tracking-wider">24/7 Support</h3>
                    <p class="text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Tim dedikasi siap membantumu kapan saja, dari pembatalan mendadak hingga permintaan khusus lapangan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter / CTA Section -->
    <section class="py-24 bg-gray-950 transition-colors duration-300 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-full bg-gradient-to-b from-red-600/20 to-transparent blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdib3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnPmZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDM0djIwaDItMjBWMzRoLTJWMTRoMjBWMGgydjE0aDIwVjM0SDM2em0tMi0yaC0ydi0ySDMydjItMnYtMmgtMnYyaC0ydjJoLTJ2LTJoLTJ2MmgtMnYtMmgtMnYyaC0ydjJoLTIyVjM2aDJWMTRoMjBoLThWMGgtMnYtMmgtdjJoLTh2LThoLTJ2OGgtMnYtOGgtMnY4aC0ydi04aC0ydjhIMTRWNmgxOHY4aDJWMTBoMTJ2MTRoOHYxMEgyMnYtMmgxOHYtMmgtMjh2MmgyOHYyaDJWMzJoMnYtMmgydjJoMmgtOHYyaDh2LTJoOHYxMmgtMTJ2LTJoMTR2MmgtMTR2LTJoLTFWMjRoMnYtMmgtMnYtMmgydi0yaDJ2MmgyVjIyaDJ2Mmg4djJoMnYyaDJ2LTJoMmgydi0yaDJ2MmgxOHYtMmgydi0yaHptLTIgMmgtdjJoLTJ2LTJoLTh2LTJoOHYyaHptLTIgMmgtMnYyaC0ydjJoLTJ2MkgwdjRoMjB2MjBoMTJWMzhoLTh2LTJoOHYtMmgtdjJoLTJ2MnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-10"></div>
        </div>
        <div class="max-w-4xl mx-auto px-6 text-center motion-hidden relative z-10">
            <span class="inline-block px-4 py-1.5 rounded-full bg-red-600/20 border border-red-500/30 text-red-400 font-bold text-xs tracking-widest uppercase mb-6">Mulai Sekarang</span>
            <h2 class="text-4xl md:text-6xl font-black font-['Lexend'] text-white mb-6 uppercase tracking-tight">Siap Untuk <span class="text-red-500">Berkeringat?</span></h2>
            <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto font-medium">Bergabung dengan ribuan atlet amatir dan profesional yang mempercayakan jadwal olahraga mereka pada ArenaFlow.</p>
            <a href="{{ route('lapangan.index') }}" class="inline-flex items-center gap-3 bg-red-600 text-white px-10 py-5 rounded-2xl font-black text-lg hover:bg-red-500 transition-all active:scale-95 shadow-[0_0_30px_rgba(220,38,38,0.3)] hover:shadow-[0_0_40px_rgba(220,38,38,0.5)] uppercase tracking-wider group">
                Cari Lapangan Terdekat
                <span class="material-symbols-outlined transition-transform group-hover:translate-x-2 text-[24px]">arrow_forward</span>
            </a>
        </div>
    </section>
</main>
@endsection
