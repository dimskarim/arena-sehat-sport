@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('admin.lapangans.index') }}" class="hover:text-red-700 transition-colors">Lapangan</a>
                <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-900 font-semibold">Tambah Lapangan</span>
            </div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900">Tambah Lapangan Baru</h1>
            <p class="text-slate-500 text-sm mt-1">Lengkapi detail lapangan, harga, dan unggah foto venue.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.lapangans.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                <svg class="text-lg inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Batal
            </a>
            <button type="submit" form="lapanganCreateForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Simpan Lapangan
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

    @if(session('error'))
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="text-red-800 font-bold text-sm">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Form --}}
    <form id="lapanganCreateForm" action="{{ route('admin.lapangans.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- General Information --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <svg class="text-red-700 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Informasi Umum</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Nama Lapangan --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">
                                Nama Lapangan <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all"
                                placeholder="Contoh: Lapangan Futsal A" />
                            @error('name') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">
                                Jenis Lapangan <span class="text-red-600">*</span>
                            </label>
                            <select name="kategori_id" required
                                class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('kategori_id') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">
                                Harga per Jam (Rp) <span class="text-red-600">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-semibold">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga') }}" required min="0"
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border {{ $errors->has('harga') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all"
                                    placeholder="0" />
                            </div>
                            @error('harga') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><svg class="text-sm inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>{{ $message }}</p> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all resize-none"
                                placeholder="Jelaskan fasilitas, dimensi, tipe lantai lapangan, dan info lainnya...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Amenities Card --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <svg class="text-red-700 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Fasilitas & Fitur</h2>
                        <span class="ml-auto text-xs text-slate-400 font-medium">Opsional — klik untuk mengaktifkan</span>
                    </div>
                    <div class="p-6 flex flex-wrap gap-2">
                        @foreach([
                        'AC Ruangan' => 'ac_unit',
                        'Ruang Loker' => 'lock',
                        'Area Parkir' => 'local_parking',
                        'Kamar Mandi' => 'shower',
                        'Pencahayaan LED' => 'light_mode',
                        'Papan Skor' => 'scoreboard',
                        'Wi-Fi Gratis' => 'wifi',
                        'Kafetaria' => 'local_cafe',
                        ] as $amenity => $icon)
                        <button type="button"
                            onclick="this.classList.toggle('bg-red-50'); this.classList.toggle('text-red-700'); this.classList.toggle('border-red-200'); this.classList.toggle('bg-slate-50'); this.classList.toggle('text-slate-600'); this.classList.toggle('border-slate-200');"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-semibold rounded-full border border-slate-200 cursor-pointer hover:border-red-200 hover:bg-red-50 hover:text-red-700 transition-all select-none">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $amenity }}
                        </button>
                        @endforeach
                        <button type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-slate-400 text-xs font-semibold rounded-full border border-dashed border-slate-300 cursor-pointer hover:border-red-300 transition-all select-none">
                            <svg class="text-sm inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Baru
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-6">

                {{-- Venue Gallery --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <svg class="text-red-700 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Galeri Lapangan</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        {{-- Image Preview --}}
                        <div id="imagePreview" class="hidden grid-cols-2 sm:grid-cols-3 gap-3 w-full p-2">
                        </div>
                        {{-- Upload Area --}}
                        <label for="gambarInput" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed {{ $errors->has('gambar') ? 'border-red-400 bg-red-50/30' : 'border-slate-200' }} rounded-xl cursor-pointer hover:border-red-300 hover:bg-red-50/30 transition-all group">
                            <svg class="text-4xl text-red-400 group-hover:scale-110 transition-transform inline-block align-middle w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="text-xs font-semibold text-slate-500 mt-1.5">Klik atau seret untuk unggah foto (Bisa pilih banyak)</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">PNG, JPG hingga 5MB</p>
                        </label>
                        <input type="file" id="gambarInput" name="gambar[]" multiple required class="hidden" accept="image/*"
                            onchange="previewImages(event)" />
                        @error('gambar') <p class="text-red-600 text-xs flex items-center gap-1"><svg class="text-sm inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Publishing Status --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <svg class="text-red-700 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Status Publikasi</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-3">Pilih ketersediaan lapangan agar dapat dipesan secara online.</p>
                        <select name="status" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer">
                            <option value="tersedia" {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}>✅ Tersedia (Aktif)</option>
                            <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>⛔ Tidak Tersedia (Tidak Aktif)</option>
                        </select>
                        @error('status') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Tips Card --}}
                <div class="bg-gradient-to-br from-red-50 to-red-100/50 rounded-xl border border-red-100 p-5">
                    <div class="flex items-start gap-3">
                        <svg class="text-red-600 mt-0.5 inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                        </svg>
                        <div>
                            <h4 class="text-sm font-bold text-red-800 mb-1">Tips Kelola Lapangan</h4>
                            <ul class="text-xs text-red-700 space-y-1 list-disc list-inside">
                                <li>Gunakan foto yang cerah dan jelas (min. 800×600px)</li>
                                <li>Tetapkan harga yang kompetitif</li>
                                <li>Berikan deskripsi detail tentang fasilitas lapangan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let selectedFiles = [];

    function previewImages(event) {
        const newFiles = Array.from(event.target.files);
        if (!newFiles.length) return;

        // Append new files instead of replacing
        newFiles.forEach(file => {
            // Check if file already exists to prevent duplicates (by name and size)
            const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
            if (!exists) {
                selectedFiles.push(file);
            }
        });
        
        // Ensure input files are correctly stored in DataTransfer to keep state consistent
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('gambarInput').files = dataTransfer.files;

        renderPreviews();
    }

    function renderPreviews() {
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = '';
        
        if (selectedFiles.length === 0) {
            previewContainer.classList.add('hidden');
            previewContainer.classList.remove('grid');
            document.getElementById('gambarInput').value = '';
            return;
        }

        previewContainer.classList.remove('hidden');
        previewContainer.classList.add('grid');

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group aspect-video rounded-lg overflow-hidden border border-slate-200 shadow-sm';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.onclick = () => removeFile(index);
                deleteBtn.className = 'absolute top-2 right-2 bg-white/90 hover:bg-red-500 hover:text-white text-slate-700 p-1.5 rounded-md opacity-0 group-hover:opacity-100 transition-all shadow-sm';
                deleteBtn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';
                
                div.appendChild(img);
                div.appendChild(deleteBtn);
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        
        // Update input files
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('gambarInput').files = dataTransfer.files;
        
        renderPreviews();
    }
</script>
@endsection