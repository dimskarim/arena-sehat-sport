@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.lapangans.index') }}" class="hover:text-red-700 dark:hover:text-red-400 transition-colors">Lapangan</a>
                <svg class="text-base inline-block align-middl w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-900 dark:text-white font-semibold">Ubah Lapangan</span>
            </div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white">Ubah Detail Lapangan</h1>
            <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Perbarui informasi lapangan, harga, dan status operasional.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.lapangans.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                <svg class="text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Batal
            </a>
            <button type="submit" form="lapanganForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                </svg>
                Simpan Lapangan
            </button>
        </div>
    </div>

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

    @if(session('error'))
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="text-red-800 font-bold text-sm">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Form --}}
    <form id="lapanganForm" action="{{ route('admin.lapangans.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column: General Info --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- General Information Card --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 dark:border-gray-700">
                        <svg class="text-red-700 dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900 dark:text-white">Informasi Umum</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        {{-- Nama Lapangan --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">Nama Lapangan <span class="text-red-600">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $item->name) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('name') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-slate-200 dark:border-gray-600' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:text-white dark:focus:ring-red-500/30"
                                placeholder="Contoh: Lapangan Futsal A" />
                            @error('name') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">Jenis Lapangan <span class="text-red-600">*</span></label>
                            <select name="kategori_id" required
                                class="tom-select-custom w-full px-4 py-3 bg-slate-50 border {{ $errors->has('kategori_id') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-slate-200 dark:border-gray-600' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer dark:bg-gray-700/50 dark:text-white dark:focus:ring-red-500/30">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id', $item->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Pemilik (Only for Admin) --}}
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                                Pemilik Lapangan <span class="text-slate-400">(Opsional)</span>
                            </label>
                            <select name="pemilik_id"
                                class="tom-select-custom w-full px-4 py-3 bg-slate-50 border {{ $errors->has('pemilik_id') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-slate-200 dark:border-gray-600' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer dark:bg-gray-700/50 dark:text-white dark:focus:ring-red-500/30">
                                <option value="">Pilih Pemilik</option>
                                @foreach($pemiliks as $pem)
                                <option value="{{ $pem->id }}" {{ old('pemilik_id', $item->pemilik_id) == $pem->id ? 'selected' : '' }}>{{ $pem->name }}</option>
                                @endforeach
                            </select>
                            @error('pemilik_id') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>
                        @endif

                        {{-- Harga --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">Harga per Jam (Rp) <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-semibold">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga', $item->harga) }}" required min="0"
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border {{ $errors->has('harga') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-slate-200 dark:border-gray-600' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:text-white dark:focus:ring-red-500/30"
                                    placeholder="0" />
                            </div>
                            @error('harga') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('deskripsi') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-slate-200 dark:border-gray-600' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all resize-none dark:bg-gray-700/50 dark:text-white dark:focus:ring-red-500/30"
                                placeholder="Jelaskan fasilitas, dimensi, tipe lantai lapangan, dan info lainnya...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Amenities Card --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 dark:border-gray-700">
                        <svg class="text-red-700 dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900 dark:text-white">Fasilitas & Fitur</h2>
                        <span class="ml-auto text-xs text-slate-400 dark:text-gray-500 font-medium">Opsional — klik untuk mengaktifkan</span>
                    </div>
                    <div class="p-6 flex flex-wrap gap-3">
                        @forelse($fasilitas as $f)
                        <label class="cursor-pointer group">
                            <input type="checkbox" name="fasilitas[]" value="{{ $f->id }}" class="peer sr-only" {{ in_array($f->id, old('fasilitas', $item->fasilitas->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-semibold rounded-full border border-slate-200 transition-all select-none peer-checked:bg-red-50 peer-checked:text-red-700 peer-checked:border-red-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:peer-checked:bg-red-900/20 dark:peer-checked:text-red-400 dark:peer-checked:border-red-800 hover:border-red-200 dark:hover:border-red-800">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <circle cx="12" cy="12" r="7.5" />
                                </svg>
                                {{ $f->name }}
                            </div>
                        </label>
                        @empty
                        <p class="text-xs text-slate-500 dark:text-gray-400 w-full" id="empty-fasilitas-msg">Belum ada data fasilitas.</p>
                        @endforelse
                        <button type="button" onclick="openFasilitasModal()"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-slate-400 text-xs font-semibold rounded-full border border-dashed border-slate-300 cursor-pointer hover:border-red-300 transition-all select-none dark:bg-gray-800 dark:border-gray-600 dark:hover:border-red-500">
                            <svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Baru
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Column: Media & Status --}}
            <div class="space-y-6">

                    {{-- Venue Gallery --}}
                    <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 dark:border-gray-700">
                            <svg class="text-red-700 dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <h2 class="font-['Lexend'] text-base font-semibold text-slate-900 dark:text-white">Galeri Lapangan</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            {{-- Preview gambar lama --}}
                            @if($item->gambarLapangans->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 w-full p-2">
                                @foreach($item->gambarLapangans as $gambar)
                                @php $imgUrl = str_starts_with($gambar->gambar_file, 'http') ? $gambar->gambar_file : asset($gambar->gambar_file); @endphp
                                <div class="relative group aspect-video rounded-lg overflow-hidden border border-slate-200 shadow-sm">
                                    <img src="{{ $imgUrl }}" alt="Current Image" class="w-full h-full object-cover" />
                                </div>
                                @endforeach
                            </div>
                            <p class="text-xs text-slate-500 mt-2">* Mengunggah foto baru akan menggantikan semua foto lama.</p>
                            @else
                            <div class="h-36 w-full rounded-xl border border-slate-100 flex items-center justify-center bg-slate-50 text-slate-400 mb-4 dark:bg-gray-700/50 dark:border-gray-600 dark:text-gray-500">
                                <span class="text-xs font-semibold">Belum ada gambar</span>
                            </div>
                            @endif
                            {{-- Upload area --}}
                            <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-slate-200 rounded-xl cursor-pointer hover:border-red-300 hover:bg-red-50/30 transition-all group dark:border-gray-600 dark:hover:border-red-500 dark:hover:bg-red-900/20">
                                <svg class="text-3xl text-red-400 group-hover:scale-110 transition-transform inline-block align-middle w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <p class="text-xs font-semibold text-slate-500 mt-1 dark:text-gray-400">Klik atau seret untuk unggah foto baru (Bisa pilih banyak)</p>
                                <p class="text-[10px] text-slate-400 dark:text-gray-500">PNG, JPG hingga 2MB</p>
                                <input type="file" name="gambar[]" multiple class="hidden" accept="image/*" />
                            </label>
                            @error('gambar') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Publishing Status --}}
                    <div class="bg-white rounded-xl border border-slate-100 shadow-sm relative z-40 dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3 dark:border-gray-700">
                            <svg class="text-red-700 dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                            <h2 class="font-['Lexend'] text-base font-semibold text-slate-900 dark:text-white">Status Publikasi</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ strtolower($item->status ?? '') === 'tersedia' ? 'bg-green-500' : 'bg-slate-300 dark:bg-gray-500' }}"></span>
                                    <span class="text-sm font-semibold {{ strtolower($item->status ?? '') === 'tersedia' ? 'text-green-700 dark:text-green-400' : 'text-slate-500 dark:text-gray-400' }}">
                                        {{ strtolower($item->status ?? '') === 'tersedia' ? 'Aktif & Ditampilkan' : 'Tidak Aktif' }}
                                    </span>
                                </div>
                                <button type="button" onclick="openDeleteModal()" class="text-red-600 dark:text-red-400 text-xs font-bold hover:underline">Arsipkan</button>
                            </div>
                            <div class="relative w-full z-40">
                                <!-- Hidden Select -->
                                <select name="status" id="statusFilter" required class="hidden">
                                    <option value="tersedia" {{ old('status', $item->status) == 'tersedia' ? 'selected' : '' }}>✅ Tersedia (Aktif)</option>
                                    <option value="nonaktif" {{ old('status', $item->status) == 'nonaktif' ? 'selected' : '' }}>⛔ Tidak Tersedia (Tidak Aktif)</option>
                                </select>

                                <!-- Custom Dropdown Button -->
                                <div id="custom-status-btn" class="flex items-center justify-between w-full px-4 py-3 bg-slate-50 hover:bg-white/[0.12] rounded-lg border {{ $errors->has('status') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} text-sm transition-all cursor-pointer dark:bg-gray-700/50 dark:border-gray-600 dark:text-white">
                                    <span class="text-slate-700 dark:text-white font-medium" id="custom-status-text">
                                        @php
                                            $statusText = [
                                                'tersedia' => '✅ Tersedia (Aktif)',
                                                'nonaktif' => '⛔ Tidak Tersedia (Tidak Aktif)',
                                            ];
                                            echo $statusText[old('status', $item->status)] ?? '✅ Tersedia (Aktif)';
                                        @endphp
                                    </span>
                                    <svg id="custom-status-icon" class="w-4 h-4 text-slate-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>

                                <!-- Custom Dropdown Menu -->
                                <div id="custom-status-menu" class="absolute left-0 top-[calc(100%+0.5rem)] w-full bg-white dark:bg-gray-800 rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.1)] border border-slate-200 dark:border-gray-700 hidden z-50">
                                    <div class="absolute -top-1.5 left-6 w-3 h-3 bg-white dark:bg-gray-800 transform rotate-45 border-t border-l border-slate-200 dark:border-gray-700"></div>
                                    <ul class="relative z-10 py-1" id="custom-status-options">
                                        <li data-value="tersedia" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('status', $item->status) == 'tersedia' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-t-lg">✅ Tersedia (Aktif)</li>
                                        <li data-value="nonaktif" class="px-4 py-3 text-sm cursor-pointer transition-colors {{ old('status', $item->status) == 'nonaktif' ? 'bg-red-100 dark:bg-red-900/20 text-[#af101a] dark:text-red-400 font-bold' : 'text-slate-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-[#af101a] dark:hover:text-red-400' }} rounded-b-lg">⛔ Tidak Tersedia (Tidak Aktif)</li>
                                    </ul>
                                </div>
                            </div>
                            @error('status') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                            <p class="text-xs text-slate-400 dark:text-gray-500 mt-3">Terakhir diperbarui: {{ $item->updated_at?->format('d M Y, H:i') ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Danger Zone --}}
                    <div class="bg-white rounded-xl border border-red-100 shadow-sm overflow-hidden dark:bg-gray-800 dark:border-red-900/30">
                        <div class="px-6 py-4 border-b border-red-100 flex items-center gap-3 dark:border-red-900/30">
                            <svg class="text-red-700 dark:text-red-400 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <h2 class="font-['Lexend'] text-base font-semibold text-red-700 dark:text-red-400">Zona Berbahaya</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-xs text-slate-500 dark:text-gray-400 mb-4">Hapus lapangan ini secara permanen. Tindakan ini tidak dapat dibatalkan dan semua data terkait akan dihapus.</p>
                            <button type="button" onclick="openDeleteModal()"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 border border-red-200 text-red-600 text-sm font-semibold rounded-lg hover:bg-red-50 transition-all dark:border-red-900/50 dark:text-red-400 dark:hover:bg-red-900/20">
                                <svg class="w-5 h-5 text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                Hapus Lapangan Ini
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0"
        :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
        <div class="w-1/3 transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 dark:bg-gray-800 dark:border dark:border-gray-700" id="deleteModalContent">
            <div class="flex items-center justify-center mb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                    <svg class="text-[#af101a] dark:text-red-400 text-3xl inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </div>
            </div>
            <h3 class="text-center text-xl font-bold text-slate-900 mb-2 dark:text-white">Hapus Lapangan Ini?</h3>
            <p class="text-center text-sm text-slate-500 mb-6 dark:text-gray-400">
                Apakah Anda yakin ingin menghapus <strong>{{ $item->name }}</strong> secara permanen? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
            <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
                <button type="button" onclick="closeDeleteModal()" class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" onclick="executeDelete()" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Fasilitas --}}
    <div id="fasilitasModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0"
        :class="{
            'xl:pl-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
            'xl:pl-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
            'pl-0': $store.sidebar.isMobileOpen
        }">
        <div class="w-fit transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0 dark:bg-gray-800 dark:border dark:border-gray-700" id="fasilitasModalContent">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tambah Fasilitas Baru</h3>
                <button type="button" onclick="closeFasilitasModal()" class="text-slate-400 hover:text-red-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="fasilitasFeedback" class="hidden mb-4 rounded-lg p-3 text-sm"></div>
            <form id="fasilitasForm" onsubmit="submitFasilitas(event)">
                <div class="mb-5">
                    <label class="block text-xs font-bold text-slate-500 dark:text-gray-400 uppercase tracking-widest mb-2">Nama Fasilitas <span class="text-red-600">*</span></label>
                    <input type="text" id="fasilitas_name" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all dark:bg-gray-700/50 dark:border-gray-600 dark:text-white dark:focus:ring-red-500/30" placeholder="Contoh: Toilet Bersih">
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeFasilitasModal()" class="px-5 py-2.5 rounded-lg border border-slate-200 bg-white text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">Batal</button>
                    <button type="submit" id="btnSubmitFasilitas" class="px-5 py-2.5 rounded-lg bg-[#af101a] text-sm font-semibold text-white hover:bg-red-800 flex items-center gap-2">
                        Simpan
                    </button>
                </div>
            </form>
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

    async function executeDelete() {
        const originalBtnText = confirmDeleteBtn.innerHTML;
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Processing...`;

        try {
            const response = await fetch("{{ route('admin.lapangans.destroy', $item->id) }}", {
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
                    window.location.href = "{{ route('admin.lapangans.index') }}";
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

    // Multiple file preview logic for edit page
    let selectedFiles = [];
    const fileInput = document.querySelector('input[name="gambar[]"]');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            if (!newFiles.length) return;

            // Append new files
            newFiles.forEach(file => {
                const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                if (!exists) {
                    selectedFiles.push(file);
                }
            });

            // Update input files
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;

            renderPreviews();
        });
    }

    function renderPreviews() {
        const emptyBlock = document.querySelector('.bg-slate-50.text-slate-400.mb-4');
        if (emptyBlock) emptyBlock.style.display = 'none';

        // Find or create the grid container
        let gridContainer = document.getElementById('newImagePreview');
        if (!gridContainer) {
            gridContainer = document.createElement('div');
            gridContainer.id = 'newImagePreview';
            gridContainer.className = 'grid grid-cols-2 sm:grid-cols-3 gap-3 w-full p-2 mb-2';
            const uploadLabel = document.querySelector('label[class*="border-dashed"]');
            uploadLabel.parentNode.insertBefore(gridContainer, uploadLabel);
        }

        gridContainer.innerHTML = '';

        if (selectedFiles.length === 0 && emptyBlock) {
            emptyBlock.style.display = 'flex';
        }

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group aspect-video rounded-lg overflow-hidden border border-red-200 shadow-sm opacity-90';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover grayscale-0 transition-all';

                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.onclick = () => removeFile(index);
                deleteBtn.className = 'absolute top-1 right-1 bg-white/90 hover:bg-red-500 hover:text-white text-slate-700 p-1 rounded-md opacity-0 group-hover:opacity-100 transition-all shadow-sm z-10';
                deleteBtn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';

                const badge = document.createElement('div');
                badge.className = 'absolute bottom-1 left-1 bg-red-900/80 px-2 py-0.5 rounded text-[10px] font-bold text-white shadow';
                badge.textContent = 'Baru';

                div.appendChild(img);
                div.appendChild(deleteBtn);
                div.appendChild(badge);
                gridContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
        renderPreviews();
    }

    // Fasilitas Modal Script
    const fasModal = document.getElementById('fasilitasModal');
    const fasModalContent = document.getElementById('fasilitasModalContent');
    const fasFeedback = document.getElementById('fasilitasFeedback');

    function openFasilitasModal() {
        fasModal.classList.remove('hidden');
        fasModal.classList.add('flex');
        void fasModal.offsetWidth;
        fasModal.classList.remove('opacity-0');
        fasModalContent.classList.remove('scale-95', 'opacity-0');
        fasModalContent.classList.add('scale-100', 'opacity-100');
        fasFeedback.className = 'hidden mb-4 rounded-lg p-3 text-sm';
        document.getElementById('fasilitas_name').value = '';
    }

    function closeFasilitasModal() {
        fasModal.classList.add('opacity-0');
        fasModalContent.classList.remove('scale-100', 'opacity-100');
        fasModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            fasModal.classList.add('hidden');
            fasModal.classList.remove('flex');
        }, 300);
    }

    async function submitFasilitas(e) {
        e.preventDefault();
        const nameInput = document.getElementById('fasilitas_name');
        const btnSubmit = document.getElementById('btnSubmitFasilitas');
        const name = nameInput.value.trim();
        if (!name) return;

        btnSubmit.disabled = true;
        btnSubmit.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Menyimpan...`;

        try {
            const response = await fetch("{{ route('admin.fasilitas.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name
                })
            });

            const data = await response.json();

            if (response.ok) {
                // Success
                fasFeedback.classList.remove('hidden', 'bg-red-50', 'text-red-800', 'border-red-200');
                fasFeedback.classList.add('bg-green-50', 'text-green-800', 'border', 'border-green-200');
                fasFeedback.innerHTML = '✅ Fasilitas berhasil ditambahkan!';

                // Add the new checkbox to the UI
                const container = document.querySelector('.p-6.flex.flex-wrap.gap-3');
                const emptyMsg = document.getElementById('empty-fasilitas-msg');
                if (emptyMsg) emptyMsg.style.display = 'none';

                const newLabel = document.createElement('label');
                newLabel.className = 'cursor-pointer group';
                newLabel.innerHTML = `
                    <input type="checkbox" name="fasilitas[]" value="${data.data.id}" class="peer sr-only" checked>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-semibold rounded-full border border-slate-200 transition-all select-none peer-checked:bg-red-50 peer-checked:text-red-700 peer-checked:border-red-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:peer-checked:bg-red-900/20 dark:peer-checked:text-red-400 dark:peer-checked:border-red-800 hover:border-red-200 dark:hover:border-red-800">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <circle cx="12" cy="12" r="7.5" />
                        </svg>
                        ${data.data.name}
                    </div>
                `;
                // Insert before the Add Button
                const addButton = container.querySelector('button[onclick="openFasilitasModal()"]');
                container.insertBefore(newLabel, addButton);

                setTimeout(() => closeFasilitasModal(), 1000);
            } else {
                throw new Error(data.message || data.errors?.name?.[0] || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error submitting fasilitas:', error);
            const feedback = document.getElementById('fasilitasFeedback');
            feedback.innerHTML = 'Terjadi kesalahan saat menambahkan fasilitas.';
            feedback.className = 'mb-4 rounded-lg p-3 text-sm bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 block';
        } finally {
            const submitBtn = document.getElementById('btnSubmitFasilitas');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Simpan';
        }
    }

    // Custom Status Dropdown Logic
    const statusBtn = document.getElementById('custom-status-btn');
    const statusMenu = document.getElementById('custom-status-menu');
    const statusIcon = document.getElementById('custom-status-icon');
    const statusSelect = document.getElementById('statusFilter');
    const statusText = document.getElementById('custom-status-text');
    const statusOptions = document.getElementById('custom-status-options')?.querySelectorAll('li');

    if (statusBtn && statusMenu) {
        statusBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            statusMenu.classList.toggle('hidden');
            if (statusMenu.classList.contains('hidden')) {
                statusIcon.classList.remove('rotate-180');
            } else {
                statusIcon.classList.add('rotate-180');
            }
        });

        document.addEventListener('click', function(e) {
            if (!statusBtn.contains(e.target) && !statusMenu.contains(e.target)) {
                statusMenu.classList.add('hidden');
                statusIcon.classList.remove('rotate-180');
            }
        });

        if (statusOptions) {
            statusOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const text = this.innerText;
                    
                    statusSelect.value = value;
                    statusText.innerText = text;
                    
                    statusOptions.forEach(opt => {
                        opt.classList.remove('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400', 'font-bold');
                        opt.classList.add('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                    });
                    
                    this.classList.remove('text-slate-700', 'dark:text-gray-300', 'hover:bg-red-100', 'dark:hover:bg-red-900/30', 'hover:text-[#af101a]', 'dark:hover:text-red-400');
                    this.classList.add('bg-red-100', 'dark:bg-red-900/20', 'text-[#af101a]', 'dark:text-red-400', 'font-bold');
                    
                    statusMenu.classList.add('hidden');
                    statusIcon.classList.remove('rotate-180');
                });
            });
        }
    }
</script>
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.tom-select-custom').forEach((el) => {
            new TomSelect(el, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    });
</script>
<style>
    .ts-wrapper.form-control {
        border: none;
        padding: 0;
        background: transparent;
    }

    .ts-control {
        border-radius: 0.5rem !important;
        padding: 0.75rem 1rem !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
        font-size: 0.875rem !important;
        min-height: 46px !important;
    }

    .dark .ts-control {
        border-color: #4b5563 !important;
        background-color: rgba(55, 65, 81, 0.5) !important;
        color: white !important;
    }

    .dark .ts-dropdown {
        background-color: #1f2937 !important;
        border-color: #374151 !important;
        color: white !important;
    }

    .dark .ts-dropdown .option {
        color: white !important;
    }

    .dark .ts-dropdown .option.active,
    .dark .ts-dropdown .option:hover {
        background-color: #374151 !important;
        color: white !important;
    }
</style>
@endpush
@endsection