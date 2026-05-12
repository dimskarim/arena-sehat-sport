@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-[#5b403d] mb-2">
                <a href="{{ route('admin.users.index') }}" class="hover:text-[#af101a] transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Back to List
                </a>
                <span class="text-[#e4beba]">/</span>
                <span class="text-[#1b1c1c] font-semibold">Edit User</span>
            </div>
            <h1 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] tracking-tight">Edit User Profile</h1>
            <p class="text-[#5b403d] mt-1 text-sm">Update personal information, role, and account settings.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white border border-[#e4beba] text-[#5b403d] text-sm font-semibold rounded-xl hover:bg-[#f6f3f2] transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Cancel
            </a>
            <button type="submit" form="userEditForm"
                class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-900/20 active:scale-95">
                <span class="material-symbols-outlined text-lg">save</span>
                Save Changes
            </button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT COLUMN: Profile Card + Quick Actions --}}
        <div class="col-span-12 lg:col-span-4 space-y-6">

            {{-- Profile Card --}}
            <div class="bg-white p-8 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] flex flex-col items-center text-center">
                <div class="relative mb-5">
                    @if($item->foto_profile)
                        <img src="{{ asset('storage/' . $item->foto_profile) }}" alt="{{ $item->name }}"
                            class="w-36 h-36 rounded-2xl object-cover border-4 border-white shadow-lg"/>
                    @else
                        <div class="w-36 h-36 rounded-2xl bg-[#d32f2f] flex items-center justify-center border-4 border-white shadow-lg">
                            <span class="text-4xl font-black text-white">{{ strtoupper(substr($item->name ?? 'U', 0, 2)) }}</span>
                        </div>
                    @endif
                    <label for="avatarInput" class="absolute bottom-2 right-2 bg-[#af101a] text-white p-1.5 rounded-lg shadow-md hover:scale-110 transition-transform cursor-pointer">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </label>
                </div>

                <h3 class="text-xl font-bold text-[#1b1c1c] mb-1">{{ $item->name ?? '-' }}</h3>
                <p class="text-sm text-[#5b403d] mb-3">{{ $item->email ?? '-' }}</p>

                <div class="flex items-center gap-2 mb-4 flex-wrap justify-center">
                    @if(strtolower($item->role ?? '') === 'admin')
                        <span class="px-3 py-1 bg-[#af101a] text-white rounded-full text-xs font-bold uppercase tracking-wider">Admin</span>
                    @else
                        <span class="px-3 py-1 bg-[#fdcbd0] text-[#795358] rounded-full text-xs font-bold uppercase tracking-wider">Member</span>
                    @endif
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider">Active</span>
                </div>

                <p class="text-[#5b403d] text-xs leading-relaxed mb-5">
                    Joined since {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}.
                </p>

                <div class="w-full grid grid-cols-2 gap-4 border-t border-[#e4beba] pt-5">
                    <div>
                        <p class="text-xs text-[#5b403d] font-medium">Total Booking</p>
                        <p class="text-lg font-bold text-[#1b1c1c]">{{ $item->bookings_count ?? $item->bookings()->count() }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#5b403d] font-medium">User ID</p>
                        <p class="text-sm font-bold text-[#af101a]">VR-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white p-6 rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba]">
                <h4 class="text-xs font-black text-[#1b1c1c] uppercase tracking-widest mb-4 border-b border-[#e4beba] pb-3">Quick Actions</h4>
                <div class="space-y-3">
                    <button type="button"
                        class="w-full flex items-center justify-between p-3 rounded-lg border border-[#e4beba] hover:bg-[#f6f3f2] transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[#5b403d] group-hover:text-[#af101a] text-xl">lock_reset</span>
                            <span class="text-sm font-semibold text-[#1b1c1c]">Reset Password</span>
                        </div>
                        <span class="material-symbols-outlined text-sm text-[#8f6f6c]">chevron_right</span>
                    </button>
                    <button type="button"
                        class="w-full flex items-center justify-between p-3 rounded-lg border border-[#e4beba] hover:bg-[#f6f3f2] transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[#5b403d] group-hover:text-[#af101a] text-xl">block</span>
                            <span class="text-sm font-semibold text-[#1b1c1c]">Deactivate Account</span>
                        </div>
                        <span class="material-symbols-outlined text-sm text-[#8f6f6c]">chevron_right</span>
                    </button>
                    <button type="button" onclick="openDeleteModal()"
                        class="w-full flex items-center justify-between p-3 rounded-lg border border-[#ffdad6] bg-[#ffdad6]/30 hover:bg-[#ffdad6]/60 transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[#ba1a1a] text-xl">delete_forever</span>
                            <span class="text-sm font-bold text-[#ba1a1a]">Delete User</span>
                        </div>
                        <span class="material-symbols-outlined text-sm text-[#ba1a1a]">warning</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Form + Booking History --}}
        <div class="col-span-12 lg:col-span-8 space-y-6">

            {{-- Form Card with Tabs --}}
            <div class="bg-white rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] overflow-hidden">
                {{-- Tab Header --}}
                <div class="flex border-b border-[#e4beba]">
                    <button class="px-8 py-4 text-sm font-bold border-b-2 border-[#af101a] text-[#af101a] bg-red-50/30">Personal Information</button>
                    <button class="px-8 py-4 text-sm font-semibold text-[#5b403d] hover:text-[#af101a] transition-colors">Security Settings</button>
                    <button class="px-8 py-4 text-sm font-semibold text-[#5b403d] hover:text-[#af101a] transition-colors">Preferences</button>
                </div>

                {{-- Form Body --}}
                <form id="userEditForm" action="{{ route('admin.users.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Hidden file input for avatar --}}
                    <input type="file" id="avatarInput" name="foto_profile" class="hidden" accept="image/*"/>

                    <div class="p-8">
                        @if($errors->any())
                        <div class="mb-6 flex w-full border-l-4 border-red-500 bg-red-50 px-5 py-4 rounded-r-xl">
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

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            {{-- Nama --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Full Name <span class="text-[#ba1a1a]">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $item->name) }}" required
                                    class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                    placeholder="Nama lengkap" />
                                @error('name') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Email Address <span class="text-[#ba1a1a]">*</span></label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg">mail</span>
                                    <input type="email" name="email" value="{{ old('email', $item->email) }}" required
                                        class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                        placeholder="email@example.com" />
                                </div>
                                @error('email') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- No. HP --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Phone Number</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg">call</span>
                                    <input type="text" name="phone" value="{{ old('phone', $item->phone ?? $item->no_telp ?? '') }}"
                                        class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                        placeholder="+62 8xx xxxx xxxx" />
                                </div>
                                @error('phone') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Role --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Role <span class="text-[#ba1a1a]">*</span></label>
                                <select name="role" required
                                    class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all appearance-none cursor-pointer">
                                    <option value="user" {{ old('role', $item->role) == 'user' ? 'selected' : '' }}>👤 User</option>
                                    <option value="admin" {{ old('role', $item->role) == 'admin' ? 'selected' : '' }}>🔑 Admin</option>
                                </select>
                                @error('role') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">
                                    New Password
                                    <span class="text-[10px] normal-case font-normal text-[#8f6f6c] ml-1">(leave blank to keep current)</span>
                                </label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg">lock</span>
                                    <input type="password" name="password"
                                        class="w-full pl-11 pr-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all"
                                        placeholder="••••••••" />
                                </div>
                                @error('password') <p class="text-[#ba1a1a] text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Billing Address (no_telp fallback shown as address placeholder) --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-[#5b403d] uppercase tracking-widest mb-2">Address / Notes</label>
                                <textarea name="address" rows="3"
                                    class="w-full px-4 py-3 bg-[#f6f3f2] border border-[#e4beba] rounded-lg text-sm text-[#1b1c1c] focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none transition-all resize-none"
                                    placeholder="Alamat lengkap...">{{ old('address', $item->address ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Recent Booking History --}}
            <div class="bg-white rounded-xl shadow-[0_4px_20px_rgba(211,47,47,0.06)] border border-[#e4beba] overflow-hidden">
                <div class="px-8 py-5 border-b border-[#e4beba] flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-bold text-[#1b1c1c] font-['Lexend']">Recent Booking History</h3>
                        <p class="text-xs text-[#5b403d] font-medium mt-0.5">Last activities across all venues</p>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="text-[#af101a] font-bold text-sm hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-[#f6f3f2]">
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] uppercase tracking-wider">Venue</th>
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] uppercase tracking-wider">Date & Time</th>
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] uppercase tracking-wider">Status</th>
                                <th class="px-8 py-3 text-xs font-black text-[#5b403d] uppercase tracking-wider">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e4beba]">
                            @forelse($item->bookings()->latest()->take(5)->get() as $booking)
                            <tr class="hover:bg-[#f6f3f2] transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[#af101a]">stadium</span>
                                        <span class="text-sm font-bold text-[#1b1c1c]">{{ $booking->lapangan->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-4 text-sm text-[#5b403d]">
                                    {{ \Carbon\Carbon::parse($booking->tanggal ?? $booking->created_at)->format('M d, Y') }}
                                    @if($booking->jam_mulai) • {{ $booking->jam_mulai }} @endif
                                </td>
                                <td class="px-8 py-4">
                                    @php $bStatus = strtolower($booking->status ?? ''); @endphp
                                    @if(in_array($bStatus, ['paid', 'completed', 'selesai']))
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase">Completed</span>
                                    @elseif(in_array($bStatus, ['pending', 'upcoming']))
                                        <span class="px-3 py-1 bg-[#fdcbd0] text-[#795358] rounded-full text-[10px] font-black uppercase">Upcoming</span>
                                    @elseif(in_array($bStatus, ['cancelled', 'canceled']))
                                        <span class="px-3 py-1 bg-red-100 text-[#ba1a1a] rounded-full text-[10px] font-black uppercase">Cancelled</span>
                                    @else
                                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-black uppercase">{{ $booking->status ?? '-' }}</span>
                                    @endif
                                </td>
                                <td class="px-8 py-4 text-sm font-bold text-[#1b1c1c]">
                                    Rp {{ number_format($booking->total_harga ?? $booking->harga ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-10 text-center text-[#5b403d]">
                                    <span class="material-symbols-outlined text-3xl block mb-2 text-[#e4beba]">event_busy</span>
                                    <p class="text-sm font-medium">Belum ada riwayat booking.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all scale-95 opacity-0" id="deleteModalContent">
        <div class="flex items-center justify-center mb-5">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                <span class="material-symbols-outlined text-[#af101a] text-3xl">delete_forever</span>
            </div>
        </div>
        <h3 class="text-center text-xl font-bold text-[#1b1c1c] mb-2">Hapus User Ini?</h3>
        <p class="text-center text-sm text-[#5b403d] mb-6">
            Apakah Anda yakin ingin menghapus <strong>{{ $item->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div id="deleteFeedback" class="hidden mb-4 rounded-lg p-4 text-sm"></div>
        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-center">
            <button type="button" onclick="closeDeleteModal()"
                class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-[#e4beba] bg-white px-5 py-2.5 text-sm font-semibold text-[#5b403d] hover:bg-[#f6f3f2]">
                Batal
            </button>
            <button type="button" id="confirmDeleteBtn" onclick="executeDelete()"
                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 rounded-lg bg-[#af101a] px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-800">
                Ya, Hapus
            </button>
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
                setTimeout(() => { window.location.href = "{{ route('admin.users.index') }}"; }, 1000);
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
</script>
@endsection