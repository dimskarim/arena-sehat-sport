@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.payments.index') }}" class="hover:text-red-700 dark:hover:text-red-400 transition-colors">Payment</a>
                <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-900 dark:text-white font-semibold">Tambah Pembayaran</span>
            </div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white">Tambah Pembayaran Baru</h1>
            <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Buat data pembayaran baru secara manual.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Batal
            </a>
            <button type="submit" form="createForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95 dark:bg-red-600 dark:hover:bg-red-700">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Simpan Pembayaran
            </button>
        </div>
    </div>
    <form id="createForm" action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 dark:border-gray-700">
                <svg class="text-red-700 dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="font-['Lexend'] text-base font-semibold text-slate-900 dark:text-white">Informasi Pembayaran</h2>
            </div>
            
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Booking <span class="text-red-600">*</span>
                    </label>
                    <select name="booking_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 tom-select-custom">
                        <option value="">Pilih Booking</option>
                        @foreach($bookings as $booking)
                            <option value="{{ $booking->id }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>Booking #{{ $booking->id }} - {{ $booking->user->name ?? 'Unknown' }} - {{ $booking->lapangan->name ?? 'Unknown' }}</option>
                        @endforeach
                    </select>
                    @error('booking_id') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Metode Pembayaran <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="payment_method" value="{{ old('payment_method') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" />
                    @error('payment_method') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Tanggal Pembayaran <span class="text-red-600">*</span>
                    </label>
                    <input type="datetime-local" name="tanggal_payment" value="{{ old('tanggal_payment') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" />
                    @error('tanggal_payment') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Status <span class="text-red-600">*</span>
                    </label>
                    <select name="status" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30 tom-select-custom">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="menunggu_verifikasi" {{ old('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed / Ditolak</option>
                        <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    @error('status') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                        Bukti Pembayaran (Opsional)
                    </label>
                    <input type="file" name="butki_payment" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" />
                    @error('butki_payment') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<style>
    .ts-wrapper.form-control { border: none; padding: 0; background: transparent; }
    .ts-control { border-radius: 0.5rem !important; padding: 0.75rem 1rem !important; border: 1px solid #e2e8f0 !important; background-color: #f8fafc !important; font-size: 0.875rem !important; }
    .dark .ts-control { border-color: #4b5563 !important; background-color: rgba(55, 65, 81, 0.5) !important; color: white !important; }
    .dark .ts-dropdown { background-color: #1f2937 !important; border-color: #4b5563 !important; color: white !important; }
    .dark .ts-dropdown .option:hover, .dark .ts-dropdown .active { background-color: rgba(75, 85, 99, 0.8) !important; color: white !important; }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.tom-select-custom').forEach((el) => {
            if (!el.tomselect) {
                new TomSelect(el, {
                    create: false,
                    sortField: { field: "text", direction: "asc" }
                });
            }
        });
    });
</script>
@endsection
