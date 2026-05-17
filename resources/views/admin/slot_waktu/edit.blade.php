@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Ubah Slot Waktu
    </h2>

    <nav>
        <a href="{{ route('admin.slot-waktus.index') }}" class="text-primary hover:underline">Kembali</a>
    </nav>
</div>

<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <form action="{{ route('admin.slot-waktus.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-6.5">
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Venue Lapangan <span class="text-meta-1">*</span></label>
                <select name="lapangan_id" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="">Pilih Venue</option>
                    @foreach($lapangans as $lap)
                        <option value="{{ $lap->id }}" {{ old('lapangan_id', $item->lapangan_id) == $lap->id ? 'selected' : '' }}>{{ $lap->name }}</option>
                    @endforeach
                </select>
                @error('lapangan_id') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Jam Mulai <span class="text-meta-1">*</span></label>
                <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai', substr($item->waktu_mulai, 0, 5)) }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('waktu_mulai') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Jam Selesai <span class="text-meta-1">*</span></label>
                <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', substr($item->waktu_selesai, 0, 5)) }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('waktu_selesai') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">Perbarui Slot</button>
        </div>
    </form>
</div>
@endsection