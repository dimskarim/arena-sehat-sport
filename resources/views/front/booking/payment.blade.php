@extends('layouts.front')

@section('title', 'Pembayaran Aman - ArenaFlow')

@push('styles')
<style>
    .payment-card-active {
        border: 2px solid #af101a;
        background-color: #fff2f0;
    }
    .step-active {
        background-color: #af101a;
        color: white;
    }
</style>
@endpush

@section('content')
<main class="pt-24 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
    <!-- Page Title & Progress -->
    <div class="mb-lg motion-hidden">
        <h1 class="font-h1 text-h1 text-on-background mb-sm">Pembayaran Aman</h1>
        <div class="flex items-center gap-4 text-label-md font-label-md">
            <div class="flex items-center gap-2 text-primary">
                <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-xs">1</span>
                <span>Tinjau</span>
            </div>
            <div class="h-px w-8 bg-outline-variant"></div>
            <div class="flex items-center gap-2 text-primary">
                <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-xs">2</span>
                <span>Pembayaran</span>
            </div>
            <div class="h-px w-8 bg-outline-variant"></div>
            <div class="flex items-center gap-2 text-on-surface-variant">
                <span class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center text-xs">3</span>
                <span>Konfirmasi</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Left Column: Payment Methods & Status -->
        <div class="lg:col-span-8 space-y-md">
            <!-- Section 3: Status Display (Top Priority Informational) -->
            <section class="bg-white rounded-xl p-md shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-red-50 motion-hidden delay-100">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-md">
                    <div class="flex items-center gap-md">
                        <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined" data-icon="pending_actions">pending_actions</span>
                        </div>
                        <div>
                            <h3 class="font-h3 text-h3 text-on-background">Status Pembayaran: <span class="text-primary">Tertunda</span></h3>
                            <p class="text-body-md text-on-surface-variant">Menunggu bukti transfer Anda</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-label-md text-on-surface-variant">Jumlah Tagihan</p>
                        <p class="text-h3 font-h3 text-on-background">Rp 250.000</p>
                    </div>
                </div>
            </section>
            <!-- Section 1: Select Payment Method -->
            <section class="bg-white rounded-xl p-md shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-outline-variant motion-hidden delay-200">
                <h3 class="font-h3 text-h3 mb-md">Pilih Metode Pembayaran</h3>
                <div class="space-y-sm">
                    <p class="text-label-md font-semibold text-on-surface-variant uppercase tracking-wider">Transfer Bank</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
                        <label class="relative flex items-center p-md rounded-xl border border-outline-variant cursor-pointer hover:bg-surface-container-low transition-colors payment-card-active">
                            <input checked="" class="hidden" name="payment" type="radio"/>
                            <div class="w-10 h-10 bg-surface-container rounded-lg mr-md flex items-center justify-center">
                                <span class="material-symbols-outlined" data-icon="account_balance">account_balance</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-label-md text-on-background">BCA Transfer</p>
                                <p class="text-xs text-on-surface-variant">Verifikasi Manual (5-10 mnt)</p>
                            </div>
                            <span class="material-symbols-outlined text-primary" data-icon="check_circle" data-weight="fill" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </label>
                        <label class="relative flex items-center p-md rounded-xl border border-outline-variant cursor-pointer hover:bg-surface-container-low transition-colors">
                            <input class="hidden" name="payment" type="radio"/>
                            <div class="w-10 h-10 bg-surface-container rounded-lg mr-md flex items-center justify-center">
                                <span class="material-symbols-outlined" data-icon="account_balance">account_balance</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-label-md text-on-background">Mandiri Transfer</p>
                                <p class="text-xs text-on-surface-variant">Verifikasi Manual (5-10 mnt)</p>
                            </div>
                        </label>
                    </div>
                    <p class="text-label-md font-semibold text-on-surface-variant uppercase tracking-wider pt-sm">E-Wallets &amp; QRIS</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
                        <label class="relative flex items-center p-md rounded-xl border border-outline-variant cursor-pointer hover:bg-surface-container-low transition-colors">
                            <input class="hidden" name="payment" type="radio"/>
                            <div class="w-10 h-10 bg-surface-container rounded-lg mr-md flex items-center justify-center">
                                <span class="material-symbols-outlined" data-icon="qr_code_2">qr_code_2</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-label-md text-on-background">QRIS / GoPay</p>
                                <p class="text-xs text-on-surface-variant">Verifikasi Instan</p>
                            </div>
                        </label>
                        <label class="relative flex items-center p-md rounded-xl border border-outline-variant cursor-pointer hover:bg-surface-container-low transition-colors">
                            <input class="hidden" name="payment" type="radio"/>
                            <div class="w-10 h-10 bg-surface-container rounded-lg mr-md flex items-center justify-center">
                                <span class="material-symbols-outlined" data-icon="wallet">wallet</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-label-md text-on-background">OVO / ShopeePay</p>
                                <p class="text-xs text-on-surface-variant">Verifikasi Instan</p>
                            </div>
                        </label>
                    </div>
                </div>
            </section>
        </div>
        <!-- Right Column: Verification & Summary -->
        <div class="lg:col-span-4 space-y-md">
            <!-- Section 2: Upload Proof -->
            <section class="bg-white rounded-xl p-md shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-outline-variant motion-hidden slide-right delay-200">
                <h3 class="font-label-md text-on-background mb-sm">Unggah Bukti Pembayaran</h3>
                <div class="border-2 border-dashed border-outline-variant rounded-xl p-md text-center bg-surface-container-low hover:border-primary transition-colors group">
                    <input class="hidden" id="proof-upload" type="file"/>
                    <label class="cursor-pointer block" for="proof-upload">
                        <span class="material-symbols-outlined text-outline text-4xl mb-sm group-hover:text-primary transition-colors" data-icon="cloud_upload">cloud_upload</span>
                        <p class="text-body-md font-medium text-on-background">Klik atau seret untuk mengunggah</p>
                        <p class="text-xs text-on-surface-variant mt-xs">PNG, JPG atau PDF (maks. 5MB)</p>
                    </label>
                </div>
                <div class="mt-md p-sm bg-red-50 rounded-lg flex gap-sm">
                    <span class="material-symbols-outlined text-primary text-sm" data-icon="info">info</span>
                    <p class="text-xs text-on-secondary-container leading-relaxed">
                        Verifikasi diproses dalam waktu 15 menit selama jam kerja (08:00 - 22:00). Pastikan struk terlihat jelas dan menyertakan ID transaksi.
                    </p>
                </div>
            </section>
            <!-- Booking Summary -->
            <section class="bg-white rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-outline-variant overflow-hidden motion-hidden slide-right delay-300">
                <div class="h-32 bg-gray-200 overflow-hidden relative">
                    <img alt="Tennis court" class="w-full h-full object-cover" data-alt="professional indoor tennis court with bright blue surface and crisp white lines under soft artificial lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAY15NAdb84C4nw2wGphPYnCY9N1AuJcfRFNDLMYq8zfQSdrnOYtGDqcQ-JkWLJOax8XwsFqGYh_UmNZdEuzHe3frln1NPPzvIBWI3imWLZV1DgMP2B7uNS96srtmJ0433U-Xye3D5uw7gb9LH6dAbFY7cnZSJJ-1dxqiwIsJEes1CAUm4sQJ76Wiigkz9EI4iYFTd7-pghrBSriW1eJaohv6yH96uHIJPqarQtaM_d2DAE8KcNzthdQyvi_zBE2tZZXLJBQSeu9BI"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-md">
                        <span class="text-white font-h3 text-h3">Grand Slam Arena</span>
                    </div>
                </div>
                <div class="p-md space-y-sm">
                    <div class="flex justify-between text-body-md">
                        <span class="text-on-surface-variant">Tanggal</span>
                        <span class="font-medium text-on-background">Oct 24, 2023</span>
                    </div>
                    <div class="flex justify-between text-body-md">
                        <span class="text-on-surface-variant">Waktu</span>
                        <span class="font-medium text-on-background">18:00 - 20:00</span>
                    </div>
                    <div class="flex justify-between text-body-md">
                        <span class="text-on-surface-variant">Olahraga</span>
                        <span class="font-medium text-on-background">Tennis (Court 3)</span>
                    </div>
                    <div class="pt-sm border-t border-outline-variant mt-sm">
                        <div class="flex justify-between">
                            <span class="font-h3 text-h3 text-on-background">Total</span>
                            <span class="font-h3 text-h3 text-primary">Rp 250.000</span>
                        </div>
                    </div>
                </div>
            </section>
            <a href="{{ route('booking.riwayat') }}" class="block text-center w-full bg-primary-container text-on-primary-container font-lexend py-4 rounded-xl shadow-lg hover:brightness-110 active:scale-95 transition-all text-lg font-bold">
                Kirim Bukti Pembayaran
            </a>
            <div class="flex items-center justify-center gap-2 text-xs text-on-surface-variant">
                <span class="material-symbols-outlined text-xs" data-icon="lock">lock</span>
                <span>Transaksi terenkripsi aman didukung oleh ArenaFlow Pay</span>
            </div>
        </div>
    </div>
</main>
@endsection
