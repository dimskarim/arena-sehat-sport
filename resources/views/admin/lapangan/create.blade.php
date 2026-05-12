@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('admin.lapangans.index') }}" class="hover:text-red-700 transition-colors">Venues</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <span class="text-slate-900 font-semibold">Add New Venue</span>
            </div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900">Add New Venue</h1>
            <p class="text-slate-500 text-sm mt-1">Fill in the court details, pricing, and upload venue photos.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.lapangans.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Cancel
            </a>
            <button type="submit" form="lapanganCreateForm" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <span class="material-symbols-outlined text-lg">add_circle</span>
                Create Venue
            </button>
        </div>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
    <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-6 py-4 shadow-sm rounded-r-xl">
        <div>
            <p class="text-red-800 font-bold text-sm mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-red-700 text-xs space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
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
                        <span class="material-symbols-outlined text-red-700">info</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">General Information</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Nama Lapangan --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">
                                Venue Name <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all"
                                placeholder="e.g. Grand Central Court A" />
                            @error('name') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">
                                Venue Type <span class="text-red-600">*</span>
                            </label>
                            <select name="kategori_id" required
                                class="w-full px-4 py-3 bg-slate-50 border {{ $errors->has('kategori_id') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer">
                                <option value="">Select Category</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p> @enderror
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">
                                Price per Hour (Rp) <span class="text-red-600">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-semibold">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga') }}" required min="0"
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border {{ $errors->has('harga') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all"
                                    placeholder="0" />
                            </div>
                            @error('harga') <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Description</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all resize-none"
                                placeholder="Describe the court's features, dimensions, flooring type...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Amenities Card --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-700">checklist</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Amenities & Features</h2>
                        <span class="ml-auto text-xs text-slate-400 font-medium">Optional — click to toggle</span>
                    </div>
                    <div class="p-6 flex flex-wrap gap-2">
                        @foreach([
                            'Air Conditioning' => 'ac_unit',
                            'Locker Rooms'     => 'lock',
                            'Parking'          => 'local_parking',
                            'Shower'           => 'shower',
                            'Lighting'         => 'light_mode',
                            'Scoreboard'       => 'scoreboard',
                            'Wi-Fi'            => 'wifi',
                            'Cafeteria'        => 'local_cafe',
                        ] as $amenity => $icon)
                        <button type="button"
                            onclick="this.classList.toggle('bg-red-50'); this.classList.toggle('text-red-700'); this.classList.toggle('border-red-200'); this.classList.toggle('bg-slate-50'); this.classList.toggle('text-slate-600'); this.classList.toggle('border-slate-200');"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-600 text-xs font-semibold rounded-full border border-slate-200 cursor-pointer hover:border-red-200 hover:bg-red-50 hover:text-red-700 transition-all select-none">
                            <span class="material-symbols-outlined text-sm">{{ $icon }}</span>
                            {{ $amenity }}
                        </button>
                        @endforeach
                        <button type="button"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white text-slate-400 text-xs font-semibold rounded-full border border-dashed border-slate-300 cursor-pointer hover:border-red-300 transition-all select-none">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Add New
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-6">

                {{-- Venue Gallery --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-700">photo_library</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Venue Gallery</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        {{-- Image Preview --}}
                        <div id="imagePreview" class="hidden h-40 w-full rounded-xl overflow-hidden border border-slate-100">
                            <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover"/>
                        </div>
                        {{-- Upload Area --}}
                        <label for="gambarInput" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed {{ $errors->has('gambar') ? 'border-red-400 bg-red-50/30' : 'border-slate-200' }} rounded-xl cursor-pointer hover:border-red-300 hover:bg-red-50/30 transition-all group">
                            <span class="material-symbols-outlined text-4xl text-red-400 group-hover:scale-110 transition-transform">upload_file</span>
                            <p class="text-xs font-semibold text-slate-500 mt-1.5">Click or drag to upload photo</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">PNG, JPG up to 5MB</p>
                        </label>
                        <input type="file" id="gambarInput" name="gambar" required class="hidden" accept="image/*"
                            onchange="previewImage(event)" />
                        <div id="fileNameBadge" class="hidden items-center gap-2 px-3 py-2 bg-slate-50 rounded-lg border border-slate-200">
                            <span class="material-symbols-outlined text-slate-400 text-base">image</span>
                            <span id="fileNameText" class="text-xs text-slate-600 font-medium truncate flex-1"></span>
                            <button type="button" onclick="clearImage()" class="text-slate-400 hover:text-red-600 transition-colors">
                                <span class="material-symbols-outlined text-base">close</span>
                            </button>
                        </div>
                        @error('gambar') <p class="text-red-600 text-xs flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Publishing Status --}}
                <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-700">toggle_on</span>
                        <h2 class="font-['Lexend'] text-base font-semibold text-slate-900">Publishing Status</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-3">Set initial availability status for this venue.</p>
                        <select name="status" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-900 focus:ring-2 focus:ring-red-100 focus:border-red-500 outline-none transition-all appearance-none cursor-pointer">
                            <option value="tersedia" {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}>✅ Tersedia (Active)</option>
                            <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>⛔ Tidak Tersedia (Inactive)</option>
                        </select>
                        @error('status') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Tips Card --}}
                <div class="bg-gradient-to-br from-red-50 to-red-100/50 rounded-xl border border-red-100 p-5">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-red-600 mt-0.5">tips_and_updates</span>
                        <div>
                            <h4 class="text-sm font-bold text-red-800 mb-1">Quick Tips</h4>
                            <ul class="text-xs text-red-700 space-y-1 list-disc list-inside">
                                <li>Upload high-quality photos (min. 800×600px)</li>
                                <li>Set accurate pricing to attract bookings</li>
                                <li>Add a detailed description for better visibility</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            const img = document.getElementById('previewImg');
            const badge = document.getElementById('fileNameBadge');
            const nameText = document.getElementById('fileNameText');

            img.src = e.target.result;
            preview.classList.remove('hidden');
            badge.classList.remove('hidden');
            badge.classList.add('flex');
            nameText.textContent = file.name;
        };
        reader.readAsDataURL(file);
    }

    function clearImage() {
        document.getElementById('gambarInput').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        const badge = document.getElementById('fileNameBadge');
        badge.classList.add('hidden');
        badge.classList.remove('flex');
        document.getElementById('previewImg').src = '';
    }
</script>
@endsection