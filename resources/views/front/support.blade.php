@extends('layouts.front')

@section('title', 'Pusat Bantuan - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 max-w-7xl mx-auto px-6">
    <!-- Hero / Search Section -->
    <section class="mb-16 motion-hidden text-center max-w-3xl mx-auto pt-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-red-600 rounded-3xl mb-8 shadow-lg shadow-red-600/30 transform rotate-3 hover:rotate-0 transition-transform">
            <span class="material-symbols-outlined text-white text-5xl">support_agent</span>
        </div>
        <h1 class="text-5xl md:text-6xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-6 tracking-tight">Pusat <span class="text-red-600">Bantuan</span></h1>
        <p class="text-xl text-gray-500 dark:text-gray-400 mb-10 font-medium max-w-2xl mx-auto">Temukan jawaban untuk semua pertanyaan Anda seputar ArenaFlow, dari cara pemesanan hingga informasi pembayaran.</p>
        
        <div class="relative w-full max-w-2xl mx-auto group">
            <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-red-400 rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative bg-white dark:bg-gray-900 shadow-xl shadow-gray-200/50 dark:shadow-black/50 rounded-[2rem] flex items-center p-2 border border-gray-100 dark:border-gray-800">
                <span class="material-symbols-outlined text-gray-400 text-3xl ml-4">search</span>
                <input class="w-full bg-transparent py-4 px-4 border-none outline-none focus:outline-none focus:ring-0 text-lg text-gray-900 dark:text-white placeholder-gray-400" placeholder="Cari artikel bantuan (mis. 'cara ganti jadwal')..." type="text"/>
                <button class="bg-red-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-red-700 transition-colors active:scale-95 shadow-md shadow-red-600/20 whitespace-nowrap">Cari</button>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="mb-24 motion-hidden delay-100">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black font-['Lexend'] text-gray-900 dark:text-white uppercase tracking-tight">Jelajahi Topik</h2>
            <div class="w-16 h-1 bg-red-600 rounded-full mx-auto mt-4"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="#" class="bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-8 rounded-3xl hover:border-red-300 dark:hover:border-red-800 hover:shadow-xl hover:shadow-red-900/5 transition-all group flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:border-red-600 transition-colors">
                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-white text-[32px] transition-colors">account_circle</span>
                </div>
                <h3 class="text-xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-3 group-hover:text-red-600 transition-colors">Akun & Profil</h3>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Cara mendaftar, lupa password, dan mengatur preferensi Anda.</p>
            </a>
            
            <a href="#" class="bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-8 rounded-3xl hover:border-red-300 dark:hover:border-red-800 hover:shadow-xl hover:shadow-red-900/5 transition-all group flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:border-red-600 transition-colors">
                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-white text-[32px] transition-colors">calendar_month</span>
                </div>
                <h3 class="text-xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-3 group-hover:text-red-600 transition-colors">Booking & Jadwal</h3>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Panduan cara memesan, mengubah, atau membatalkan pesanan.</p>
            </a>

            <a href="#" class="bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-8 rounded-3xl hover:border-red-300 dark:hover:border-red-800 hover:shadow-xl hover:shadow-red-900/5 transition-all group flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:border-red-600 transition-colors">
                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-white text-[32px] transition-colors">payments</span>
                </div>
                <h3 class="text-xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-3 group-hover:text-red-600 transition-colors">Pembayaran</h3>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Informasi e-wallet, transfer bank, pengembalian dana, dan promo.</p>
            </a>

            <a href="#" class="bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-8 rounded-3xl hover:border-red-300 dark:hover:border-red-800 hover:shadow-xl hover:shadow-red-900/5 transition-all group flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:border-red-600 transition-colors">
                    <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-white text-[32px] transition-colors">sports_gymnastics</span>
                </div>
                <h3 class="text-xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-3 group-hover:text-red-600 transition-colors">Fasilitas</h3>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Aturan tempat, standar lapangan, dan keluhan terkait venue.</p>
            </a>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="mb-24 motion-hidden delay-200">
        <h2 class="text-3xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-8">Pertanyaan Umum (FAQ)</h2>
        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl shadow-gray-200/40 dark:shadow-black/20 border border-gray-100 dark:border-gray-800 divide-y divide-gray-100 dark:divide-gray-800 overflow-hidden">
            <!-- FAQ Item 1 -->
            <details class="group" open>
                <summary class="flex justify-between items-center font-bold text-lg text-gray-900 dark:text-white cursor-pointer list-none p-6 md:p-8 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <span>Bagaimana cara membatalkan pesanan yang sudah dibayar?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-gray-100 dark:bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-gray-500">expand_more</span>
                    </span>
                </summary>
                <div class="text-gray-500 dark:text-gray-400 font-medium mt-0 px-6 md:px-8 pb-8 animate-fade-up border-l-4 border-red-600 ml-6 md:ml-8 mb-4 bg-gray-50/50 dark:bg-gray-800/20 py-4 rounded-r-2xl">
                    <p>Pemesanan dapat dibatalkan melalui menu <strong class="text-gray-700 dark:text-gray-300">Riwayat Pesanan</strong> di profil Anda. Pembatalan yang dilakukan maksimal H-1 sebelum waktu bermain akan menerima pengembalian dana (refund) sebesar 80% ke saldo dompet Anda. Pembatalan di hari H tidak mendapatkan pengembalian dana.</p>
                </div>
            </details>
            <!-- FAQ Item 2 -->
            <details class="group">
                <summary class="flex justify-between items-center font-bold text-lg text-gray-900 dark:text-white cursor-pointer list-none p-6 md:p-8 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <span>Apakah saya bisa membayar langsung di lokasi venue?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-gray-100 dark:bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-gray-500">expand_more</span>
                    </span>
                </summary>
                <div class="text-gray-500 dark:text-gray-400 font-medium mt-0 px-6 md:px-8 pb-8 animate-fade-up border-l-4 border-red-600 ml-6 md:ml-8 mb-4 bg-gray-50/50 dark:bg-gray-800/20 py-4 rounded-r-2xl">
                    <p>Saat ini ArenaFlow mewajibkan seluruh pembayaran dilakukan secara online untuk menjamin ketersediaan lapangan. Kami menerima beragam metode seperti Transfer Bank, QRIS, GoPay, OVO, dan ShopeePay.</p>
                </div>
            </details>
            <!-- FAQ Item 3 -->
            <details class="group">
                <summary class="flex justify-between items-center font-bold text-lg text-gray-900 dark:text-white cursor-pointer list-none p-6 md:p-8 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <span>Bagaimana jika lapangan ternyata digunakan oleh pihak lain saat saya datang?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-gray-100 dark:bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-gray-500">expand_more</span>
                    </span>
                </summary>
                <div class="text-gray-500 dark:text-gray-400 font-medium mt-0 px-6 md:px-8 pb-8 animate-fade-up border-l-4 border-red-600 ml-6 md:ml-8 mb-4 bg-gray-50/50 dark:bg-gray-800/20 py-4 rounded-r-2xl">
                    <p>Setiap transaksi di ArenaFlow bersifat mengikat. Tunjukkan ID Pesanan Anda (di menu Riwayat) kepada pengelola venue. Jika terjadi <em>double-booking</em> karena kesalahan pengelola, Anda berhak mendapatkan <em>refund</em> 100% dan <em>voucher</em> kompensasi. Segera hubungi tim Customer Service kami jika Anda mengalami ini.</p>
                </div>
            </details>
            <!-- FAQ Item 4 -->
            <details class="group">
                <summary class="flex justify-between items-center font-bold text-lg text-gray-900 dark:text-white cursor-pointer list-none p-6 md:p-8 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <span>Apakah harga sewa lapangan di aplikasi lebih mahal?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-gray-100 dark:bg-gray-800 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-gray-500">expand_more</span>
                    </span>
                </summary>
                <div class="text-gray-500 dark:text-gray-400 font-medium mt-0 px-6 md:px-8 pb-8 animate-fade-up border-l-4 border-red-600 ml-6 md:ml-8 mb-4 bg-gray-50/50 dark:bg-gray-800/20 py-4 rounded-r-2xl">
                    <p>Tidak. Harga yang tertera di aplikasi adalah harga resmi (termasuk pajak) yang telah disepakati oleh mitra venue kami. Anda tidak akan dikenakan biaya tambahan saat tiba di lokasi, kecuali untuk layanan ekstra seperti sewa raket atau beli minuman.</p>
                </div>
            </details>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="motion-hidden delay-300">
        <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-[2.5rem] p-8 md:p-14 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-10 shadow-2xl shadow-red-900/30">
            <!-- Background Decorative Elements -->
            <div class="absolute -top-32 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-black/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 max-w-xl text-center md:text-left text-white">
                <span class="inline-block px-3 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/20 text-xs font-bold tracking-widest uppercase mb-4">Tim Siaga 24/7</span>
                <h2 class="text-4xl md:text-5xl font-black font-['Lexend'] mb-4 tracking-tight">Masih Butuh <span class="text-red-200">Bantuan?</span></h2>
                <p class="text-lg text-red-100 mb-8 font-medium">Tim dukungan profesional kami siap menyelesaikan masalah Anda. Respon cepat, solusi akurat.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="https://wa.me/6281234567890" target="_blank" class="bg-white text-red-600 px-8 py-4 rounded-xl font-black text-lg flex items-center justify-center gap-3 hover:bg-gray-100 transition-colors shadow-lg active:scale-95">
                        <span class="material-symbols-outlined text-[24px]">chat</span>
                        Chat WhatsApp
                    </a>
                    <a href="mailto:support@arenaflow.id" class="bg-transparent border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-3 hover:bg-white/10 transition-colors active:scale-95">
                        <span class="material-symbols-outlined text-[24px]">mail</span>
                        Email Kami
                    </a>
                </div>
            </div>
            
            <div class="relative z-10 hidden md:block shrink-0">
                <div class="absolute inset-0 bg-white rounded-full blur-2xl opacity-20 animate-pulse"></div>
                <div class="w-56 h-56 bg-white/10 p-4 rounded-full backdrop-blur-md border border-white/20 shadow-2xl relative">
                    <img alt="Customer Service Representative" class="w-full h-full object-cover rounded-full" data-alt="A friendly, smiling customer service representative with a headset looking at the camera, highly professional" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCgW0y5vI9c-rT5rL4B5xXvM8Lp7eN-sW-4Fv38GvR5W0y5vI9c-rT5rL4B5xXvM8Lp7eN-sW-4Fv38GvR5W0y5vI9c-rT5rL4B5xXvM8Lp7eN-sW-4Fv38GvR" onerror="this.src='https://ui-avatars.com/api/?name=Support&background=af101a&color=fff&size=200';"/>
                    <div class="absolute bottom-4 right-4 w-6 h-6 bg-green-500 rounded-full border-4 border-red-700 shadow-md"></div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
