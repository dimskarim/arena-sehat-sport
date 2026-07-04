@extends('layouts.front')

@section('title', 'Profil Pengguna - ArenaFlow')


@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 md:py-16 bg-gradient-mesh min-h-screen">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start mt-10">
        <!-- Left Column: Informasi Profil -->
        <aside class="lg:col-span-4 space-y-gutter motion-hidden">
            <div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.08)] p-8 text-center">
                <div class="relative w-32 h-32 mx-auto mb-6">
                    <img alt="Alex Rivera" class="w-full h-full object-cover rounded-full border-4 border-secondary-container" data-alt="close-up portrait of a male athlete with friendly expression, natural lighting, high resolution" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCPftAUKFRt4vgv85CZJvJ9OvoejBVBMbHJhvwYcGiObWaLVYtaDjLfMhmzNKZglsdP7G0oBdS9GG_9jlwtzRWw8hVFNnNZHvXXHnj3loSxvUHh8vmfouNRvk0FgvYV0xXuklcAMXqdNKRndknO_W-UEi87qjUAyBirnduoKl9tA_YtDPjNZZoGVq58AV3SFT-FcsW57uFsjLhfN6Of7MX_ypnG-RujAd1QFjO2QrK8JmD0AXIGMUQ23Ovj8n23t02yuMZae8jfZMA" />
                    <div class="absolute bottom-0 right-0 bg-primary-container text-white p-2 rounded-full shadow-lg cursor-pointer hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                    </div>
                </div>
                <h1 class="font-h2 text-h2 text-on-surface mb-1">{{ $user->name }}</h1>
                <p class="font-body-md text-zinc-500 mb-6">Bergabung {{ $user->created_at->format('M Y') }}</p>
                <div class="space-y-4 text-left border-t border-zinc-100 dark:border-gray-800 pt-6">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary-container">mail</span>
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Alamat Email</p>
                            <p class="font-label-md text-on-surface">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="bg-surface-container-low p-4 rounded-lg">
                        <p class="text-h3 font-h3 text-primary">{{ $totalBookings }}</p>
                        <p class="text-[10px] font-bold uppercase text-zinc-500">Total Pesanan</p>
                    </div>
                    <div class="bg-surface-container-low p-4 rounded-lg">
                        <p class="text-h3 font-h3 text-primary">{{ $successfulBookings }}</p>
                        <p class="text-[10px] font-bold uppercase text-zinc-500">Selesai</p>
                    </div>
                </div>
            </div>
            <!-- Quick Stats/Loyalty Card -->
            <div class="bg-primary-container text-on-primary-container rounded-xl p-6 shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="font-h3 text-lg mb-2">Aktivitas Anda</h3>
                    <p class="text-sm opacity-90 mb-4">Anda tinggal 2 pesanan lagi untuk mendapatkan sesi gratis!</p>
                    <div class="w-full bg-black/10 rounded-full h-2 mb-2">
                        <div class="bg-surface-container-lowest h-full rounded-full" style="width: 80%"></div>
                    </div>
                    <p class="text-[10px] font-bold uppercase">800 / 1000 Poin</p>
                </div>
                <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-8xl opacity-10 rotate-12">workspace_premium</span>
            </div>
        </aside>

        <!-- Right Column: Forms -->
        <div class="lg:col-span-7 space-y-gutter">
            <!-- Section: Edit Profil -->
            <section class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.08)] overflow-hidden motion-hidden">
                <div class="p-6 border-b border-zinc-100 dark:border-gray-800 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary-container">edit_square</span>
                    <h2 class="font-h3 text-h3 text-lg">Informasi Profil</h2>
                </div>
                <div class="p-8">
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @if(session('success'))
                        <div class="p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label class="font-label-md text-zinc-600 dark:text-gray-300 block">Nama Lengkap</label>
                                <input name="name" class="w-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-3 rounded-lg border border-zinc-200 dark:border-gray-700 focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all hover:bg-secondary-container/10" type="text" value="{{ old('name', $user->name) }}" />
                                @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end pt-4">
                            <button class="bg-primary-container text-on-primary px-8 py-3 rounded-lg font-label-md shadow-md hover:brightness-110 active:scale-95 transition-all" type="submit">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Section: Ubah Password -->
            <section class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.08)] overflow-hidden motion-hidden">
                <div class="p-6 border-b border-zinc-100 dark:border-gray-800 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary-container">lock</span>
                    <h2 class="font-h3 text-h3 text-lg">Ubah Password</h2>
                </div>
                <div class="p-8">
                    <form action="{{ route('profile.password') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2 max-w-md">
                            <label class="font-label-md text-zinc-600 dark:text-gray-300 block">Password Lama</label>
                            <div class="relative">
                                <input name="current_password" class="w-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-3 rounded-lg border border-zinc-200 dark:border-gray-700 focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all" placeholder="••••••••" type="password" />
                                @error('current_password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-label-md text-zinc-600 dark:text-gray-300 block">Password Baru</label>
                                <input name="password" class="w-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-3 rounded-lg border border-zinc-200 dark:border-gray-700 focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all" placeholder="Min. 8 characters" type="password" />
                                @error('password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-label-md text-zinc-600 dark:text-gray-300 block">Konfirmasi Password Baru</label>
                                <input name="password_confirmation" class="w-full bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-3 rounded-lg border border-zinc-200 dark:border-gray-700 focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all" placeholder="Repeat new password" type="password" />
                            </div>
                        </div>
                        <div class="flex justify-end pt-4">
                            <button class="bg-primary text-on-primary px-8 py-3 rounded-lg font-label-md shadow-md hover:brightness-110 active:scale-95 transition-all" type="submit">
                                Perbarui Password
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Section: Account Settings (Extra) -->
            <section class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.08)] overflow-hidden motion-hidden">
                <div class="p-6 border-b border-zinc-100 dark:border-gray-800">
                    <h2 class="font-h3 text-h3 text-lg">Preferensi</h2>
                </div>
                <div class="p-8 space-y-4">
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-zinc-500">notifications_active</span>
                            <div>
                                <p class="font-label-md">Notifikasi Email</p>
                                <p class="text-xs text-zinc-500">Terima pembaruan pesanan dan promo</p>
                            </div>
                        </div>
                        <div class="w-12 h-6 bg-primary-container rounded-full relative cursor-pointer">
                            <div class="absolute right-1 top-1 w-4 h-4 bg-surface-container-lowest rounded-full"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-zinc-500">public</span>
                            <div>
                                <p class="font-label-md">Profil Publik</p>
                                <p class="text-xs text-zinc-500">Izinkan orang lain melihat statistik olahragamu</p>
                            </div>
                        </div>
                        <div class="w-12 h-6 bg-zinc-300 rounded-full relative cursor-pointer">
                            <div class="absolute left-1 top-1 w-4 h-4 bg-surface-container-lowest rounded-full"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection