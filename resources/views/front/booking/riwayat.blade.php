@extends('layouts.front')

@section('title', 'Riwayat Pesanan - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 md:pb-8 px-4 max-w-7xl mx-auto">
    <!-- User Profile Summary Section -->
    <section class="mb-lg motion-hidden">
        <div class="bg-white rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] p-md flex flex-col md:flex-row items-center md:items-start gap-md border border-surface-container">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-secondary-container">
                <img alt="User Profile" class="w-full h-full object-cover" data-alt="Close-up portrait of a fit young man with a confident expression, outdoor setting with soft athletic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvqEVNeQU59-aGwEmGAOo6KOEDwCry4R0G5_Wugu3osyqdrLaR-_jtlLBfOx2vmPgpXJkV4WpTEEc6h8YoJAEYqCS_Iuun769a_NsAuajrv2pr2Qhj9w0Zd0oGlebxFoCyxGZptogTAyWemgT3TVWywf69WWTFyRxfvae1nE5xG7tIY5xHLJ7zcGchBEsw_A7Jl_kM0Otj0xb92sVFQU90HCs0Y2hGGGzPW7OyriOrLAVf2fvbhtPGoT1VSnlgn50EXmM2lfF3xFw"/>
            </div>
            <div class="flex-grow text-center md:text-left">
                <h1 class="font-h2 text-h2 text-on-background mb-xs">Selamat datang kembali, Alex</h1>
                <p class="font-body-md text-body-md text-outline mb-sm">Member Premium sejak 2023 • 42 Sesi Selesai</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-sm">
                    <div class="bg-red-50 px-4 py-2 rounded-lg border border-red-100">
                        <span class="block font-label-md text-primary">Pertandingan Berikutnya</span>
                        <span class="font-h3 text-h3">Besok, 18:00</span>
                    </div>
                    <div class="bg-surface-container px-4 py-2 rounded-lg border border-outline-variant">
                        <span class="block font-label-md text-outline">Saldo Dompet</span>
                        <span class="font-h3 text-h3">Rp 1.250.000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Booking History Canvas -->
    <section class="motion-hidden">
        <div class="flex items-center justify-between mb-md">
            <h2 class="font-h3 text-h3 text-on-background">Riwayat Pesanan</h2>
            <div class="flex gap-sm">
                <button class="bg-surface-container-lowest border border-outline-variant px-4 py-2 rounded-full font-label-md text-on-surface hover:bg-secondary-container transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[18px]" data-icon="filter_list">filter_list</span> Filter
                </button>
                <a href="{{ route('lapangan.index') }}" class="bg-primary text-on-primary px-6 py-2 rounded-full font-label-md shadow-lg shadow-primary/20 active:scale-95 transition-transform inline-block">
                    Pesan Baru
                </a>
            </div>
        </div>
        
        <!-- List of Bookings using Asymmetric Bento-style Layout for Visual Interest -->
        <div class="grid grid-cols-1 gap-md">
            <!-- Booking Item 1: Success -->
            <div class="group bg-white rounded-xl border border-surface-container hover:shadow-[0_4px_20px_rgba(211,47,47,0.12)] transition-all overflow-hidden flex flex-col md:flex-row motion-hidden delay-100">
                <div class="w-full md:w-48 h-40 md:h-auto overflow-hidden">
                    <img alt="Venue" class="w-full h-full object-cover group-hover:scale-105 transition-transform" data-alt="Interior view of a high-end modern indoor tennis court with bright professional lighting and blue surface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAV9H9rJvo6oQ8G-__bzozxiJisQauB4SjBWscs5_c_4nzQzcrc871-IvGUnNBPyoADZGNpfO9eRQ-PcNr6J8otYyYsrv4awVMoso_s1UW9PQXZsMtIJdNvFVPsB_K3sCYR8_dphmX3HpDYEvX6kzsQZymvTQO0M5CMZKYHoNm5UD6kz1AcrCUsYeSDqWo65Rwmde3Qs5gk2-oIAzeJkNg7vRkIOdotiNvEOYcPaqQx5X9m84bQ_SxdyHaBqspJEFoemIVx1X3QSJ0"/>
                </div>
                <div class="flex-grow p-md flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-primary tracking-widest uppercase">Tennis • Indoor</span>
                        <h3 class="font-h3 text-h3 text-on-background">Grand Slam Arena</h3>
                        <div class="flex items-center gap-sm text-outline">
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span> Oct 24, 2023
                            </span>
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="schedule">schedule</span> 18:00 - 20:00
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-sm w-full md:w-auto">
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="check_circle" data-weight="fill" style="font-variation-settings: 'FILL' 1;">check_circle</span> Berhasil
                        </span>
                        <div class="flex justify-between md:block">
                            <span class="text-outline text-label-md block md:text-right">Total Harga</span>
                            <span class="text-h3 font-h3 text-on-background">Rp 250.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Item 2: Pending -->
            <div class="group bg-white rounded-xl border border-surface-container hover:shadow-[0_4px_20px_rgba(211,47,47,0.12)] transition-all overflow-hidden flex flex-col md:flex-row motion-hidden delay-200">
                <div class="w-full md:w-48 h-40 md:h-auto overflow-hidden">
                    <img alt="Venue" class="w-full h-full object-cover group-hover:scale-105 transition-transform" data-alt="Wide angle shot of a professional basketball court with polished hardwood floor and bright ceiling lights" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCazG7_JATEbmvhVuePuHbHuWu6lI3dnCUXxYdiR8XsB74faIGXBkBo2yHgw5z7iaW94Ts3e9df79vD4QuP71B0RzAnVV8aLFcLAlqj4Az4BwOjRVTVYSUFkvYriehrChuwzjQjjR9Wv-QcYpTMYBI4nWNyAzFYl9IVB4QSQAQJdxhJWIYnO14IDr6w0RKe68SMfO34QOnEISFS2SKJ-VL2YIUxEfqOHodAEuLVfA_mN7bhS8U1dtmLJmKJ9Mx8wvyd85P5knQdfDo"/>
                </div>
                <div class="flex-grow p-md flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-primary tracking-widest uppercase">Basketball • Full Court</span>
                        <h3 class="font-h3 text-h3 text-on-background">Urban Hoop Hub</h3>
                        <div class="flex items-center gap-sm text-outline">
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span> Oct 28, 2023
                            </span>
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="schedule">schedule</span> 09:00 - 11:00
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-sm w-full md:w-auto">
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="pending" data-weight="fill" style="font-variation-settings: 'FILL' 1;">pending</span> Tertunda
                        </span>
                        <div class="flex justify-between md:block">
                            <span class="text-outline text-label-md block md:text-right">Total Harga</span>
                            <span class="text-h3 font-h3 text-on-background">Rp 300.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Item 3: Rejected -->
            <div class="group bg-white rounded-xl border border-surface-container hover:shadow-[0_4px_20px_rgba(211,47,47,0.12)] transition-all overflow-hidden flex flex-col md:flex-row opacity-80 motion-hidden delay-300">
                <div class="w-full md:w-48 h-40 md:h-auto overflow-hidden grayscale">
                    <img alt="Venue" class="w-full h-full object-cover group-hover:scale-105 transition-transform" data-alt="Outdoor soccer field at dusk with powerful floodlights illuminating the green artificial turf" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAECsbEPhtFUM69Sxor3-8hIfK4JDk1QdpXjX6LbntqCZwHOauz71tXam8im6L2rXnYIv6Gf6OtX97N6JiRICZgh6JoT5KBWTM8jkkcXkZq6QFHwZ1jm4A33vw6KdgRUsi8jBgIiskC_31H8G6_eSDemvQw3vR7btrTiSvAW92bX0Peyb3g6ZzogXUdF8q_xgK-5LzHVbqRVWDfIqpPQp5KdQkxd1s1BE8LMuR2TeM9QOtZYQzXArSZCwRnsreg16avGbXjrVTPHI4"/>
                </div>
                <div class="flex-grow p-md flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-outline tracking-widest uppercase">Football • 5-a-side</span>
                        <h3 class="font-h3 text-h3 text-on-background">Elite Turf Grounds</h3>
                        <div class="flex items-center gap-sm text-outline">
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span> Oct 15, 2023
                            </span>
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="schedule">schedule</span> 21:00 - 22:30
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-sm w-full md:w-auto">
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="cancel" data-weight="fill" style="font-variation-settings: 'FILL' 1;">cancel</span> Ditolak
                        </span>
                        <div class="flex justify-between md:block">
                            <span class="text-outline text-label-md block md:text-right">Total Harga</span>
                            <span class="text-h3 font-h3 text-on-background">Rp 150.000</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Item 4: Success (Minimal style) -->
            <div class="group bg-white rounded-xl border border-surface-container hover:shadow-[0_4px_20px_rgba(211,47,47,0.12)] transition-all overflow-hidden flex flex-col md:flex-row motion-hidden delay-400">
                <div class="w-full md:w-48 h-40 md:h-auto overflow-hidden">
                    <img alt="Venue" class="w-full h-full object-cover group-hover:scale-105 transition-transform" data-alt="Modern fitness studio with high-end equipment, wooden floors, and floor-to-ceiling windows showing urban view" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBn3GfYlmQo2zS3TfxVR4oEpqzGID2J9-F2HLMufvxxOsKxz4GYuSQnsfg-vhVSecE6mAQ9ezgduQbSUgHpcxBnAd_7TOKDAK-v0uCoo-_09LDVYt98DYoEqGe5EQF6KcGU9vrVk3X_7za9f8hghvftZS2EJB9pgudwbM2qjY9QFNxj395qVMspDFyoA4lDSDglw1e_GomN4nCJRiCjz7_hAKDtrPuHWaXdzo4njtYOMZI-Xf9YZ0gGE0lDR6GM92hh4NRaBIF7brY"/>
                </div>
                <div class="flex-grow p-md flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-primary tracking-widest uppercase">Padel • Outdoor</span>
                        <h3 class="font-h3 text-h3 text-on-background">Padel Point Central</h3>
                        <div class="flex items-center gap-sm text-outline">
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span> Oct 10, 2023
                            </span>
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="schedule">schedule</span> 17:00 - 18:30
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-sm w-full md:w-auto">
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="check_circle" data-weight="fill" style="font-variation-settings: 'FILL' 1;">check_circle</span> Berhasil
                        </span>
                        <div class="flex justify-between md:block">
                            <span class="text-outline text-label-md block md:text-right">Total Harga</span>
                            <span class="text-h3 font-h3 text-on-background">Rp 120.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
