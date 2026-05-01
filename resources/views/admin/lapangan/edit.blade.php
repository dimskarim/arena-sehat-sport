@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Edit Lapangan
    </h2>

    <nav>
        <a href="{{ route('admin.lapangans.index') }}" class="text-primary hover:underline">Kembali</a>
    </nav>
</div>

<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <form action="{{ route('admin.lapangans.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="p-6.5">
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Kategori <span class="text-meta-1">*</span></label>
                <select name="kategori_id" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id', $item->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
                    @endforeach
                </select>
                @error('kategori_id') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Nama Lapangan <span class="text-meta-1">*</span></label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('name') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                @error('deskripsi') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Harga (Rp) <span class="text-meta-1">*</span></label>
                <input type="number" name="harga" value="{{ old('harga', $item->harga) }}" required min="0" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('harga') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Status <span class="text-meta-1">*</span></label>
                <select name="status" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="tersedia" {{ old('status', $item->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status', $item->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
                @error('status') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Gambar Utama (Optional)</label>
                <input type="file" name="gambar" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('gambar') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">Update</button>
        </div>
    </form>
</div>
@endsection