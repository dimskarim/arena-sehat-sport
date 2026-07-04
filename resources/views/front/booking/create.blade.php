@extends('layouts.front')

@section('title', 'Booking Checkout - ArenaFlow')

@push('styles')
<style>
    .step-active {
        color: #af101a;
    }

    .booking-gradient {
        background: linear-gradient(135deg, #ffffff 0%, #fff2f0 100%);
    }
</style>
@endpush

@section('content')
<main class="pt-24 pb-32 md:pb-16 px-4 max-w-7xl mx-auto">
    <!-- Progress Stepper -->
    <div class="mb-12 flex items-center justify-center space-x-4 motion-hidden">
        <div class="flex items-center gap-2 text-red-600 dark:text-red-500 font-bold">
            <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            <span class="text-sm uppercase tracking-wider">Pilihan</span>
        </div>
        <div class="w-16 h-1 bg-gradient-to-r from-red-600 to-red-200 dark:from-red-500 dark:to-gray-700 rounded-full"></div>
        <div class="flex items-center gap-2 text-red-600 dark:text-red-500 font-bold">
            <span class="w-7 h-7 rounded-full bg-red-600 dark:bg-red-500 text-white flex items-center justify-center text-sm shadow-[0_0_10px_rgba(220,38,38,0.5)]">2</span>
            <span class="text-sm uppercase tracking-wider">Informasi</span>
        </div>
        <div class="w-16 h-1 bg-gray-200 dark:bg-gray-800 rounded-full"></div>
        <div class="flex items-center gap-2 text-gray-400 dark:text-gray-500 font-bold">
            <span class="w-7 h-7 rounded-full border-2 border-gray-300 dark:border-gray-600 flex items-center justify-center text-sm">3</span>
            <span class="text-sm uppercase tracking-wider">Pembayaran</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Form Section -->
        <div class="lg:col-span-7 space-y-8">
            <section class="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-black/20 border border-gray-100 dark:border-gray-800 motion-hidden delay-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-600 to-red-400"></div>
                <h2 class="text-2xl font-black font-['Lexend'] mb-6 text-gray-900 dark:text-white">Informasi Kontak</h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-2" for="full_name">Nama Lengkap</label>
                        <input class="w-full h-14 px-5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:bg-white dark:focus:bg-gray-900 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 text-gray-900 dark:text-white font-medium transition-all" id="full_name" placeholder="John Doe" type="text" value="{{ Auth::user()->name }}" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-2" for="email">Email</label>
                        <input class="w-full h-14 px-5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:bg-white dark:focus:bg-gray-900 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 text-gray-900 dark:text-white font-medium transition-all" id="email" placeholder="contoh@email.com" type="email" value="{{ Auth::user()->email }}" />
                    </div>
                </div>
            </section>

            <section class="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 motion-hidden delay-200">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-600 dark:text-red-500">
                        <span class="material-symbols-outlined text-[22px]">info</span>
                    </div>
                    <h2 class="text-2xl font-black font-['Lexend'] text-gray-900 dark:text-white">Catatan Penting</h2>
                </div>
                <ul class="space-y-4 text-gray-600 dark:text-gray-300">
                    <li class="flex items-start gap-3 bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl border border-gray-100 dark:border-gray-800">
                        <span class="material-symbols-outlined text-[20px] text-red-600 dark:text-red-400 mt-0.5">check_circle</span>
                        <span class="font-medium text-sm md:text-base">Harap tiba 15 menit sebelum waktu pesanan Anda.</span>
                    </li>
                    <li class="flex items-start gap-3 bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl border border-gray-100 dark:border-gray-800">
                        <span class="material-symbols-outlined text-[20px] text-red-600 dark:text-red-400 mt-0.5">check_circle</span>
                        <span class="font-medium text-sm md:text-base">Bawa perlengkapan sendiri atau sewa di lokasi (jika tersedia).</span>
                    </li>
                </ul>
            </section>
        </div>

        <!-- Sidebar / Order Summary -->
        <div class="lg:col-span-5">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                @foreach($slots as $slot)
                <input type="hidden" name="slot_ids[]" value="{{ $slot->id }}">
                @endforeach
                <aside class="sticky top-24 space-y-6 motion-hidden">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl shadow-red-900/5 dark:shadow-black/40 border border-gray-100 dark:border-gray-800 overflow-hidden relative">
                        <div class="h-40 w-full relative">
                            @if($lapangan->gambarLapangans->count() > 0)
                            <img class="w-full h-full object-cover" src="{{ str_starts_with($lapangan->gambarLapangans->first()->gambar_file, 'http') ? $lapangan->gambarLapangans->first()->gambar_file : asset($lapangan->gambarLapangans->first()->gambar_file) }}" />
                            @else
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBT7bo2CApfbZ65nAXc24qdZzcB3f6aumWciodlliUukkBK24UdbMEcpm6OVp_h8lWQc3KKWi0HRj5XmBEmH8rT11TMUzdEC31p7Kuoh8I_023XQ-cV98G7R95upzZIsrbVDeCZQGy3dLF0rQzQEag9opjbAn_04IzHQpxo0t59Ha6qUl8l9ytotV_fzOHNNH7Za5Ka7q-Tvm3o1Xi4hAWpSHlc5dGIT6Pyq0z_zKu2vEuhJPXGaEszeqRUY_dWRjhFd9p1DgotLXU" />
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-6">
                                <div>
                                    <span class="text-red-400 text-xs font-bold uppercase tracking-widest mb-1 block">{{ $lapangan->kategori->name ?? 'Venue' }}</span>
                                    <h3 class="text-white font-black font-['Lexend'] text-2xl leading-tight">{{ $lapangan->name }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 md:p-8 space-y-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                        <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                                        <span class="font-bold text-sm uppercase tracking-wider">Tanggal</span>
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 px-3 py-1 rounded-lg">{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                        <span class="material-symbols-outlined text-[20px]">schedule</span>
                                        <span class="font-bold text-sm uppercase tracking-wider">Waktu</span>
                                    </div>
                                    <div class="text-right flex flex-col gap-1">
                                        @foreach($slots as $slot)
                                        <span class="inline-block font-bold text-gray-900 dark:text-white bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-100 dark:border-red-900/50 px-3 py-1 rounded-lg text-sm">{{ substr($slot->waktu_mulai, 0, 5) }} - {{ substr($slot->waktu_selesai, 0, 5) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <hr class="border-gray-100 dark:border-gray-800" />

                            <div class="space-y-3">
                                <div class="flex justify-between text-gray-500 dark:text-gray-400 font-medium text-sm">
                                    <span>Subtotal</span>
                                    <span class="text-gray-900 dark:text-white">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-500 dark:text-gray-400 font-medium text-sm">
                                    <span>Biaya Layanan</span>
                                    <span class="text-gray-900 dark:text-white">Rp {{ number_format($biayaLayanan, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-end pt-4 border-t border-dashed border-gray-200 dark:border-gray-700">
                                    <span class="font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest text-xs">Total Pembayaran</span>
                                    <span class="font-black font-['Lexend'] text-3xl text-red-600 dark:text-red-500 leading-none">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="space-y-3 pt-2">
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Metode Pembayaran</label>
                                <div class="relative w-full z-40">
                                    <!-- Hidden Select -->
                                    <select name="payment_method" id="payment-select" class="hidden" required>
                                        <option value="transfer" selected>Transfer Bank (BCA/Mandiri/BNI)</option>
                                        <option value="ewallet">E-Wallet (GoPay/OVO/Dana)</option>
                                    </select>

                                    <!-- Custom Dropdown Button -->
                                    <div id="custom-dropdown-payment-btn" class="flex items-center justify-between bg-white hover:bg-blue-50 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition-colors px-5 py-4 rounded-xl border border-blue-500 cursor-pointer w-full">
                                        <span class="text-gray-900 dark:text-white font-bold text-[15px]" id="custom-dropdown-payment-text">
                                            Transfer Bank (BCA/Mandiri/BNI)
                                        </span>
                                        <svg id="custom-dropdown-payment-icon" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>

                                    <!-- Custom Dropdown Menu -->
                                    <div id="custom-dropdown-payment-menu" class="absolute left-0 top-[110%] w-full bg-[#f9fafa] dark:bg-gray-800 rounded-xl shadow-[0_4px_15px_rgba(0,0,0,0.08)] border border-slate-100 dark:border-gray-700 hidden z-40">
                                        <!-- Upward Pointer -->
                                        <div class="absolute -top-1.5 left-8 w-3 h-3 bg-[#f9fafa] dark:bg-gray-800 transform rotate-45 shadow-[-2px_-2px_4px_rgba(0,0,0,0.02)] border-t border-l border-gray-100 dark:border-gray-700"></div>

                                        <ul class="relative z-10 py-2" id="custom-dropdown-payment-options">
                                            <li data-value="transfer" class="px-5 py-3 text-[15px] cursor-pointer transition-colors bg-[#f0f2f5] dark:bg-red-900/20 text-blue-600 dark:text-red-400 font-bold">Transfer Bank (BCA/Mandiri/BNI)</li>
                                            <li data-value="ewallet" class="px-5 py-3 text-[15px] cursor-pointer transition-colors text-gray-500 dark:text-gray-400 font-medium hover:bg-[#f0f2f5] dark:hover:bg-red-900/30 hover:text-blue-600 dark:hover:text-red-400">E-Wallet (GoPay/OVO/Dana)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 text-white h-14 rounded-xl font-bold text-lg active:scale-95 transition-all shadow-lg shadow-red-600/20 flex items-center justify-center gap-2 group">
                                Bayar Sekarang
                                <span class="material-symbols-outlined transition-transform group-hover:translate-x-1" data-icon="arrow_forward">arrow_forward</span>
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl flex items-start gap-3 border border-gray-200 dark:border-gray-700">
                        <span class="material-symbols-outlined text-green-500 mt-0.5" data-icon="lock">lock</span>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Pembayaran Anda diamankan dengan enkripsi standar industri. ArenaFlow tidak menyimpan detail kartu atau rekening Anda.</p>
                    </div>
                </aside>
            </form>
        </div>
    </div>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payBtn = document.getElementById('custom-dropdown-payment-btn');
        const payMenu = document.getElementById('custom-dropdown-payment-menu');
        const payIcon = document.getElementById('custom-dropdown-payment-icon');
        const paySelect = document.getElementById('payment-select');
        const payText = document.getElementById('custom-dropdown-payment-text');
        const payOptions = payMenu.querySelectorAll('li');

        payBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            payMenu.classList.toggle('hidden');
            if (payMenu.classList.contains('hidden')) {
                payIcon.classList.remove('rotate-180');
            } else {
                payIcon.classList.add('rotate-180');
            }
        });

        document.addEventListener('click', function(e) {
            if (!payBtn.contains(e.target) && !payMenu.contains(e.target)) {
                payMenu.classList.add('hidden');
                payIcon.classList.remove('rotate-180');
            }
        });

        payOptions.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.innerText;

                // Update select value
                paySelect.value = value;

                // Update button text
                payText.innerText = text;

                // Update active styles
                payOptions.forEach(opt => {
                    opt.classList.remove('bg-[#f0f2f5]', 'dark:bg-red-900/20', 'text-blue-600', 'dark:text-red-400', 'font-bold');
                    opt.classList.add('text-gray-500', 'dark:text-gray-400', 'font-medium', 'hover:bg-[#f0f2f5]', 'dark:hover:bg-red-900/30', 'hover:text-blue-600', 'dark:hover:text-red-400');
                });

                this.classList.remove('text-gray-500', 'dark:text-gray-400', 'font-medium', 'hover:bg-[#f0f2f5]', 'dark:hover:bg-red-900/30', 'hover:text-blue-600', 'dark:hover:text-red-400');
                this.classList.add('bg-[#f0f2f5]', 'dark:bg-red-900/20', 'text-blue-600', 'dark:text-red-400', 'font-bold');

                // Close menu
                payMenu.classList.add('hidden');
                payIcon.classList.remove('rotate-180');
            });
        });
    });
</script>
@endpush
@endsection