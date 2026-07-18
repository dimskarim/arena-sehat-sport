@extends('layouts.front')

@section('title', 'Pembayaran Aman - ArenaFlow')

@push('styles')
<style>
    .payment-card-active {
        border-color: #dc2626 !important;
        border-width: 2px !important;
        background-color: #fef2f2 !important;
    }

    .dark .payment-card-active {
        background-color: rgba(127, 29, 29, 0.2) !important;
        border-color: #ef4444 !important;
    }

    .step-active {
        background-color: #dc2626;
        color: white;
    }
</style>
@endpush

@section('content')
<main class="pt-24 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
    <!-- Page Title & Progress -->
    <div class="mb-12 motion-hidden flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl md:text-5xl font-black font-['Lexend'] text-gray-900 dark:text-white tracking-tight mb-2">Pembayaran <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-400">Aman</span></h1>
            <p class="text-gray-500 dark:text-gray-400 text-lg">Selesaikan pembayaran untuk mengamankan jadwal Anda.</p>
        </div>

        <!-- Progress Stepper -->
        <div class="flex items-center gap-4 text-sm font-bold">
            <div class="flex items-center gap-2 text-red-600 dark:text-red-500">
                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <span class="uppercase tracking-wider">Tinjau</span>
            </div>
            <div class="h-px w-8 bg-red-200 dark:bg-red-900"></div>
            <div class="flex items-center gap-2 text-red-600 dark:text-red-500">
                <span class="w-6 h-6 rounded-full bg-red-600 dark:bg-red-500 text-white flex items-center justify-center text-xs shadow-[0_0_10px_rgba(220,38,38,0.5)]">2</span>
                <span class="uppercase tracking-wider">Pembayaran</span>
            </div>
            <div class="h-px w-8 bg-gray-200 dark:bg-gray-800"></div>
            <div class="flex items-center gap-2 text-gray-400 dark:text-gray-500">
                <span class="w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600 flex items-center justify-center text-xs">3</span>
                <span class="uppercase tracking-wider">Konfirmasi</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Left Column: Payment Methods & Status -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Section: Status Display -->
            <section class="bg-white dark:bg-gray-900 rounded-2xl p-6 md:p-8 shadow-xl shadow-red-900/5 dark:shadow-black/20 border-l-4 border-l-yellow-400 border border-gray-100 dark:border-gray-800 motion-hidden delay-100 relative overflow-hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center text-yellow-600 dark:text-yellow-500 shrink-0">
                            <span class="material-symbols-outlined text-[28px] animate-pulse">pending_actions</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-1">Status: <span class="text-yellow-500">Tertunda</span></h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Menunggu bukti transfer Anda</p>
                        </div>
                    </div>
                    <div class="sm:text-right bg-gray-50 dark:bg-gray-800/50 p-4 sm:p-0 sm:bg-transparent rounded-xl">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">Jumlah Tagihan</p>
                        <p class="text-3xl font-black font-['Lexend'] text-gray-900 dark:text-white">Rp 250.000</p>
                    </div>
                </div>
            </section>

            <!-- Section: Select Payment Method -->
            <section class="bg-white dark:bg-gray-900 rounded-2xl p-6 md:p-8 shadow-xl shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-gray-800 motion-hidden delay-200">
                <h3 class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-6">Pilih Metode Pembayaran</h3>
                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">Transfer Bank</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors payment-card-active group">
                                <input checked class="hidden" name="payment" type="radio" />
                                <div class="w-12 h-12 bg-white dark:bg-gray-900 rounded-lg mr-4 flex items-center justify-center border border-gray-100 dark:border-gray-800 shadow-sm group-[.payment-card-active]:border-red-200 dark:group-[.payment-card-active]:border-red-900/50">
                                    <span class="material-symbols-outlined text-[24px] text-gray-600 dark:text-gray-400 group-[.payment-card-active]:text-red-500">account_balance</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 dark:text-white group-[.payment-card-active]:text-red-700 dark:group-[.payment-card-active]:text-red-400">BCA Transfer</p>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-0.5">Verifikasi Manual (5-10 mnt)</p>
                                </div>
                                <span class="material-symbols-outlined text-red-500 opacity-0 group-[.payment-card-active]:opacity-100 transition-opacity" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </label>

                            <label class="relative flex items-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                                <input class="hidden" name="payment" type="radio" />
                                <div class="w-12 h-12 bg-white dark:bg-gray-900 rounded-lg mr-4 flex items-center justify-center border border-gray-100 dark:border-gray-800 shadow-sm group-[.payment-card-active]:border-red-200 dark:group-[.payment-card-active]:border-red-900/50">
                                    <span class="material-symbols-outlined text-[24px] text-gray-600 dark:text-gray-400 group-[.payment-card-active]:text-red-500">account_balance</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 dark:text-white group-[.payment-card-active]:text-red-700 dark:group-[.payment-card-active]:text-red-400">Mandiri Transfer</p>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-0.5">Verifikasi Manual (5-10 mnt)</p>
                                </div>
                                <span class="material-symbols-outlined text-red-500 opacity-0 group-[.payment-card-active]:opacity-100 transition-opacity" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">E-Wallets &amp; QRIS</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                                <input class="hidden" name="payment" type="radio" />
                                <div class="w-12 h-12 bg-white dark:bg-gray-900 rounded-lg mr-4 flex items-center justify-center border border-gray-100 dark:border-gray-800 shadow-sm group-[.payment-card-active]:border-red-200 dark:group-[.payment-card-active]:border-red-900/50">
                                    <span class="material-symbols-outlined text-[24px] text-gray-600 dark:text-gray-400 group-[.payment-card-active]:text-red-500">qr_code_2</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 dark:text-white group-[.payment-card-active]:text-red-700 dark:group-[.payment-card-active]:text-red-400">QRIS / GoPay</p>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-0.5">Verifikasi Instan</p>
                                </div>
                                <span class="material-symbols-outlined text-red-500 opacity-0 group-[.payment-card-active]:opacity-100 transition-opacity" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </label>

                            <label class="relative flex items-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                                <input class="hidden" name="payment" type="radio" />
                                <div class="w-12 h-12 bg-white dark:bg-gray-900 rounded-lg mr-4 flex items-center justify-center border border-gray-100 dark:border-gray-800 shadow-sm group-[.payment-card-active]:border-red-200 dark:group-[.payment-card-active]:border-red-900/50">
                                    <span class="material-symbols-outlined text-[24px] text-gray-600 dark:text-gray-400 group-[.payment-card-active]:text-red-500">wallet</span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 dark:text-white group-[.payment-card-active]:text-red-700 dark:group-[.payment-card-active]:text-red-400">OVO / ShopeePay</p>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-0.5">Verifikasi Instan</p>
                                </div>
                                <span class="material-symbols-outlined text-red-500 opacity-0 group-[.payment-card-active]:opacity-100 transition-opacity" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Right Column: Verification & Summary -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Section: Upload Proof -->
            <section class="bg-white dark:bg-gray-900 rounded-2xl p-6 md:p-8 shadow-xl shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-gray-800 motion-hidden delay-200 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-600 to-red-400"></div>
                <h3 class="text-xl font-bold font-['Lexend'] text-gray-900 dark:text-white mb-6">Unggah Bukti</h3>

                <div class="border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl p-8 text-center bg-gray-50 dark:bg-gray-800/30 hover:bg-red-50 dark:hover:bg-red-900/10 hover:border-red-400 dark:hover:border-red-500/50 transition-all group cursor-pointer">
                    <input class="hidden" id="proof-upload" type="file" />
                    <label class="cursor-pointer block" for="proof-upload">
                        <div class="w-16 h-16 mx-auto bg-white dark:bg-gray-900 rounded-full flex items-center justify-center shadow-sm mb-4 group-hover:scale-110 group-hover:bg-red-100 dark:group-hover:bg-red-900/30 transition-all duration-300">
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-red-500 text-[32px]">cloud_upload</span>
                        </div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white mb-1">Klik untuk mengunggah</p>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">PNG, JPG atau PDF (maks. 5MB)</p>
                    </label>
                </div>

                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-900/50 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-500 text-[20px] mt-0.5">info</span>
                    <p class="text-xs font-medium text-blue-800 dark:text-blue-300 leading-relaxed">
                        Verifikasi diproses dalam waktu 15 menit selama jam kerja (08:00 - 22:00). Pastikan struk terlihat jelas.
                    </p>
                </div>
            </section>

            <!-- Booking Summary -->
            <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl shadow-red-900/5 dark:shadow-black/20 border border-gray-100 dark:border-gray-800 overflow-hidden motion-hidden delay-300">
                <div class="h-32 bg-gray-200 overflow-hidden relative">
                    <img alt="Tennis court" class="w-full h-full object-cover" data-alt="professional indoor tennis court with bright blue surface and crisp white lines under soft artificial lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAY15NAdb84C4nw2wGphPYnCY9N1AuJcfRFNDLMYq8zfQSdrnOYtGDqcQ-JkWLJOax8XwsFqGYh_UmNZdEuzHe3frln1NPPzvIBWI3imWLZV1DgMP2B7uNS96srtmJ0433U-Xye3D5uw7gb9LH6dAbFY7cnZSJJ-1dxqiwIsJEes1CAUm4sQJ76Wiigkz9EI4iYFTd7-pghrBSriW1eJaohv6yH96uHIJPqarQtaM_d2DAE8KcNzthdQyvi_zBE2tZZXLJBQSeu9BI" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-6">
                        <span class="text-white font-black font-['Lexend'] text-xl">Grand Slam Arena</span>
                    </div>
                </div>
                <div class="p-6 md:p-8 space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Tanggal</span>
                        <span class="font-bold text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 px-3 py-1 rounded-lg">Oct 24, 2023</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Waktu</span>
                        <span class="font-bold text-gray-900 dark:text-white">18:00 - 20:00</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Olahraga</span>
                        <span class="font-bold text-gray-900 dark:text-white">Tennis (Court 3)</span>
                    </div>
                    <div class="pt-4 border-t border-dashed border-gray-200 dark:border-gray-700 mt-2">
                        <div class="flex justify-between items-end">
                            <span class="font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs mb-1">Total Harga</span>
                            <span class="font-black font-['Lexend'] text-2xl text-red-600 dark:text-red-500 leading-none">Rp 250.000</span>
                        </div>
                    </div>
                </div>
            </section>

            <div>
                <a href="{{ route('booking.riwayat') }}" class="block text-center w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-xl shadow-lg shadow-red-600/20 active:scale-95 transition-all text-lg font-bold group flex items-center justify-center gap-2">
                    Kirim Bukti Pembayaran
                    <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">send</span>
                </a>
                <div class="flex items-center justify-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400 mt-4">
                    <span class="material-symbols-outlined text-[16px]">lock</span>
                    <span>Transaksi terenkripsi aman didukung oleh ArenaFlow</span>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection