@extends('layouts.front')

@section('title', 'Booking Checkout - ArenaFlow')

@push('styles')
<style>
    .step-active { color: #af101a; }
    .booking-gradient {
        background: linear-gradient(135deg, #ffffff 0%, #fff2f0 100%);
    }
</style>
@endpush

@section('content')
<main class="pt-24 pb-32 md:pb-16 px-4 max-w-7xl mx-auto">
    <!-- Progress Stepper -->
    <div class="mb-lg flex items-center justify-center space-x-4 motion-hidden">
        <div class="flex items-center gap-2 text-primary">
            <span class="material-symbols-outlined" data-icon="check_circle" data-weight="fill" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            <span class="font-label-md text-label-md">Pilihan</span>
        </div>
        <div class="w-12 h-px bg-primary-fixed"></div>
        <div class="flex items-center gap-2 text-primary">
            <span class="w-6 h-6 rounded-full border-2 border-primary flex items-center justify-center text-[12px] font-bold">2</span>
            <span class="font-label-md text-label-md">Informasi</span>
        </div>
        <div class="w-12 h-px bg-surface-container-high"></div>
        <div class="flex items-center gap-2 text-on-surface-variant">
            <span class="w-6 h-6 rounded-full border-2 border-outline flex items-center justify-center text-[12px] font-bold">3</span>
            <span class="font-label-md text-label-md">Pembayaran</span>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Form Section -->
        <div class="lg:col-span-7 space-y-md">
            <section class="bg-white p-md rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.04)] border border-surface-container motion-hidden delay-100">
                <h2 class="font-h3 text-h3 mb-md text-on-background">Informasi Kontak</h2>
                <div class="space-y-md">
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs" for="full_name">Nama Lengkap</label>
                        <input class="w-full h-12 px-4 rounded-lg border border-outline-variant focus:border-primary focus:ring-0 hover:bg-secondary-fixed transition-colors font-body-md" id="full_name" placeholder="John Doe" type="text"/>
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface-variant mb-xs" for="phone">Nomor Telepon (No HP)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">+62</span>
                            <input class="w-full h-12 pl-14 pr-4 rounded-lg border border-outline-variant focus:border-primary focus:ring-0 hover:bg-secondary-fixed transition-colors font-body-md" id="phone" placeholder="812 3456 7890" type="tel"/>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="bg-white p-md rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.04)] border border-surface-container">
                <div class="flex items-center gap-3 mb-md">
                    <span class="material-symbols-outlined text-primary" data-icon="info">info</span>
                    <h2 class="font-h3 text-h3 text-on-background">Catatan Penting</h2>
                </div>
                <ul class="space-y-sm text-on-surface-variant">
                    <li class="flex gap-3">
                        <span class="material-symbols-outlined text-[18px] text-primary" data-icon="check">check</span>
                        <span class="text-body-md">Harap tiba 15 menit sebelum waktu pesanan Anda.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="material-symbols-outlined text-[18px] text-primary" data-icon="check">check</span>
                        <span class="text-body-md">Bawa perlengkapan sendiri atau sewa di lokasi.</span>
                    </li>
                </ul>
            </section>
        </div>
        
        <!-- Sidebar / Order Summary -->
        <div class="lg:col-span-5">
            <aside class="sticky top-24 space-y-md motion-hidden slide-right delay-200">
                <div class="bg-white rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.08)] border border-surface-container overflow-hidden">
                    <div class="h-32 w-full relative">
                        <img class="w-full h-full object-cover" data-alt="Modern indoor badminton court with professional lighting, polished wooden floors, and vibrant blue and green court lines" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBT7bo2CApfbZ65nAXc24qdZzcB3f6aumWciodlliUukkBK24UdbMEcpm6OVp_h8lWQc3KKWi0HRj5XmBEmH8rT11TMUzdEC31p7Kuoh8I_023XQ-cV98G7R95upzZIsrbVDeCZQGy3dLF0rQzQEag9opjbAn_04IzHQpxo0t59Ha6qUl8l9ytotV_fzOHNNH7Za5Ka7q-Tvm3o1Xi4hAWpSHlc5dGIT6Pyq0z_zKu2vEuhJPXGaEszeqRUY_dWRjhFd9p1DgotLXU"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-md">
                            <h3 class="text-white font-h3 text-h3">Elite Badminton Center</h3>
                        </div>
                    </div>
                    <div class="p-md space-y-md">
                        <div class="space-y-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[20px]" data-icon="calendar_today">calendar_today</span>
                                    <span class="font-label-md text-label-md">Tanggal</span>
                                </div>
                                <span class="font-body-md text-on-background">20 Mei 2024</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[20px]" data-icon="schedule">schedule</span>
                                    <span class="font-label-md text-label-md">Waktu Sesi</span>
                                </div>
                                <span class="font-body-md text-on-background">15:00 - 17:00</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[20px]" data-icon="sports_tennis">sports_tennis</span>
                                    <span class="font-label-md text-label-md">Lapangan</span>
                                </div>
                                <span class="font-body-md text-on-background">Lapangan #4 (Premium)</span>
                            </div>
                        </div>
                        <hr class="border-surface-container-highest"/>
                        <div class="space-y-sm">
                            <div class="flex justify-between text-on-surface-variant">
                                <span class="text-body-md">Subtotal</span>
                                <span class="text-body-md">Rp 240.000</span>
                            </div>
                            <div class="flex justify-between text-on-surface-variant">
                                <span class="text-body-md">Biaya Layanan</span>
                                <span class="text-body-md">Rp 5.000</span>
                            </div>
                            <div class="flex justify-between items-center pt-base">
                                <span class="font-h3 text-h3 text-on-background">Total Harga</span>
                                <span class="font-h2 text-h2 text-primary">Rp 245.000</span>
                            </div>
                        </div>
                        <a href="{{ route('booking.payment') }}" class="w-full bg-primary-container text-on-primary-container h-14 rounded-lg font-h3 text-h3 active:scale-95 transition-transform shadow-md hover:bg-primary transition-colors flex items-center justify-center gap-2">
                            Checkout
                            <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                        </a>
                    </div>
                </div>
                <div class="bg-secondary-fixed p-sm rounded-lg flex items-start gap-3 border border-secondary-container">
                    <span class="material-symbols-outlined text-on-secondary-container" data-icon="security">security</span>
                    <p class="text-[12px] text-on-secondary-container font-label-md">Pembayaran Anda diamankan dengan enkripsi standar industri. ArenaFlow tidak menyimpan detail kartu Anda.</p>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection
