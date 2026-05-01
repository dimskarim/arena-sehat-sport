@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Tambah User
    </h2>

    <nav>
        <a href="{{ route('admin.users.index') }}" class="text-primary hover:underline">Kembali</a>
    </nav>
</div>

<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="p-6.5">
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Nama <span class="text-meta-1">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('name') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Email <span class="text-meta-1">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('email') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">No. HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('phone') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Role <span class="text-meta-1">*</span></label>
                <select name="role" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Password <span class="text-meta-1">*</span></label>
                <input type="password" name="password" required class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('password') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4.5">
                <label class="mb-2.5 block text-black dark:text-white">Foto Profil</label>
                <input type="file" name="foto_profile" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary dark:border-form-strokedark dark:bg-form-input" />
                @error('foto_profile') <span class="text-meta-1 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">Simpan</button>
        </div>
    </form>
</div>
@endsection