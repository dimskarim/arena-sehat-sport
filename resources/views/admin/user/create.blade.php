@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] mb-2">
                <a href="{{ route('admin.users.index') }}" class="hover:text-[#af101a] transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Back to List
                </a>
                <span class="text-[#e4beba]">/</span>
                <span class="text-[#1b1c1c] font-semibold">Add New User</span>
            </div>
            <h1 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] tracking-tight">Add New User</h1>
            <p class="text-[#5b403d] mt-1 text-sm">Create a new user account with personal information and role assignment.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#e4beba] text-[#5b403d] text-sm font-semibold rounded-xl hover:bg-[#f6f3f2] transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Cancel
            </a>
            <button type="submit" form="userCreateForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <span class="material-symbols-outlined text-lg">person_add</span>
                Create User
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
            <div class="bg-white p-8 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] flex flex-col items-center text-center">
                <div id="avatarPreviewWrap" class="relative mb-5">
                    <div id="avatarPlaceholder" class="w-36 h-36 rounded-2xl bg-[#f0eded] border-2 border-dashed border-[#e4beba] flex flex-col items-center justify-center cursor-pointer hover:border-[#af101a] hover:bg-red-50/30 transition-all group" onclick="document.getElementById('avatarInput').click()">
                        <span class="material-symbols-outlined text-4xl text-[#e4beba] group-hover:text-[#af101a] transition-colors">account_circle</span>
                        <p class="text-[10px] text-[#5b403d] mt-2 font-medium">Click to upload</p>
                    </div>
                    <img id="avatarPreviewImg" src="" alt="Preview"
                        class="hidden w-36 h-36 rounded-2xl object-cover border-4 border-white shadow-lg" />
                    <button type="button" id="avatarEditBtn"
                        onclick="document.getElementById('avatarInput').click()"
                        class="hidden absolute bottom-2 right-2 bg-[#af101a] text-white p-1.5 rounded-lg shadow-md hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                </div>

                <h3 class="text-base font-bold text-[#1b1c1c] mb-1" id="previewName">New User</h3>
                <p class="text-xs text-[#5b403d] mb-4">Photo Preview</p>

                <div class="w-full space-y-2 border-t border-[#e4beba] pt-5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-[#5b403d] font-medium">Account Type</span>
                        <span class="font-bold text-[#1b1c1c]" id="previewRole">User</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-[#5b403d] font-medium">Status</span>
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full font-bold text-[10px] uppercase">Active</span>
                    </div>
                </div>
            </div>

            {{-- Tips Card --}}
            <div class="bg-gradient-to-br from-red-50 to-[#fdcbd0]/30 rounded-xl border border-[#e4beba] p-5">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[#af101a] mt-0.5">tips_and_updates</span>
                    <div>
                        <h4 class="text-sm font-bold text-[#ba1a1a] mb-2">Quick Tips</h4>
                        <ul class="text-xs text-[#5b403d] space-y-1.5 list-disc list-inside">
                            <li>Use a valid email address for login</li>
                            <li>Password must be at least 8 characters</li>
                            <li>Assign correct role — Admin has full access</li>
                            <li>Upload a clear profile photo (min. 400×400px)</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Role Info Card --}}
            <div class="bg-white rounded-xl border border-[#e4beba] p-5 shadow-sm">
                <h4 class="text-xs font-black text-[#1b1c1c] uppercase tracking-widest mb-4 border-b border-[#e4beba] pb-3">Role Permissions</h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <span class="px-2 py-0.5 bg-[#fdcbd0] text-[#795358] text-[10px] font-black uppercase rounded-full mt-0.5">User</span>
                        <p class="text-xs text-[#5b403d]">Can browse & book venues. Limited to personal bookings only.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="px-2 py-0.5 bg-[#af101a] text-white text-[10px] font-black uppercase rounded-full mt-0.5">Admin</span>
                        <p class="text-xs text-[#5b403d]">Full access to manage venues, bookings, and users.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Form --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] overflow-hidden">

                {{-- Card Header --}}
                <div class="px-8 py-5 border-b border-[#e4beba] flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#af101a]">person_add</span>
                    <h2 class="font-['Lexend'] text-base font-semibold text-[#1b1c1c]">Personal Information</h2>
                </div>

                <form id="userCreateForm" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="avatarInput" name="foto_profile" class="hidden" accept="image/*" onchange="previewAvatar(event)"/>

                    <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Nama --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                Full Name <span class="text-[#ba1a1a]">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                oninput="document.getElementById('previewName').textContent = this.value || 'New User'"
                                class="w-full px-4 py-3 bg-[#f6f3f2] border {{ $errors->has('name') ? 'border-red-400' : 'border-[#e4beba]' }} rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                placeholder="Nama lengkap pengguna" />
                            @error('name') <p class="text-[#ba1a1a] text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                Email Address <span class="text-[#ba1a1a]">*</span>
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg">mail</span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] border {{ $errors->has('email') ? 'border-red-400' : 'border-[#e4beba]' }} rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                    placeholder="email@example.com" />
                            </div>
                            @error('email') <p class="text-[#ba1a1a] text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p> @enderror
                        </div>

                        {{-- No. HP --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Phone Number</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg">call</span>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                    placeholder="+62 8xx xxxx xxxx" />
                            </div>
                            @error('phone') <p class="text-[#ba1a1a] text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                Role <span class="text-[#ba1a1a]">*</span>
                            </label>
                            <select name="role" required
                                onchange="document.getElementById('previewRole').textContent = this.options[this.selectedIndex].text.replace(/[^a-zA-Z]/g, '')"
                                class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all appearance-none cursor-pointer">
                                <option value="user" {{ old('role', 'user') == 'user' ? 'selected' : '' }}>👤 User</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>🔑 Admin</option>
                            </select>
                            @error('role') <p class="text-[#ba1a1a] text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                Password <span class="text-[#ba1a1a]">*</span>
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg">lock</span>
                                <input type="password" name="password" required
                                    class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] border {{ $errors->has('password') ? 'border-red-400' : 'border-[#e4beba]' }} rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                    placeholder="Min. 8 karakter" />
                            </div>
                            @error('password') <p class="text-[#ba1a1a] text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-sm">error</span>{{ $message }}</p> @enderror
                        </div>

                        {{-- Address --}}
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Address / Notes</label>
                            <textarea name="address" rows="3"
                                class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all resize-none"
                                placeholder="Alamat lengkap atau catatan tambahan...">{{ old('address') }}</textarea>
                        </div>

                        {{-- Divider --}}
                        <div class="sm:col-span-2 border-t border-[#e4beba] pt-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-[#1b1c1c]">Profile Photo</p>
                                    <p class="text-xs text-[#5b403d]">Click the avatar on the left or button below to upload.</p>
                                </div>
                                <button type="button" onclick="document.getElementById('avatarInput').click()"
                                    class="flex items-center gap-2 px-4 py-2 border border-[#e4beba] rounded-lg text-xs font-bold text-[#5b403d] hover:bg-[#f6f3f2] hover:border-[#af101a] hover:text-[#af101a] transition-all">
                                    <span class="material-symbols-outlined text-sm">upload</span>
                                    Upload Photo
                                </button>
                            </div>
                            @error('foto_profile') <p class="text-[#ba1a1a] text-xs mt-1.5">{{ $message }}</p> @enderror
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
</script>
@endsection