@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Edit History Booking
    </h2>

    <nav>
        <a href="{{ route('admin.bookings.index') }}" class="text-primary hover:underline">Kembali</a>
    </nav>
</div>

<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <form action="{{ route('admin.bookings.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6.5">
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">User <span class="text-meta-1">*</span></label>
                <select name="user_id" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="">Pilih User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Lapangan <span class="text-meta-1">*</span></label>
                <select name="lapangan_id" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="">Pilih Lapangan</option>
                    @foreach($lapangans as $lap)
                        <option value="{{ $lap->id }}" {{ old('lapangan_id', $item->lapangan_id) == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                    @endforeach
                </select>
                @error('lapangan_id') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Tanggal Booking <span class="text-meta-1">*</span></label>
                <input type="date" name="tanggal_booking" value="{{ old('tanggal_booking', $item->tanggal_booking) }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('tanggal_booking') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Total Harga (Rp) <span class="text-meta-1">*</span></label>
                <input type="number" name="total_harga" value="{{ old('total_harga', $item->total_harga) }}" required min="0" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('total_harga') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Status <span class="text-meta-1">*</span></label>
                <select name="status" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $item->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ old('status', $item->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status', $item->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">Update</button>
        </div>
    </form>
</div>
@endsection