@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c] dark:text-white">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] dark:text-gray-400 mb-2">
                <a href="{{ route('admin.users.index') }}" class="hover:text-[#af101a] dark:hover:text-red-400 transition-colors flex items-center gap-1">
                    <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Daftar
                </a>
                <span class="text-[#e4beba] dark:text-gray-600">/</span>
                <span class="text-[#1b1c1c] dark:text-white font-semibold">Ubah Pengguna</span>
            </div>
            <h1 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] dark:text-white tracking-tight">Ubah Profil Pengguna</h1>
            <p class="text-[#5b403d] dark:text-gray-400 mt-1 text-sm">Perbarui informasi pribadi, peran, dan pengaturan akun.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-[#e4beba] dark:border-gray-700 text-[#5b403d] dark:text-gray-300 text-sm font-semibold rounded-xl hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors shadow-sm">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
            <button type="submit" form="userEditForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] dark:bg-red-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 dark:hover:bg-red-700 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT COLUMN: Profile Card + Quick Actions --}}
        <div class="col-span-12 lg:col-span-4 space-y-6">

            {{-- Profile Card --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700 flex flex-col items-center text-center">
                <div class="relative mb-5">
                    @if($item->foto_profile)
                    @php $imgUrl = str_starts_with($item->foto_profile, 'http') ? $item->foto_profile : asset($item->foto_profile); @endphp
                    <img src="{{ $imgUrl }}" alt="{{ $item->name }}"
                        class="w-36 h-36 rounded-2xl object-cover border-4 border-white dark:border-gray-800 shadow-lg" />
                    @else
                    <div class="w-36 h-36 rounded-2xl bg-[#d32f2f] dark:bg-red-700 flex items-center justify-center border-4 border-white dark:border-gray-800 shadow-lg">
                        <span class="text-4xl font-black text-white">{{ strtoupper(substr($item->name ?? 'U', 0, 2)) }}</span>
                    </div>
                    @endif
                    <label for="avatarInput" class="absolute bottom-2 right-2 bg-[#af101a] dark:bg-red-600 text-white p-1.5 rounded-lg shadow-md hover:scale-110 transition-transform cursor-pointer">
                        <svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </label>
                </div>

                <h3 class="text-xl font-bold text-[#1b1c1c] dark:text-white mb-1 w-full break-words px-2" id="previewName" title="{{ $item->name ?? '-' }}">{{ $item->name ?? '-' }}</h3>
                <p class="text-sm text-[#5b403d] dark:text-gray-400 mb-3">{{ $item->email ?? '-' }}</p>

                <div class="flex items-center gap-2 mb-4 flex-wrap justify-center">
                    @if(strtolower($item->role ?? '') === 'admin')
                    <span class="px-3 py-1 bg-[#af101a] dark:bg-red-600 text-white rounded-full text-xs font-bold uppercase tracking-wider">Admin</span>
                    @elseif(strtolower($item->role ?? '') === 'pemilik')
                    <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-full text-xs font-bold uppercase tracking-wider">Pemilik</span>
                    @else
                    <span class="px-3 py-1 bg-[#fdcbd0] dark:bg-gray-700 text-[#795358] dark:text-gray-300 rounded-full text-xs font-bold uppercase tracking-wider">Anggota</span>
                    @endif
                    @if(strtolower($item->status) === 'aktif')
                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-bold uppercase tracking-wider">Aktif</span>
                    @else
                    <span class="px-3 py-1 bg-red-100 dark:bg-red-900/30 text-[#ba1a1a] dark:text-red-400 rounded-full text-xs font-bold uppercase tracking-wider">Ditangguhkan</span>
                    @endif
                </div>

                <p class="text-[#5b403d] dark:text-gray-400 text-xs leading-relaxed mb-5">
                    Bergabung sejak {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}.
                </p>

                <div class="w-full grid grid-cols-2 gap-4 border-t border-[#e4beba] dark:border-gray-700 pt-5">
                    <div>
                        <p class="text-xs text-[#5b403d] dark:text-gray-400 font-medium">Total Pesanan</p>
                        <p class="text-lg font-bold text-[#1b1c1c] dark:text-white">{{ $item->bookings_count ?? $item->bookings()->count() }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#5b403d] dark:text-gray-400 font-medium">ID Pengguna</p>
                        <p class="text-sm font-bold text-[#af101a] dark:text-red-400">VR-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700">
                <h4 class="text-xs font-black text-[#1b1c1c] dark:text-white uppercase tracking-widest mb-4 border-b border-[#e4beba] dark:border-gray-700 pb-3">Aksi Cepat</h4>
                <div class="space-y-3">
                    <form id="resetPasswordForm" action="{{ route('admin.users.reset-password', $item->id) }}" method="POST" class="w-full">
                        @csrf @method('PATCH')
                        <button type="button" onclick="openResetModal()"
                            class="w-full flex items-center justify-between p-3 rounded-lg border border-[#e4beba] dark:border-gray-600 hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors group">
                            <div class="flex items-center gap-3">
                                <svg class="text-[#5b403d] dark:text-gray-400 group-hover:text-[#af101a] dark:group-hover:text-red-400 text-xl inline-block align-middle w-5 h-5 transition-all duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                </svg>
                                <span class="text-sm font-semibold text-[#1b1c1c] dark:text-white transition-all duration-300 group-hover:translate-x-1">Atur Ulang Kata Sandi</span>
                            </div>
                            <svg class="text-sm text-[#8f6f6c] dark:text-gray-500 inline-block align-middle w-5 h-5 transition-all duration-300 group-hover:translate-x-1 group-hover:text-[#af101a] dark:group-hover:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </form>
                    <form id="suspendForm" action="{{ route('admin.users.suspend', $item->id) }}" method="POST" class="w-full">
                        @csrf @method('PATCH')
                        <button type="button" onclick="openSuspendModal()"
                            class="w-full flex items-center justify-between p-3 rounded-lg border {{ $item->status === 'suspended' ? 'border-green-200 dark:border-green-800 bg-green-50/30 dark:bg-green-900/20 hover:bg-green-50/60 dark:hover:bg-green-900/40' : 'border-[#e4beba] dark:border-gray-600 hover:bg-[#f6f3f2] dark:hover:bg-gray-700' }} transition-colors group">
                            <div class="flex items-center gap-3">
                                <svg class="{{ $item->status === 'suspended' ? 'text-green-600 dark:text-green-400' : 'text-[#5b403d] dark:text-gray-400 group-hover:text-[#af101a] dark:group-hover:text-red-400' }} w-5 h-5 transition-all duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                                <span class="text-sm font-semibold {{ $item->status === 'suspended' ? 'text-green-700 dark:text-green-400' : 'text-[#1b1c1c] dark:text-white' }} transition-all duration-300 group-hover:translate-x-1">
                                    {{ $item->status === 'suspended' ? 'Aktifkan Kembali Akun' : 'Tangguhkan / Suspend Akun' }}
                                </span>
                            </div>
                            <svg class="w-5 h-5 text-[#8f6f6c] dark:text-gray-500 transition-all duration-300 group-hover:translate-x-1 group-hover:text-[#af101a] dark:group-hover:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </form>
                    <button type="button" onclick="openDeleteModal()"
                        class="w-full flex items-center justify-between p-3 rounded-lg border border-[#ffdad6] dark:border-red-900/50 bg-[#ffdad6]/30 dark:bg-red-900/10 hover:bg-[#ffdad6]/60 dark:hover:bg-red-900/30 transition-colors group">
                        <div class="flex items-center gap-3">
                            <svg class="text-[#ba1a1a] dark:text-red-400 text-xl inline-block align-middle w-5 h-5 transition-all duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <span class="text-sm font-bold text-[#ba1a1a] dark:text-red-400 transition-all duration-300 group-hover:translate-x-1">Hapus Pengguna</span>
                        </div>
                        <svg class="text-sm text-[#ba1a1a] dark:text-red-400 inline-block align-middle w-5 h-5 transition-all duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Form + Booking History --}}
        <div class="col-span-12 lg:col-span-8 space-y-6">

            {{-- Form Card with Tabs --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700 relative z-40">
                {{-- Tab Header --}}
                <div class="flex border-b border-[#e4beba] dark:border-gray-700">
                    <button class="px-8 py-4 text-sm font-bold border-b-2 border-[#af101a] dark:border-red-500 text-[#af101a] dark:text-red-400 bg-red-50/30 dark:bg-red-900/10">Informasi Pribadi</button>
                    <button type="button" class="px-8 py-4 text-sm font-semibold text-[#5b403d] dark:text-gray-400 hover:text-[#af101a] dark:hover:text-red-400 transition-colors">Pengaturan Keamanan</button>
                    <button type="button" class="px-8 py-4 text-sm font-semibold text-[#5b403d] dark:text-gray-400 hover:text-[#af101a] dark:hover:text-red-400 transition-colors">Preferensi</button>
                </div>

                {{-- Form Body --}}
                <form id="userEditForm" action="{{ route('admin.users.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Hidden file input for avatar --}}
                    <input type="file" id="avatarInput" name="foto_profile" class="hidden" accept="image/*" />

                    <div class="p-8">
                        @if($errors->any())
                        <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 px-5 py-4 rounded-r-xl">
                            <div>
                                <p class="text-red-800 dark:text-red-400 font-bold text-sm mb-1">Mohon perbaiki kesalahan berikut:</p>
                                <ul class="list-disc list-inside text-red-700 dark:text-red-300 text-xs space-y-0.5">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            {{-- Nama --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $item->name) }}" required maxlength="50"
                                    class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                    placeholder="Nama lengkap" />
                                @error('name') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Alamat Email <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] dark:text-gray-400 text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    <input type="email" name="email" value="{{ old('email', $item->email) }}" required
                                        class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                        placeholder="email@example.com" />
                                </div>
                                @error('email') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- No. HP --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Nomor Telepon</label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] dark:text-gray-400 text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                    <input type="text" name="phone" value="{{ old('phone', $item->phone ?? $item->no_telp ?? '') }}"
                                        pattern="^(08|628|\+628)[0-9]{7,11}$" title="Nomor HP harus valid nomor Indonesia (diawali 08, 628, atau +628)"
                                        class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                        placeholder="+62 8xx xxxx xxxx" />
                                </div>
                                @error('phone') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Role --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Peran <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                <div class="relative w-full z-40">
                                    <select name="role" id="roleFilter" required class="hidden">
                                        <option value="user" {{ old('role', $item->role) == 'user' ? 'selected' : '' }}>👤 Pengguna</option>
                                        <option value="admin" {{ old('role', $item->role) == 'admin' ? 'selected' : '' }}>🔑 Admin</option>
                                        <option value="pemilik" {{ old('role', $item->role) == 'pemilik' ? 'selected' : '' }}>👑 Pemilik</option>
                                    </select>

                                    <div id="custom-role-btn" class="flex items-center justify-between w-full px-4 py-3 bg-[#f6f3f2] hover:bg-white/[0.12] rounded-lg border border-[#e4beba] text-sm transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white">
                                        <span class="text-slate-700 dark:text-white" id="custom-role-text">
                                            @php
                                                $roleText = [
                                                    'user' => '👤 Pengguna',
                                                    'admin' => '🔑 Admin',
                                                    'pemilik' => '👑 Pemilik',
                                                ];
                                                echo $roleText[old('role', $item->role)] ?? '👤 Pengguna';
                                            @endphp
                                        </span>
                                        <svg id="custom-role-icon" class="w-4 h-4 text-slate-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>

                                    <div id="custom-role-menu" class="absolute left-0 top-[calc(100%+0.5rem)] w-full bg-white dark:bg-gray-800 rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-slate-200 dark:border-gray-700 hidden z-50">
                                        <div class="absolute -top-1.5 left-6 w-3 h-3 bg-white dark:bg-gray-800 transform rotate-45 border-t border-l border-slate-200 dark:border-gray-700"></div>
                                        <ul class="relative z-10 py-1" id="custom-role-options">
                                            <li data-value="user" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('role', $item->role) == 'user' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-t-lg">👤 Pengguna</li>
                                            <li data-value="admin" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('role', $item->role) == 'admin' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }}">🔑 Admin</li>
                                            <li data-value="pemilik" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('role', $item->role) == 'pemilik' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-b-lg">👑 Pemilik</li>
                                        </ul>
                                    </div>
                                </div>
                                @error('role') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">
                                    Kata Sandi Baru
                                    <span class="text-[10px] normal-case font-normal text-[#8f6f6c] dark:text-gray-500 ml-1">(biarkan kosong jika tidak diubah)</span>
                                </label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] dark:text-gray-400 text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    <input type="password" name="password"
                                        class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                        placeholder="••••••••" />
                                </div>
                                @error('password') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Catatan --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Catatan <span class="text-[10px] normal-case font-normal text-[#8f6f6c] dark:text-gray-500 ml-1">(opsional)</span></label>
                                <textarea name="catatan" rows="3"
                                    class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all resize-none"
                                    placeholder="Tambahkan catatan khusus untuk pengguna ini...">{{ old('catatan', $item->catatan ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Recent Booking History --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700 overflow-hidden">
                <div class="px-8 py-5 border-b border-[#e4beba] dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-bold text-[#1b1c1c] dark:text-white font-['Lexend']">Riwayat Pesanan Terbaru</h3>
                        <p class="text-xs text-[#5b403d] dark:text-gray-400 font-medium mt-0.5">Aktivitas terakhir di semua venue</p>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="text-[#af101a] dark:text-red-400 font-bold text-sm hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-[#f6f3f2] dark:bg-gray-900/50">
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] dark:text-gray-400 uppercase tracking-wider">Venue</th>
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] dark:text-gray-400 uppercase tracking-wider">Tanggal & Waktu</th>
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] dark:text-gray-400 uppercase tracking-wider">Total Tagihan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e4beba] dark:divide-gray-700">
                            @forelse($item->bookings()->latest()->take(5)->get() as $booking)
                            <tr class="hover:bg-[#f6f3f2] dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="text-[#af101a] dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                                        </svg>
                                        <span class="text-sm font-bold text-[#1b1c1c] dark:text-white">{{ $booking->lapangan->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-4 text-sm text-[#5b403d] dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($booking->tanggal ?? $booking->created_at)->format('M d, Y') }}
                                    @if($booking->jam_mulai) • {{ $booking->jam_mulai }} @endif
                                </td>
                                <td class="px-8 py-4">
                                    @php $bStatus = strtolower($booking->status ?? ''); @endphp
                                    @if(in_array($bStatus, ['paid', 'completed', 'selesai']))
                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-[10px] font-black uppercase">Completed</span>
                                    @elseif(in_array($bStatus, ['pending', 'upcoming']))
                                    <span class="px-3 py-1 bg-[#fdcbd0] dark:bg-gray-700 text-[#795358] dark:text-gray-300 rounded-full text-[10px] font-black uppercase">Upcoming</span>
                                    @elseif(in_array($bStatus, ['cancelled', 'canceled']))
                                    <span class="px-3 py-1 bg-red-100 dark:bg-red-900/30 text-[#ba1a1a] dark:text-red-400 rounded-full text-[10px] font-black uppercase">Cancelled</span>
                                    @else
                                    <span class="px-3 py-1 bg-slate-100 dark:bg-gray-700 text-slate-600 dark:text-gray-300 rounded-full text-[10px] font-black uppercase">{{ $booking->status ?? '-' }}</span>
                                    @endif
                                </td>
                                <td class="px-8 py-4 text-sm font-bold text-[#1b1c1c] dark:text-white">
                                    Rp {{ number_format($booking->total_harga ?? $booking->harga ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-10 text-center text-[#5b403d] dark:text-gray-400">
                                    <svg class="text-3xl block mb-2 text-[#e4beba] dark:text-gray-600 inline-block align-middle w-5 h-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada riwayat booking.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Modal Konfirmasi Hapus --}}
        <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0 font-['Inter'] text-[#1b1c1c] dark:text-white"
            :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
            <div class="w-fit transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 border border-[#e4beba] dark:border-gray-700" id="deleteModalContent">
                <div class="flex items-center justify-center mb-5">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                        <svg class="text-[#af101a] dark:text-red-400 text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-center text-xl font-bold text-[#1b1c1c] dark:text-white mb-2">Hapus User Ini?</h3>
                <p class="text-center text-sm text-[#5b403d] dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin menghapus <strong>{{ $item->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
                <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
                <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
                    <button type="button" onclick="closeDeleteModal()"
                        class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-[#e4beba] dark:border-gray-600 bg-white dark:bg-gray-800 px-5 py-2.5 text-sm font-semibold text-[#5b403d] dark:text-gray-300 hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteBtn" onclick="executeDelete()"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] dark:bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800 dark:hover:bg-red-700 transition-colors">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>

        {{-- Modal Konfirmasi Reset Password --}}
        <div id="resetModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0 font-['Inter'] text-[#1b1c1c] dark:text-white"
            :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
            <div class="w-fit transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 border border-[#e4beba] dark:border-gray-700" id="resetModalContent">
                <div class="flex items-center justify-center mb-5">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                        <svg class="text-blue-600 dark:text-blue-400 text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-center text-xl font-bold text-[#1b1c1c] dark:text-white mb-2">Reset Kata Sandi?</h3>
                <p class="text-center text-sm text-[#5b403d] dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin mereset kata sandi pengguna ini menjadi <strong>'arena123'</strong>?
                </p>
                <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
                    <button type="button" onclick="closeResetModal()"
                        class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-[#e4beba] dark:border-gray-600 bg-white dark:bg-gray-800 px-5 py-2.5 text-sm font-semibold text-[#5b403d] dark:text-gray-300 hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors">
                        Batal
                    </button>
                    <button type="button" onclick="document.getElementById('resetPasswordForm').submit();"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition-colors">
                        Ya, Reset
                    </button>
                </div>
            </div>
        </div>

        {{-- Modal Konfirmasi Tangguhkan / Aktifkan --}}
        <div id="suspendModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0 font-['Inter'] text-[#1b1c1c] dark:text-white"
            :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
            <div class="w-fit transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 border border-[#e4beba] dark:border-gray-700" id="suspendModalContent">
                <div class="flex items-center justify-center mb-5">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full {{ $item->status === 'suspended' ? 'bg-green-100 dark:bg-green-900/30' : 'bg-yellow-100 dark:bg-yellow-900/30' }}">
                        <svg class="{{ $item->status === 'suspended' ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-500' }} text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-center text-xl font-bold text-[#1b1c1c] dark:text-white mb-2">{{ $item->status === 'suspended' ? 'Aktifkan Akun?' : 'Tangguhkan Akun?' }}</h3>
                <p class="text-center text-sm text-[#5b403d] dark:text-gray-400 mb-6">
                    Apakah Anda yakin ingin {{ $item->status === 'suspended' ? 'mengaktifkan kembali' : 'menangguhkan' }} akun <strong>{{ $item->name }}</strong>?
                </p>
                <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
                    <button type="button" onclick="closeSuspendModal()"
                        class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-[#e4beba] dark:border-gray-600 bg-white dark:bg-gray-800 px-5 py-2.5 text-sm font-semibold text-[#5b403d] dark:text-gray-300 hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors">
                        Batal
                    </button>
                    <button type="button" onclick="document.getElementById('suspendForm').submit();"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg {{ $item->status === 'suspended' ? 'bg-green-600 hover:bg-green-700' : 'bg-yellow-600 hover:bg-yellow-700' }} px-5 py-2.5 text-sm font-semibold text-white transition-colors">
                        Ya, {{ $item->status === 'suspended' ? 'Aktifkan' : 'Tangguhkan' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    const deleteModalContent = document.getElementById('deleteModalContent');
    const deleteFeedback = document.getElementById('deleteFeedback');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    function openDeleteModal() {
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
        void deleteModal.offsetWidth;
        deleteModal.classList.remove('opacity-0');
        deleteModalContent.classList.remove('scale-95', 'opacity-0');
        deleteModalContent.classList.add('scale-100', 'opacity-100');
        deleteFeedback.className = 'hidden mb-4 rounded-lg p-4 text-sm';
    }

    function closeDeleteModal() {
        deleteModal.classList.add('opacity-0');
        deleteModalContent.classList.remove('scale-100', 'opacity-100');
        deleteModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        }, 300);
    }

    // Modal Reset Password
    const resetModal = document.getElementById('resetModal');
    const resetModalContent = document.getElementById('resetModalContent');

    function openResetModal() {
        resetModal.classList.remove('hidden');
        resetModal.classList.add('flex');
        void resetModal.offsetWidth;
        resetModal.classList.remove('opacity-0');
        resetModalContent.classList.remove('scale-95', 'opacity-0');
        resetModalContent.classList.add('scale-100', 'opacity-100');
    }

    function closeResetModal() {
        resetModal.classList.add('opacity-0');
        resetModalContent.classList.remove('scale-100', 'opacity-100');
        resetModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            resetModal.classList.add('hidden');
            resetModal.classList.remove('flex');
        }, 300);
    }

    // Modal Suspend Account
    const suspendModal = document.getElementById('suspendModal');
    const suspendModalContent = document.getElementById('suspendModalContent');

    function openSuspendModal() {
        suspendModal.classList.remove('hidden');
        suspendModal.classList.add('flex');
        void suspendModal.offsetWidth;
        suspendModal.classList.remove('opacity-0');
        suspendModalContent.classList.remove('scale-95', 'opacity-0');
        suspendModalContent.classList.add('scale-100', 'opacity-100');
    }

    function closeSuspendModal() {
        suspendModal.classList.add('opacity-0');
        suspendModalContent.classList.remove('scale-100', 'opacity-100');
        suspendModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            suspendModal.classList.add('hidden');
            suspendModal.classList.remove('flex');
        }, 300);
    }

    async function executeDelete() {
        const originalBtnText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memproses...`;
        try {
            const response = await fetch("{{ route('admin.users.destroy', $item->id) }}", {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            const data = await response.json().catch(() => ({}));
            if (response.ok) {
                deleteFeedback.classList.remove('hidden');
                deleteFeedback.classList.add('bg-green-50', 'text-green-800', 'border', 'border-green-200');
                deleteFeedback.innerHTML = '<p class="flex items-center gap-2">✅ Berhasil dihapus. Mengalihkan...</p>';
                setTimeout(() => {
                    window.location.href = "{{ route('admin.users.index') }}";
                }, 1000);
            } else {
                throw new Error(data.message || 'Terjadi kesalahan saat menghapus data.');
            }
        } catch (error) {
            deleteFeedback.classList.remove('hidden');
            deleteFeedback.classList.add('bg-red-50', 'text-red-800', 'border', 'border-red-200');
            deleteFeedback.innerHTML = `<p class="flex items-center gap-2">❌ ${error.message}</p>`;
            confirmDeleteBtn.disabled = false;
            confirmDeleteBtn.innerHTML = originalBtnText;
        }
    }

    // Custom Role Dropdown Logic
    const roleBtn = document.getElementById('custom-role-btn');
    const roleMenu = document.getElementById('custom-role-menu');
    const roleIcon = document.getElementById('custom-role-icon');
    const roleSelect = document.getElementById('roleFilter');
    const roleText = document.getElementById('custom-role-text');
    const roleOptions = document.getElementById('custom-role-options')?.querySelectorAll('li');

    if (roleBtn && roleMenu) {
        roleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            roleMenu.classList.toggle('hidden');
            if (roleMenu.classList.contains('hidden')) {
                roleIcon.classList.remove('rotate-180');
            } else {
                roleIcon.classList.add('rotate-180');
            }
        });

        document.addEventListener('click', function(e) {
            if (!roleBtn.contains(e.target) && !roleMenu.contains(e.target)) {
                roleMenu.classList.add('hidden');
                roleIcon.classList.remove('rotate-180');
            }
        });

        if (roleOptions) {
            roleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.innerText;
                    
                    roleSelect.value = value;
                    roleText.innerText = text;
                    
                    roleOptions.forEach(opt => {
                        opt.classList.remove('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400', 'font-bold');
                        opt.classList.add('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                    });
                    
                    this.classList.remove('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                    this.classList.add('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400', 'font-bold');
                    
                    roleMenu.classList.add('hidden');
                    roleIcon.classList.remove('rotate-180');
                });
            });
        }
    }

    // Avatar preview logic
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElements = document.querySelectorAll('.col-span-12.lg\\:col-span-4 img');
                if (imgElements.length > 0) {
                    imgElements[0].src = e.target.result;
                } else {
                    const fallbackDiv = document.querySelector('.w-36.h-36.bg-\\[\\#d32f2f\\]');
                    if (fallbackDiv) {
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.className = 'w-36 h-36 rounded-2xl object-cover border-4 border-white shadow-lg';
                        fallbackDiv.replaceWith(newImg);
                    }
                }
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection