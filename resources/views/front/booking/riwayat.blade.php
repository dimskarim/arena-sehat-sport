@extends('layouts.front')

@section('title', 'Riwayat Pesanan - ArenaFlow')

@section('content')
<main class="pt-24 pb-20 md:pb-8 px-4 max-w-7xl mx-auto">
    <!-- User Profile Summary Section -->
    <section class="mb-lg motion-hidden">
        <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] p-md flex flex-col md:flex-row items-center md:items-start gap-md border border-surface-container">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-secondary-container">
                <img alt="User Profile" class="w-full h-full object-cover" data-alt="Close-up portrait of a fit young man with a confident expression, outdoor setting with soft athletic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvqEVNeQU59-aGwEmGAOo6KOEDwCry4R0G5_Wugu3osyqdrLaR-_jtlLBfOx2vmPgpXJkV4WpTEEc6h8YoJAEYqCS_Iuun769a_NsAuajrv2pr2Qhj9w0Zd0oGlebxFoCyxGZptogTAyWemgT3TVWywf69WWTFyRxfvae1nE5xG7tIY5xHLJ7zcGchBEsw_A7Jl_kM0Otj0xb92sVFQU90HCs0Y2hGGGzPW7OyriOrLAVf2fvbhtPGoT1VSnlgn50EXmM2lfF3xFw"/>
            </div>
            <div class="flex-grow text-center md:text-left">
                <h1 class="font-h2 text-h2 text-on-background mb-xs">Selamat datang kembali, {{ explode(' ', Auth::user()->name)[0] }}</h1>
                <p class="font-body-md text-body-md text-outline mb-sm">Member sejak {{ Auth::user()->created_at->format('Y') }} • {{ $bookings->count() }} Transaksi</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-sm">
                    <div class="bg-red-50 px-4 py-2 rounded-lg border border-red-100">
                        <span class="block font-label-md text-primary">Pesanan Berhasil</span>
                        <span class="font-h3 text-h3">{{ $bookings->where('status', 'success')->count() }}</span>
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
            @forelse($bookings as $booking)
            <div class="group bg-surface-container-lowest rounded-xl border border-surface-container hover:shadow-[0_4px_20px_rgba(211,47,47,0.12)] transition-all overflow-hidden flex flex-col md:flex-row motion-hidden delay-100">
                <div class="w-full md:w-48 h-40 md:h-auto overflow-hidden {{ $booking->status == 'cancelled' || $booking->status == 'rejected' ? 'grayscale opacity-80' : '' }}">
                    @if($booking->lapangan->gambarLapangans->count() > 0)
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform" src="{{ asset('storage/' . $booking->lapangan->gambarLapangans->first()->image_path) }}"/>
                    @else
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAV9H9rJvo6oQ8G-__bzozxiJisQauB4SjBWscs5_c_4nzQzcrc871-IvGUnNBPyoADZGNpfO9eRQ-PcNr6J8otYyYsrv4awVMoso_s1UW9PQXZsMtIJdNvFVPsB_K3sCYR8_dphmX3HpDYEvX6kzsQZymvTQO0M5CMZKYHoNm5UD6kz1AcrCUsYeSDqWo65Rwmde3Qs5gk2-oIAzeJkNg7vRkIOdotiNvEOYcPaqQx5X9m84bQ_SxdyHaBqspJEFoemIVx1X3QSJ0"/>
                    @endif
                </div>
                <div class="flex-grow p-md flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-primary tracking-widest uppercase">{{ $booking->lapangan->kategori->name ?? 'Olahraga' }}</span>
                        <h3 class="font-h3 text-h3 text-on-background">{{ $booking->lapangan->name }}</h3>
                        <div class="flex items-center gap-sm text-outline">
                            <span class="flex items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span> {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                            </span>
                            <span class="flex flex-wrap items-center gap-xs font-label-md">
                                <span class="material-symbols-outlined text-[18px]" data-icon="schedule">schedule</span> 
                                @foreach($booking->bookingDetails as $detail)
                                    {{ substr($detail->slotWaktu->waktu_mulai, 0, 5) }}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col md:items-end gap-sm w-full md:w-auto">
                        @if($booking->status == 'completed' || $booking->status == 'success' || $booking->status == 'paid')
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="check_circle" style="font-variation-settings: 'FILL' 1;">check_circle</span> Completed
                        </span>
                        @elseif($booking->status == 'confirmed' || $booking->status == 'approved')
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="thumb_up" style="font-variation-settings: 'FILL' 1;">thumb_up</span> Confirmed
                        </span>
                        @elseif($booking->status == 'pending')
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="pending" style="font-variation-settings: 'FILL' 1;">pending</span> Pending
                        </span>
                        @else
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-label-md flex items-center gap-xs self-start md:self-end">
                            <span class="material-symbols-outlined text-[16px] font-bold" data-icon="cancel" style="font-variation-settings: 'FILL' 1;">cancel</span> Cancel
                        </span>
                        @endif
                        <div class="flex justify-between md:block">
                            <span class="text-outline text-label-md block md:text-right">Total Harga</span>
                            <span class="text-h3 font-h3 text-on-background">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant bg-surface-container-low rounded-xl border border-outline-variant">
                <span class="material-symbols-outlined text-5xl mb-4 text-outline">history</span>
                <h3 class="text-h3 font-h3 mb-2">Belum ada riwayat</h3>
                <p>Anda belum pernah melakukan pemesanan.</p>
                <a href="{{ route('lapangan.index') }}" class="inline-block mt-4 bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary-container transition-colors">Eksplor Venue</a>
            </div>
            @endforelse
        </div>
    </section>
</main>
@endsection
