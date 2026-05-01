@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Edit Pembayaran
    </h2>

    <nav>
        <a href="{{ route('admin.payments.index') }}" class="text-primary hover:underline">Kembali</a>
    </nav>
</div>

<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <form action="{{ route('admin.payments.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="p-6.5">
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Booking <span class="text-meta-1">*</span></label>
                <select name="booking_id" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="">Pilih Booking</option>
                    @foreach($bookings as $booking)
                        <option value="{{ $booking->id }}" {{ old('booking_id', $item->booking_id) == $booking->id ? 'selected' : '' }}>Booking #{{ $booking->id }} - {{ $booking->user->name ?? 'Unknown' }} - {{ $booking->lapangan->name ?? 'Unknown' }}</option>
                    @endforeach
                </select>
                @error('booking_id') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Metode Pembayaran <span class="text-meta-1">*</span></label>
                <input type="text" name="payment_method" value="{{ old('payment_method', $item->payment_method) }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('payment_method') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Tanggal Pembayaran <span class="text-meta-1">*</span></label>
                <input type="datetime-local" name="tanggal_payment" value="{{ old('tanggal_payment', $item->tanggal_payment ? date('Y-m-d\TH:i', strtotime($item->tanggal_payment)) : '') }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('tanggal_payment') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Status <span class="text-meta-1">*</span></label>
                <select name="status" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('status', $item->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ old('status', $item->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ old('status', $item->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
                @error('status') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Bukti Pembayaran (Opsional)</label>
                @if($item->butki_payment)
                    <div class="mb-2">
                        <img src="{{ $item->butki_payment }}" alt="Bukti Pembayaran" class="h-20 w-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="butki_payment" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('butki_payment') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">Update</button>
        </div>
    </form>
</div>
@endsection