@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Ubah Jadwal Operasional
    </h2>

    <nav>
        <a href="{{ route('admin.oprational-waktus.index') }}" class="text-primary hover:underline">Kembali</a>
    </nav>
</div>

<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <form action="{{ route('admin.oprational-waktus.update', $item->id) }}" method="POST">
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
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Hari Operasional <span class="text-meta-1">*</span></label>
                <select name="hari" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="">Pilih Hari Operasional</option>
                    <option value="Senin" {{ old('hari', $item->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ old('hari', $item->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ old('hari', $item->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ old('hari', $item->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ old('hari', $item->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ old('hari', $item->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="Minggu" {{ old('hari', $item->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                </select>
                @error('hari') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Jam Buka <span class="text-meta-1">*</span></label>
                <input type="time" name="waktu_buka" value="{{ old('waktu_buka', substr($item->waktu_buka, 0, 5)) }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('waktu_buka') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Jam Tutup <span class="text-meta-1">*</span></label>
                <input type="time" name="waktu_tutup" value="{{ old('waktu_tutup', substr($item->waktu_tutup, 0, 5)) }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('waktu_tutup') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">Perbarui Jadwal</button>
        </div>
    </form>
</div>
@endsection