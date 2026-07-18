@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c] dark:text-white">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] dark:text-gray-400 mb-2">
                <a href="{{ route('admin.users.index') }}" class="hover:text-[#af101a] dark:hover:text-red-400 transition-colors flex items-center gap-1">
                    <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Daftar
                </a>
                <span class="text-[#e4beba] dark:text-gray-600">/</span>
                <span class="text-[#1b1c1c] dark:text-white font-semibold">Tambah Pengguna Baru</span>
            </div>
            <h1 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] dark:text-white tracking-tight">Tambah Pengguna Baru</h1>
            <p class="text-[#5b403d] dark:text-gray-400 mt-1 text-sm">Buat akun pengguna baru dengan informasi pribadi dan penetapan peran.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-[#e4beba] dark:border-gray-700 text-[#5b403d] dark:text-gray-300 text-sm font-semibold rounded-xl hover:bg-[#f6f3f2] dark:hover:bg-gray-700 transition-colors shadow-sm">
                <svg class="text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Batal
            </a>
            <button type="submit" form="userCreateForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] dark:bg-red-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 dark:hover:bg-red-700 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                Simpan Pengguna
            </button>
        </div>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-6 py-4 shadow-sm rounded-r-xl">
        <div>
            <p class="text-red-800 font-bold text-sm mb-1">Mohon perbaiki kesalahan berikut:</p>
            <ul class="list-disc list-inside text-red-700 text-xs space-y-0.5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT COLUMN: Avatar Preview + Tips --}}
        <div class="col-span-12 lg:col-span-4 space-y-6">

            {{-- Avatar Card --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700 flex flex-col items-center text-center">
                <div id="avatarPreviewWrap" class="relative mb-5">
                    <div id="avatarPlaceholder" class="w-36 h-36 rounded-2xl bg-[#f0eded] dark:bg-gray-700/50 border-2 border-dashed border-[#e4beba] dark:border-gray-600 flex flex-col items-center justify-center cursor-pointer hover:border-[#af101a] dark:hover:border-red-500 hover:bg-red-50/30 dark:hover:bg-red-900/20 transition-all group" onclick="document.getElementById('avatarInput').click()">
                        <svg class="text-4xl text-[#e4beba] dark:text-gray-500 group-hover:text-[#af101a] dark:group-hover:text-red-400 transition-colors inline-block align-middle w-20 h-20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <p class="text-[10px] text-[#5b403d] dark:text-gray-400 mt-2 font-medium">Klik untuk mengunggah</p>
                    </div>
                    <img id="avatarPreviewImg" src="https://ui-avatars.com/api/?name=User&background=FFCDD2&color=D32F2F" alt="Preview"
                        class="hidden w-36 h-36 rounded-2xl object-cover border-4 border-white dark:border-gray-800 shadow-lg" />
                    <button type="button" id="avatarEditBtn"
                        onclick="document.getElementById('avatarInput').click()"
                        class="hidden absolute bottom-2 right-2 bg-[#af101a] dark:bg-red-600 text-white p-1.5 rounded-lg shadow-md hover:scale-110 transition-transform">
                        <svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </button>
                </div>

                <h3 class="text-base font-bold text-[#1b1c1c] dark:text-white mb-1 w-full break-words px-2" id="previewName" title="Preview Nama">Pengguna baru</h3>
                <p class="text-xs text-[#5b403d] dark:text-gray-400 mb-4">Pratinjau Foto</p>

                <div class="w-full space-y-2 border-t border-[#e4beba] dark:border-gray-700 pt-5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-[#5b403d] dark:text-gray-400 font-medium">Tipe Akun</span>
                        <span class="font-bold text-[#1b1c1c] dark:text-white" id="previewRole">Pengguna</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-[#5b403d] dark:text-gray-400 font-medium">Status</span>
                        <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full font-bold text-[10px] uppercase">Aktif</span>
                    </div>
                </div>
            </div>

            {{-- Tips Card --}}
            <div class="bg-gradient-to-br from-red-50 to-[#fdcbd0]/30 dark:from-red-900/20 dark:to-red-900/10 rounded-xl border border-[#e4beba] dark:border-gray-700 dark:border-red-900/50 p-5">
                <div class="flex items-start gap-3">
                    <svg class="text-[#af101a] dark:text-red-400 mt-0.5 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-bold text-[#ba1a1a] dark:text-red-400 mb-2">Tips Singkat</h4>
                        <ul class="text-xs text-[#5b403d] dark:text-gray-300 space-y-1.5 list-disc list-inside">
                            <li>Gunakan alamat email valid untuk login</li>
                            <li>Kata sandi minimal 8 karakter</li>
                            <li>Tentukan peran yang tepat — Admin memiliki akses penuh</li>
                            <li>Unggah foto profil yang jelas (min. 400×400px)</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Role Info Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-[#e4beba] dark:border-gray-700 p-5 shadow-sm">
                <h4 class="text-xs font-black text-[#1b1c1c] dark:text-white uppercase tracking-widest mb-4 border-b border-[#e4beba] dark:border-gray-700 pb-3">Izin Peran</h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <span class="px-2 py-0.5 bg-[#fdcbd0] dark:bg-gray-700 text-[#795358] dark:text-gray-300 text-[10px] font-black uppercase rounded-full mt-0.5">Pengguna</span>
                        <p class="text-xs text-[#5b403d] dark:text-gray-400">Dapat melihat & memesan venue. Terbatas pada pesanan pribadi.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="px-2 py-0.5 bg-[#af101a] dark:bg-red-600 text-white text-[10px] font-black uppercase rounded-full mt-0.5">Admin</span>
                        <p class="text-xs text-[#5b403d] dark:text-gray-400">Akses penuh untuk mengelola venue, pesanan, dan pengguna.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="px-2 py-0.5 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 text-[10px] font-black uppercase rounded-full mt-0.5">Pemilik</span>
                        <p class="text-xs text-[#5b403d] dark:text-gray-400">Akses mengelola dashboard, lapangan, booking, manajemen waktu dan pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Form --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700 relative z-40">

                {{-- Card Header --}}
                <div class="px-8 py-5 border-b border-[#e4beba] dark:border-gray-700 flex items-center gap-3">
                    <svg class="text-[#af101a] dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#1b1c1c] dark:text-white">Informasi Pribadi</h2>
                </div>

                <form id="userCreateForm" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="avatarInput" name="foto_profile" class="hidden" accept="image/*" onchange="previewAvatar(event)" />

                    <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Nama --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">
                                Nama Lengkap <span class="text-[#ba1a1a] dark:text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required maxlength="50"
                                oninput="document.getElementById('previewName').textContent = this.value || '-'"
                                class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border {{ $errors->has('name') ? 'border-red-400' : 'border-[#e4beba] dark:border-gray-600' }} rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                placeholder="Nama lengkap pengguna" />
                            @error('name') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">
                                Alamat Email <span class="text-[#ba1a1a] dark:text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] dark:text-gray-400 text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border {{ $errors->has('email') ? 'border-red-400' : 'border-[#e4beba] dark:border-gray-600' }} rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                    placeholder="email@example.com" />
                            </div>
                            @error('email') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- No. HP --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Nomor Telepon</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] dark:text-gray-400 text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    pattern="^(08|628|\+628)[0-9]{7,11}$" title="Nomor HP harus valid nomor Indonesia (diawali 08, 628, atau +628)"
                                    class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                    placeholder="+62 8xx xxxx xxxx" />
                            </div>
                            @error('phone') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">
                                Role <span class="text-[#ba1a1a] dark:text-red-500">*</span>
                            </label>
                            <div class="relative w-full z-40">
                                <select name="role" id="roleFilter" required class="hidden">
                                    <option value="user" {{ old('role', 'user') == 'user' ? 'selected' : '' }}>👤 Pengguna</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>🔑 Admin</option>
                                    <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>👑 Pemilik</option>
                                </select>

                                <div id="custom-role-btn" class="flex items-center justify-between w-full px-4 py-3 bg-[#f6f3f2] hover:bg-white/[0.12] rounded-lg border border-[#e4beba] text-sm transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white">
                                    <span class="text-slate-700 dark:text-white" id="custom-role-text">
                                        @php
                                            $roleText = [
                                                'user' => '👤 Pengguna',
                                                'admin' => '🔑 Admin',
                                                'pemilik' => '👑 Pemilik',
                                            ];
                                            echo $roleText[old('role', 'user')] ?? '👤 Pengguna';
                                        @endphp
                                    </span>
                                    <svg id="custom-role-icon" class="w-4 h-4 text-slate-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>

                                <div id="custom-role-menu" class="absolute left-0 top-[calc(100%+0.5rem)] w-full bg-white dark:bg-gray-800 rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-slate-200 dark:border-gray-700 hidden z-50">
                                    <div class="absolute -top-1.5 left-6 w-3 h-3 bg-white dark:bg-gray-800 transform rotate-45 border-t border-l border-slate-200 dark:border-gray-700"></div>
                                    <ul class="relative z-10 py-1" id="custom-role-options">
                                        <li data-value="user" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('role', 'user') == 'user' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-t-lg">👤 Pengguna</li>
                                        <li data-value="admin" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('role') == 'admin' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }}">🔑 Admin</li>
                                        <li data-value="pemilik" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('role') == 'pemilik' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-b-lg">👑 Pemilik</li>
                                    </ul>
                                </div>
                            </div>
                            @error('role') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">
                                Kata Sandi <span class="text-[#ba1a1a] dark:text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] dark:text-gray-400 text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                <input type="password" name="password" required
                                    class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border {{ $errors->has('password') ? 'border-red-400' : 'border-[#e4beba] dark:border-gray-600' }} rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                    placeholder="Min. 8 karakter" />
                            </div>
                            @error('password') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Catatan --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Catatan <span class="text-[10px] normal-case font-normal text-[#8f6f6c] dark:text-gray-500 ml-1">(opsional)</span></label>
                            <textarea name="catatan" rows="3"
                                class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all resize-none"
                                placeholder="Tambahkan catatan khusus untuk pengguna ini...">{{ old('catatan') }}</textarea>
                        </div>

                        {{-- Divider --}}
                        <div class="sm:col-span-2 border-t border-[#e4beba] dark:border-gray-700 pt-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-[#1b1c1c] dark:text-white">Foto Profil</p>
                                    <p class="text-xs text-[#5b403d] dark:text-gray-400">Klik avatar di sebelah kiri atau tombol di bawah untuk mengunggah.</p>
                                </div>
                                <button type="button" onclick="document.getElementById('avatarInput').click()"
                                    class="flex items-center gap-2 px-4 py-2 border border-[#e4beba] dark:border-gray-600 rounded-lg text-xs font-bold text-[#5b403d] dark:text-gray-300 hover:bg-[#f6f3f2] dark:hover:bg-gray-700 hover:border-[#af101a] dark:hover:border-red-500 hover:text-[#af101a] dark:hover:text-red-400 transition-all">
                                    <svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Unggah Foto
                                </button>
                            </div>
                            @error('foto_profile') <p class="text-[#ba1a1a] dark:text-red-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const placeholder = document.getElementById('avatarPlaceholder');
            const img = document.getElementById('avatarPreviewImg');
            const editBtn = document.getElementById('avatarEditBtn');
            placeholder.classList.add('hidden');
            img.src = e.target.result;
            img.classList.remove('hidden');
            editBtn.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
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

                    const previewRole = document.getElementById('previewRole');
                    if(previewRole) {
                        previewRole.textContent = text.replace(/[^a-zA-Z]/g, '');
                    }
                });
            });
        }
    }
</script>
@endsection