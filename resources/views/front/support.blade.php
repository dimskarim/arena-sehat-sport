@extends('layouts.front')

@section('title', 'Pusat Bantuan - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 max-w-7xl mx-auto px-6">
    <!-- Hero / Search Section -->
    <section class="mb-lg motion-hidden text-center max-w-3xl mx-auto">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-container rounded-2xl mb-6 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-on-primary-container text-4xl">support_agent</span>
        </div>
        <h1 class="font-h1 text-h1 text-on-background mb-4">Ada yang bisa kami bantu?</h1>
        <p class="text-body-lg text-on-surface-variant mb-8">Temukan jawaban untuk semua pertanyaan Anda seputar ArenaFlow, dari cara pemesanan hingga informasi pembayaran.</p>
        
        <div class="relative w-full max-w-2xl mx-auto shadow-lg shadow-surface-variant/50 rounded-full">
            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-outline text-2xl">search</span>
            <input class="w-full bg-white border border-outline-variant rounded-full py-4 pl-14 pr-6 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary text-body-lg transition-all" placeholder="Cari artikel bantuan (mis. 'cara ganti jadwal')..." type="text"/>
            <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md hover:bg-primary-container transition-colors active:scale-95 shadow-md shadow-primary/20">Cari</button>
        </div>
    </section>

    <!-- Categories -->
    <section class="mb-xl motion-hidden delay-100">
        <h2 class="font-h3 text-h3 text-on-background mb-md text-center">Jelajahi Topik</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
            <a href="#" class="bg-surface-container-lowest border border-outline-variant p-6 rounded-2xl hover:border-primary hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all group flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-surface-container rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant group-hover:text-on-primary-container text-3xl">account_circle</span>
                </div>
                <h3 class="font-label-lg font-bold text-on-background mb-2 group-hover:text-primary transition-colors">Akun & Profil</h3>
                <p class="text-body-sm text-on-surface-variant">Cara mendaftar, lupa password, dan mengatur preferensi Anda.</p>
            </a>
            
            <a href="#" class="bg-surface-container-lowest border border-outline-variant p-6 rounded-2xl hover:border-primary hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all group flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-surface-container rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant group-hover:text-on-primary-container text-3xl">calendar_month</span>
                </div>
                <h3 class="font-label-lg font-bold text-on-background mb-2 group-hover:text-primary transition-colors">Booking & Jadwal</h3>
                <p class="text-body-sm text-on-surface-variant">Panduan cara memesan, mengubah, atau membatalkan pesanan.</p>
            </a>

            <a href="#" class="bg-surface-container-lowest border border-outline-variant p-6 rounded-2xl hover:border-primary hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all group flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-surface-container rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant group-hover:text-on-primary-container text-3xl">payments</span>
                </div>
                <h3 class="font-label-lg font-bold text-on-background mb-2 group-hover:text-primary transition-colors">Pembayaran</h3>
                <p class="text-body-sm text-on-surface-variant">Informasi e-wallet, transfer bank, pengembalian dana, dan promo.</p>
            </a>

            <a href="#" class="bg-surface-container-lowest border border-outline-variant p-6 rounded-2xl hover:border-primary hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all group flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-surface-container rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant group-hover:text-on-primary-container text-3xl">sports_gymnastics</span>
                </div>
                <h3 class="font-label-lg font-bold text-on-background mb-2 group-hover:text-primary transition-colors">Informasi Fasilitas</h3>
                <p class="text-body-sm text-on-surface-variant">Aturan tempat, standar lapangan, dan keluhan terkait venue.</p>
            </a>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="mb-xl motion-hidden delay-200">
        <h2 class="font-h3 text-h3 text-on-background mb-md">Pertanyaan yang Sering Diajukan (FAQ)</h2>
        <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(211,47,47,0.04)] border border-outline-variant divide-y divide-outline-variant">
            <!-- FAQ Item 1 -->
            <details class="group p-6" open>
                <summary class="flex justify-between items-center font-label-lg font-bold text-on-background cursor-pointer list-none">
                    <span>Bagaimana cara membatalkan pesanan yang sudah dibayar?</span>
                    <span class="transition group-open:rotate-180">
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </span>
                </summary>
                <div class="text-body-md text-on-surface-variant mt-4 animate-fade-up">
                    <p>Pemesanan dapat dibatalkan melalui menu <strong>Riwayat Pesanan</strong> di profil Anda. Pembatalan yang dilakukan maksimal H-1 sebelum waktu bermain akan menerima pengembalian dana (refund) sebesar 80% ke saldo dompet Anda. Pembatalan di hari H tidak mendapatkan pengembalian dana.</p>
                </div>
            </details>
            <!-- FAQ Item 2 -->
            <details class="group p-6">
                <summary class="flex justify-between items-center font-label-lg font-bold text-on-background cursor-pointer list-none">
                    <span>Apakah saya bisa membayar langsung di lokasi venue?</span>
                    <span class="transition group-open:rotate-180">
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </span>
                </summary>
                <div class="text-body-md text-on-surface-variant mt-4 animate-fade-up">
                    <p>Saat ini ArenaFlow mewajibkan seluruh pembayaran dilakukan secara online untuk menjamin ketersediaan lapangan. Kami menerima beragam metode seperti Transfer Bank, QRIS, GoPay, OVO, dan ShopeePay.</p>
                </div>
            </details>
            <!-- FAQ Item 3 -->
            <details class="group p-6">
                <summary class="flex justify-between items-center font-label-lg font-bold text-on-background cursor-pointer list-none">
                    <span>Bagaimana jika lapangan ternyata digunakan oleh pihak lain saat saya datang?</span>
                    <span class="transition group-open:rotate-180">
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </span>
                </summary>
                <div class="text-body-md text-on-surface-variant mt-4 animate-fade-up">
                    <p>Setiap transaksi di ArenaFlow bersifat mengikat. Tunjukkan ID Pesanan Anda (di menu Riwayat) kepada pengelola venue. Jika terjadi *double-booking* karena kesalahan pengelola, Anda berhak mendapatkan *refund* 100% dan *voucher* kompensasi. Segera hubungi tim Customer Service kami jika Anda mengalami ini.</p>
                </div>
            </details>
            <!-- FAQ Item 4 -->
            <details class="group p-6">
                <summary class="flex justify-between items-center font-label-lg font-bold text-on-background cursor-pointer list-none">
                    <span>Apakah harga sewa lapangan di aplikasi lebih mahal?</span>
                    <span class="transition group-open:rotate-180">
                        <span class="material-symbols-outlined text-outline">expand_more</span>
                    </span>
                </summary>
                <div class="text-body-md text-on-surface-variant mt-4 animate-fade-up">
                    <p>Tidak. Harga yang tertera di aplikasi adalah harga resmi (termasuk pajak) yang telah disepakati oleh mitra venue kami. Anda tidak akan dikenakan biaya tambahan saat tiba di lokasi, kecuali untuk layanan ekstra seperti sewa raket atau beli minuman.</p>
                </div>
            </details>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="motion-hidden delay-300">
        <div class="bg-primary-container rounded-3xl p-8 md:p-12 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 border border-primary/20">
            <!-- Background Decorative Elements -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-black/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 max-w-xl text-center md:text-left">
                <h2 class="font-h2 text-h2 text-on-primary-container mb-4">Masih Butuh Bantuan?</h2>
                <p class="text-body-lg text-on-primary-container/80 mb-6">Tim dukungan profesional kami tersedia setiap hari dari jam 08:00 - 22:00 WIB untuk membantu Anda.</p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="https://wa.me/6281234567890" target="_blank" class="bg-white text-primary px-8 py-3.5 rounded-xl font-bold font-label-lg flex items-center justify-center gap-2 hover:bg-surface-container-low transition-colors shadow-lg active:scale-95">
                        <span class="material-symbols-outlined text-green-500">chat</span>
                        Chat via WhatsApp
                    </a>
                    <a href="mailto:support@arenaflow.id" class="bg-transparent border-2 border-white/30 text-white px-8 py-3.5 rounded-xl font-bold font-label-lg flex items-center justify-center gap-2 hover:bg-white/10 transition-colors active:scale-95">
                        <span class="material-symbols-outlined">mail</span>
                        Email Kami
                    </a>
                </div>
            </div>
            
            <div class="relative z-10 hidden md:block w-48 h-48 bg-white/20 rounded-full p-4 flex-shrink-0 backdrop-blur-md border border-white/20 shadow-2xl">
                <img alt="Customer Service Representative" class="w-full h-full object-cover rounded-full" data-alt="A friendly, smiling customer service representative with a headset looking at the camera, highly professional" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCgW0y5vI9c-rT5rL4B5xXvM8Lp7eN-sW-4Fv38GvR5W0y5vI9c-rT5rL4B5xXvM8Lp7eN-sW-4Fv38GvR5W0y5vI9c-rT5rL4B5xXvM8Lp7eN-sW-4Fv38GvR" onerror="this.src='https://ui-avatars.com/api/?name=Support&background=af101a&color=fff&size=200';"/>
            </div>
        </div>
    </section>
</main>
@endsection
