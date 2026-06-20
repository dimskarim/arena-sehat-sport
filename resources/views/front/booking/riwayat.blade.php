@extends('layouts.front')

@section('title', 'Riwayat Pesanan - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 md:pb-8 px-4 max-w-7xl mx-auto">
    <!-- User Profile Summary Section -->
    <section class="mb-12 motion-hidden">
        <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-3xl shadow-2xl p-8 flex flex-col md:flex-row items-center md:items-start gap-8 relative overflow-hidden">
            <!-- Background Decorative Elements -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white opacity-5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 bg-black opacity-10 rounded-full blur-xl"></div>
            
            <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-white/20 shadow-xl shrink-0 z-10 bg-white">
                <img alt="User Profile" class="w-full h-full object-cover" data-alt="Close-up portrait of a fit young man with a confident expression, outdoor setting with soft athletic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvqEVNeQU59-aGwEmGAOo6KOEDwCry4R0G5_Wugu3osyqdrLaR-_jtlLBfOx2vmPgpXJkV4WpTEEc6h8YoJAEYqCS_Iuun769a_NsAuajrv2pr2Qhj9w0Zd0oGlebxFoCyxGZptogTAyWemgT3TVWywf69WWTFyRxfvae1nE5xG7tIY5xHLJ7zcGchBEsw_A7Jl_kM0Otj0xb92sVFQU90HCs0Y2hGGGzPW7OyriOrLAVf2fvbhtPGoT1VSnlgn50EXmM2lfF3xFw"/>
            </div>
            <div class="flex-grow text-center md:text-left z-10 text-white">
                <p class="text-red-200 font-bold tracking-widest uppercase text-sm mb-1">Pemain Setia</p>
                <h1 class="text-4xl md:text-5xl font-black font-['Lexend'] mb-2">Halo, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
                <p class="text-red-100/80 mb-6 font-medium">Member sejak {{ Auth::user()->created_at->format('Y') }}</p>
                
                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                    <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-white text-red-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-red-200 uppercase tracking-wider">Total Transaksi</span>
                            <span class="text-2xl font-black font-['Lexend'] leading-none">{{ $bookings->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Booking History Canvas -->
    <section class="motion-hidden">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-black font-['Lexend'] text-gray-900 dark:text-white">Riwayat Booking</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Daftar tempat olahraga yang pernah Anda pesan.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 px-5 py-2.5 rounded-xl font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span> Filter
                </button>
                <a href="{{ route('lapangan.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-red-600/20 active:scale-95 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">add</span> Booking Baru
                </a>
            </div>
        </div>
        
        <!-- List of Bookings using Asymmetric Bento-style Layout for Visual Interest -->
        <div class="grid grid-cols-1 gap-6">
            @forelse($bookings as $booking)
            <div class="group bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-red-200 dark:hover:border-red-900/50 shadow-lg shadow-gray-200/20 dark:shadow-black/20 hover:shadow-xl hover:shadow-red-900/10 transition-all overflow-hidden flex flex-col md:flex-row motion-hidden delay-100 relative {{ $booking->status == 'cancelled' || $booking->status == 'rejected' ? 'opacity-70 grayscale-[0.5]' : '' }}">
                <div class="w-full md:w-56 h-48 md:h-auto overflow-hidden relative shrink-0">
                    @if($booking->lapangan->gambarLapangans->count() > 0)
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ str_starts_with($booking->lapangan->gambarLapangans->first()->gambar_file, 'http') ? $booking->lapangan->gambarLapangans->first()->gambar_file : asset($booking->lapangan->gambarLapangans->first()->gambar_file) }}"/>
                    @else
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAV9H9rJvo6oQ8G-__bzozxiJisQauB4SjBWscs5_c_4nzQzcrc871-IvGUnNBPyoADZGNpfO9eRQ-PcNr6J8otYyYsrv4awVMoso_s1UW9PQXZsMtIJdNvFVPsB_K3sCYR8_dphmX3HpDYEvX6kzsQZymvTQO0M5CMZKYHoNm5UD6kz1AcrCUsYeSDqWo65Rwmde3Qs5gk2-oIAzeJkNg7vRkIOdotiNvEOYcPaqQx5X9m84bQ_SxdyHaBqspJEFoemIVx1X3QSJ0"/>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent md:hidden"></div>
                    
                    <!-- Mobile status badge inside image -->
                    <div class="absolute top-4 right-4 md:hidden">
                        @if($booking->status == 'completed' || $booking->status == 'success' || $booking->status == 'paid')
                        <span class="px-3 py-1 rounded-lg bg-green-500 text-white font-bold text-xs shadow-lg flex items-center gap-1 backdrop-blur-md">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai
                        </span>
                        @elseif($booking->status == 'confirmed' || $booking->status == 'approved')
                        <span class="px-3 py-1 rounded-lg bg-blue-500 text-white font-bold text-xs shadow-lg flex items-center gap-1 backdrop-blur-md">
                            <span class="material-symbols-outlined text-[14px]">thumb_up</span> Dikonfirmasi
                        </span>
                        @elseif($booking->status == 'pending')
                        <span class="px-3 py-1 rounded-lg bg-yellow-500 text-white font-bold text-xs shadow-lg flex items-center gap-1 backdrop-blur-md">
                            <span class="material-symbols-outlined text-[14px]">schedule</span> Menunggu
                        </span>
                        @else
                        <span class="px-3 py-1 rounded-lg bg-red-500 text-white font-bold text-xs shadow-lg flex items-center gap-1 backdrop-blur-md">
                            <span class="material-symbols-outlined text-[14px]">cancel</span> Batal
                        </span>
                        @endif
                    </div>
                </div>
                
                <div class="flex-grow p-6 md:p-8 flex flex-col justify-between gap-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs font-black text-red-600 dark:text-red-400 tracking-widest uppercase mb-2 block">{{ $booking->lapangan->kategori->name ?? 'Venue' }}</span>
                            <h3 class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white leading-tight mb-3 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">{{ $booking->lapangan->name }}</h3>
                            
                            <div class="flex flex-wrap items-center gap-4 text-gray-500 dark:text-gray-400">
                                <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-800 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                                    <span class="material-symbols-outlined text-[16px] text-gray-400">calendar_month</span> 
                                    <span class="font-bold text-sm text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-800 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                                    <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span> 
                                    <span class="font-bold text-sm text-gray-700 dark:text-gray-300">
                                        @foreach($booking->bookingDetails as $detail)
                                            {{ substr($detail->slotWaktu->waktu_mulai, 0, 5) }}@if(!$loop->last), @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Desktop status badge -->
                        <div class="hidden md:block">
                            @if($booking->status == 'completed' || $booking->status == 'success' || $booking->status == 'paid')
                            <span class="px-3 py-1.5 rounded-lg bg-green-50 text-green-700 border border-green-200 font-bold text-xs flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">check_circle</span> Selesai
                            </span>
                            @elseif($booking->status == 'confirmed' || $booking->status == 'approved')
                            <span class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 border border-blue-200 font-bold text-xs flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">thumb_up</span> Dikonfirmasi
                            </span>
                            @elseif($booking->status == 'pending')
                            <span class="px-3 py-1.5 rounded-lg bg-yellow-50 text-yellow-700 border border-yellow-200 font-bold text-xs flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">schedule</span> Menunggu
                            </span>
                            @else
                            <span class="px-3 py-1.5 rounded-lg bg-red-50 text-red-700 border border-red-200 font-bold text-xs flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">cancel</span> Batal
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-dashed border-gray-200 dark:border-gray-700 flex justify-between items-end">
                        <div class="space-y-1">
                            <span class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest text-xs block">Total Pembayaran</span>
                            <span class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white leading-none block">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($booking->status == 'pending')
                        <a href="{{ route('booking.payment', $booking->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-md shadow-red-600/20 active:scale-95 transition-all text-sm flex items-center gap-2">
                            Bayar Sekarang <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                        @else
                        <button class="bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 px-5 py-2.5 rounded-xl font-bold active:scale-95 transition-all text-sm flex items-center gap-2">
                            Lihat Detail
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-gray-50 dark:bg-gray-800/30 rounded-3xl border border-dashed border-gray-200 dark:border-gray-700">
                <div class="w-24 h-24 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                    <span class="material-symbols-outlined text-5xl text-gray-300 dark:text-gray-600">history</span>
                </div>
                <h3 class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white mb-2">Belum Ada Transaksi</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-sm mx-auto">Anda belum pernah melakukan pemesanan tempat. Yuk, mulai aktivitas olahraga pertamamu!</p>
                <a href="{{ route('lapangan.index') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-3.5 rounded-xl font-bold shadow-lg shadow-red-600/20 active:scale-95 transition-all">
                    Eksplor Venue <span class="material-symbols-outlined text-[18px]">search</span>
                </a>
            </div>
            @endforelse
        </div>
    </section>
</main>
@endsection
