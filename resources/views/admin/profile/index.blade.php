@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c] dark:text-white">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#af101a] dark:hover:text-red-400 transition-colors flex items-center gap-1">
                    <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dasbor
                </a>
                <span class="text-[#e4beba] dark:text-gray-600">/</span>
                <span class="text-[#1b1c1c] dark:text-white font-semibold">Profil Saya</span>
            </div>
            <h1 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] dark:text-white tracking-tight">Profil Saya</h1>
            <p class="text-[#5b403d] dark:text-gray-400 mt-1 text-sm">Kelola informasi pribadi dan pengaturan keamanan akun Anda.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 px-5 py-4 rounded-r-xl">
        <p class="text-green-800 dark:text-green-400 font-bold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 px-5 py-4 rounded-r-xl">
        <p class="text-red-800 dark:text-red-400 font-bold text-sm">{{ session('error') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT COLUMN: Profile Card --}}
        <div class="col-span-12 lg:col-span-4 space-y-6">

            {{-- Profile Card --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700 flex flex-col items-center text-center">
                <div class="relative mb-5">
                    @if($item->foto_profile)
                    <img src="{{ asset($item->foto_profile) }}" alt="{{ $item->name }}"
                        class="w-36 h-36 rounded-2xl object-cover border-4 border-white dark:border-gray-800 shadow-lg bg-gray-100" />
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name ?? 'User') }}&background=af101a&color=fff&bold=true" alt="{{ $item->name }}" class="w-36 h-36 rounded-2xl object-cover border-4 border-white dark:border-gray-800 shadow-lg bg-gray-100" />
                    @endif
                    <label for="avatarInput" class="absolute bottom-2 right-2 bg-[#af101a] dark:bg-red-600 text-white p-1.5 rounded-lg shadow-md hover:scale-110 transition-transform cursor-pointer">
                        <svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </label>
                </div>

                <h3 class="text-xl font-bold text-[#1b1c1c] dark:text-white mb-1 w-full break-words px-2" id="previewName">{{ $item->name ?? '-' }}</h3>
                <p class="text-sm text-[#5b403d] dark:text-gray-400 mb-3">{{ $item->email ?? '-' }}</p>

                <div class="flex items-center gap-2 mb-4 flex-wrap justify-center">
                    @if(strtolower($item->role ?? '') === 'admin')
                    <span class="px-3 py-1 bg-[#af101a] dark:bg-red-600 text-white rounded-full text-xs font-bold uppercase tracking-wider">Admin</span>
                    @elseif(strtolower($item->role ?? '') === 'pemilik')
                    <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 rounded-full text-xs font-bold uppercase tracking-wider">Pemilik</span>
                    @endif
                </div>

                <p class="text-[#5b403d] dark:text-gray-400 text-xs leading-relaxed mb-5">
                    Bergabung sejak {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}.
                </p>
            </div>
        </div>

        {{-- RIGHT COLUMN: Form --}}
        <div class="col-span-12 lg:col-span-8 space-y-6" x-data="{ tab: '{{ old('current_password') || $errors->has('current_password') ? 'password' : 'profile' }}' }">

            {{-- Form Card with Tabs --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] dark:border-gray-700 relative z-40 overflow-hidden">
                {{-- Tab Header --}}
                <div class="flex border-b border-[#e4beba] dark:border-gray-700">
                    <button @click="tab = 'profile'" :class="tab === 'profile' ? 'border-b-2 border-[#af101a] dark:border-red-500 text-[#af101a] dark:text-red-400 bg-red-50/30 dark:bg-red-900/10' : 'text-[#5b403d] dark:text-gray-400 hover:text-[#af101a] dark:hover:text-red-400'" class="px-8 py-4 text-sm font-bold transition-colors">Informasi Pribadi</button>
                    <button @click="tab = 'password'" :class="tab === 'password' ? 'border-b-2 border-[#af101a] dark:border-red-500 text-[#af101a] dark:text-red-400 bg-red-50/30 dark:bg-red-900/10' : 'text-[#5b403d] dark:text-gray-400 hover:text-[#af101a] dark:hover:text-red-400'" class="px-8 py-4 text-sm font-bold transition-colors">Keamanan & Sandi</button>
                </div>

                {{-- Form Body - Profile --}}
                <div x-show="tab === 'profile'">
                    <form id="userEditForm" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Hidden file input for avatar --}}
                        <input type="file" id="avatarInput" name="foto_profile" class="hidden" accept="image/*" />

                        <div class="p-8">
                            @if($errors->any() && !old('current_password'))
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
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Alamat Email <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', $item->email) }}" required
                                        class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                        placeholder="email@example.com" />
                                </div>

                                {{-- No. HP --}}
                                <div>
                                    <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Nomor Telepon <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                    <input type="text" name="phone" value="{{ old('phone', $item->phone) }}" required
                                        pattern="^(08|628|\+628)[0-9]{7,11}$" title="Nomor HP harus valid nomor Indonesia (diawali 08, 628, atau +628)"
                                        class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all"
                                        placeholder="+62 8xx xxxx xxxx" />
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit"
                                    class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] dark:bg-red-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 dark:hover:bg-red-700 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Form Body - Password --}}
                <div x-show="tab === 'password'" style="display: none;">
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="p-8">
                            @if($errors->any() && old('current_password'))
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

                            <div class="space-y-5">
                                <div>
                                    <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Saat Ini <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                    <div class="relative" x-data="{ show: false }">
                                        <input :type="show ? 'text' : 'password'" name="current_password" required
                                            class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all pr-12"
                                            placeholder="••••••••" />
                                        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#af101a] dark:hover:text-red-400">
                                            <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Baru <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                        <div class="relative" x-data="{ show: false }">
                                            <input :type="show ? 'text' : 'password'" name="password" required minlength="8"
                                                class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all pr-12"
                                                placeholder="••••••••" />
                                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#af101a] dark:hover:text-red-400">
                                                <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-[#5b403d] dark:text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Sandi Baru <span class="text-[#ba1a1a] dark:text-red-500">*</span></label>
                                        <div class="relative" x-data="{ show: false }">
                                            <input :type="show ? 'text' : 'password'" name="password_confirmation" required minlength="8"
                                                class="w-full px-4 py-3 bg-[#f6f3f2] dark:bg-gray-700/50 border border-[#e4beba] dark:border-gray-600 rounded-lg text-sm text-[#1b1c1c] dark:text-white focus:ring-2 focus:ring-red-100 focus:border-[#af101a] dark:focus:ring-red-500/30 outline-none transition-all pr-12"
                                                placeholder="••••••••" />
                                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#af101a] dark:hover:text-red-400">
                                                <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 flex justify-end">
                                <button type="submit"
                                    class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] dark:bg-red-600 text-white text-sm font-semibold rounded-xl hover:opacity-90 dark:hover:bg-red-700 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                                    Update Sandi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Avatar preview logic
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElements = document.querySelectorAll('.col-span-12.lg\\:col-span-4 img');
                if (imgElements.length > 0) {
                    imgElements[0].src = e.target.result;
                }
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Check if there are password errors to auto-switch tab
    @if($errors->any() && old('current_password'))
    document.addEventListener('alpine:init', () => {
        // Alpine data is localized to the div, so we just set it directly or let Alpine handle it.
        // Easiest is to set a global variable if needed, but since we use x-data="{ tab: 'profile' }",
        // we can inject the initial state.
    });
    @endif
</script>
@endsection
