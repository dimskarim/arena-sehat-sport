@extends('layouts.front')

@section('title', 'Venue Tersedia - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 max-w-7xl mx-auto px-6">
    <!-- Search and Filter Bar -->
    <section class="mb-lg motion-hidden">
        <div class="bg-surface-container-lowest rounded-xl p-md shadow-[0_4px_20px_rgba(211,47,47,0.05)] border border-outline-variant/30">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter items-end">
                <!-- Sport Type -->
                <div class="space-y-xs">
                    <label class="text-label-md text-on-surface-variant block">Jenis Olahraga</label>
                    <div class="relative">
                        <select class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-body-md transition-all">
                            <option>Semua Olahraga</option>
                            <option>Futsal</option>
                            <option>Basketball</option>
                            <option>Badminton</option>
                            <option>Tennis</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-outline">expand_more</span>
                    </div>
                </div>
                <!-- Date -->
                <div class="space-y-xs">
                    <label class="text-label-md text-on-surface-variant block">Tanggal</label>
                    <div class="relative">
                        <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-body-md transition-all" type="date"/>
                    </div>
                </div>
                <!-- Price Range -->
                <div class="space-y-xs">
                    <label class="text-label-md text-on-surface-variant block">Harga Maksimal</label>
                    <div class="relative">
                        <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-body-md transition-all" placeholder="Rp 500.000" type="text"/>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline">payments</span>
                    </div>
                </div>
                <!-- Search Button -->
                <button class="bg-primary text-on-primary h-[50px] w-full rounded-lg font-label-md flex items-center justify-center gap-2 transition-all hover:opacity-95 active:scale-95">
                    <span class="material-symbols-outlined">search</span>
                    Cari Venue
                </button>
            </div>
            <!-- Chips/Filters -->
            <div class="flex flex-wrap gap-sm mt-md pt-md border-t border-outline-variant/30">
                <span class="px-4 py-1.5 rounded-full bg-primary text-on-primary font-label-md flex items-center gap-1 cursor-pointer">
                    Futsal <span class="material-symbols-outlined text-[16px]">close</span>
                </span>
                <span class="px-4 py-1.5 rounded-full bg-surface-container border border-outline-variant text-on-surface-variant font-label-md hover:bg-secondary-container transition-colors cursor-pointer">Indoor</span>
                <span class="px-4 py-1.5 rounded-full bg-surface-container border border-outline-variant text-on-surface-variant font-label-md hover:bg-secondary-container transition-colors cursor-pointer">Ada AC</span>
                <span class="px-4 py-1.5 rounded-full bg-surface-container border border-outline-variant text-on-surface-variant font-label-md hover:bg-secondary-container transition-colors cursor-pointer">Sesi Pagi</span>
            </div>
        </div>
    </section>

    <!-- Main Title -->
    <div class="mb-md flex flex-col md:flex-row md:items-end justify-between gap-4 motion-hidden">
        <div>
            <h1 class="font-h2 text-h2 text-on-background">Venue Tersedia</h1>
            <p class="text-body-lg text-on-surface-variant">Ditemukan 24 fasilitas olahraga profesional di dekat Anda.</p>
        </div>
        <div class="flex items-center gap-2 text-label-md text-outline">
            <span class="material-symbols-outlined">sort</span>
            Urutkan: 
            <select class="bg-transparent font-bold text-on-surface focus:outline-none cursor-pointer">
                <option>Rekomendasi</option>
                <option>Harga: Terendah ke Tertinggi</option>
                <option>Penilaian</option>
            </select>
        </div>
    </div>

    <!-- Venue Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
        <!-- Card 1 -->
        <article class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_rgba(211,47,47,0.08)] border border-outline-variant/20 group hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all flex flex-col h-full motion-hidden delay-100">
            <div class="relative h-56 overflow-hidden">
                <img alt="Champion Futsal Center" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="wide shot of a professional indoor futsal court with bright lights and polished green flooring in a modern arena" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwJL8durSCNlaL__DnYui2ehrvuaF517XShJnybSlZKhq8Hvv3qpDdxb_bIPMLNAtxuQKVa9MTDL9y4SIcEpgp-bBED266PjaCJJ2jGSxmm8c9WEZjoZpYG0W5kHSqgPKlBQercIf3x1qviSBqumW0peujQ8VmqeWebkUF15MYpCmgp-aI6pw1yTm1Maewd1scAInsWLkGlgSu1XGNELEXfYaYQ7Y_CcLv2VkcAiIWulWUV2HLV0e_CnUQmbRfYDb1PZkO2F06JHw"/>
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px] text-yellow-500" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="text-label-md text-on-surface">4.8</span>
                </div>
                <div class="absolute top-4 right-4 bg-green-500 text-white text-[12px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Tersedia
                </div>
            </div>
            <div class="p-md flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-h3 text-h3 text-on-surface leading-tight">Champion Futsal Center</h3>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant mb-4">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span class="text-body-md">South Jakarta • 2.4 km</span>
                </div>
                <div class="mt-auto pt-md border-t border-outline-variant/30 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-1">Mulai dari</p>
                        <p class="text-primary font-bold text-lg">Rp 150.000 <span class="text-on-surface-variant font-normal text-sm">/ jam</span></p>
                    </div>
                    <a href="{{ route('lapangan.show', 1) }}" class="inline-block bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md transition-all hover:bg-primary/90 active:scale-95 shadow-md">Detail</a>
                </div>
            </div>
        </article>
        <!-- Card 2 -->
        <article class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_rgba(211,47,47,0.08)] border border-outline-variant/20 group hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all flex flex-col h-full motion-hidden delay-200">
            <div class="relative h-56 overflow-hidden">
                <img alt="Elite Basketball Arena" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="dramatic perspective of an indoor basketball court with premium wooden floor and bright overhead spotlights in a high-performance training facility" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbefGbxeY_gTs1cwq9UHemTR5WqRUeIb7zyCmTsWJz6ekGPR6RAefuHLdvsI3XcRb8D4w0OomXc5J3wk1b-Z4sC85nQJ6KmTifGyQMqyiCqzlC9ds9slpJ3IYFnRWxViEgVV7C-R0Hffw_LK2FuCTVXSuyN9fa0IqYc_Qr49WacaEl3tcRhV3QFwJ9c9gU6tlzPurHkFN_frZnR3q2p7qn3Q0XIGlK7yY9g9qZkTbQAm6YmcGCpyNLFarDFpdTxI48tj7TNzh9FyY"/>
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px] text-yellow-500" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="text-label-md text-on-surface">4.9</span>
                </div>
                <div class="absolute top-4 right-4 bg-red-600 text-white text-[12px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Hampir Penuh
                </div>
            </div>
            <div class="p-md flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-h3 text-h3 text-on-surface leading-tight">Elite Basketball Arena</h3>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant mb-4">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span class="text-body-md">Central Jakarta • 5.1 km</span>
                </div>
                <div class="mt-auto pt-md border-t border-outline-variant/30 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-1">Mulai dari</p>
                        <p class="text-primary font-bold text-lg">Rp 225.000 <span class="text-on-surface-variant font-normal text-sm">/ jam</span></p>
                    </div>
                    <a href="{{ route('lapangan.show', 2) }}" class="inline-block bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md transition-all hover:bg-primary/90 active:scale-95 shadow-md">Detail</a>
                </div>
            </div>
        </article>
        <!-- Card 3 -->
        <article class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_rgba(211,47,47,0.08)] border border-outline-variant/20 group hover:shadow-[0_8px_30px_rgba(211,47,47,0.12)] transition-all flex flex-col h-full motion-hidden delay-300">
            <div class="relative h-56 overflow-hidden">
                <img alt="Pro Shuttle Court" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="neatly arranged indoor badminton courts with blue floor mats and clear net lines under bright industrial lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYpfbC6uw0JFviJr4q8Zp-erVzs0WXq9tSPASn78RsTPrvGevEK3ZVUF9jEA3kbpDjyLR7sXyruz37oPI8C3ZCn8cCQZKQH65dMFHAZsFBLqk1aYZrLWxwproyCmybTlR6ouc-omn0-INTcPOtcuas0wBOHQOV__EWpGXJdQazVDSXnR_u1H33W67tjVLl7v5IauvlXZH7jKaWc3sJBap_x08FbRR5CZ8qJnon8YxTjOx2__LlI4VdKSXhC-IHlmPQk3LADAgRwjI"/>
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px] text-yellow-500" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="text-label-md text-on-surface">4.5</span>
                </div>
                <div class="absolute top-4 right-4 bg-green-500 text-white text-[12px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Tersedia
                </div>
            </div>
            <div class="p-md flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-h3 text-h3 text-on-surface leading-tight">Pro Shuttle Court</h3>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant mb-4">
                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                    <span class="text-body-md">East Jakarta • 1.2 km</span>
                </div>
                <div class="mt-auto pt-md border-t border-outline-variant/30 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-1">Mulai dari</p>
                        <p class="text-primary font-bold text-lg">Rp 80.000 <span class="text-on-surface-variant font-normal text-sm">/ jam</span></p>
                    </div>
                    <a href="{{ route('lapangan.show', 3) }}" class="inline-block bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md transition-all hover:bg-primary/90 active:scale-95 shadow-md">Detail</a>
                </div>
            </div>
        </article>
    </div>

    <!-- Pagination -->
    <div class="mt-xl flex items-center justify-center gap-2">
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all">
            <span class="material-symbols-outlined">chevron_left</span>
        </button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-on-primary font-bold">1</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all">2</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all">3</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-outline-variant text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all">
            <span class="material-symbols-outlined">chevron_right</span>
        </button>
    </div>
</main>
@endsection
