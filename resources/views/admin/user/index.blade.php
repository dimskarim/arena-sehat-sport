@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold font-['Lexend'] text-[#1b1c1c] tracking-tight">Manajemen User</h2>
            <p class="text-[#5b403d] mt-1">Kelola profil pengguna, peran, dan status akses platform.</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center gap-2 px-6 py-3 bg-[#af101a] text-white rounded-lg font-bold shadow-lg shadow-red-900/20 hover:bg-opacity-90 active:scale-[0.98] transition-all">
            <span class="material-symbols-outlined">person_add</span>
            <span>Tambah User</span>
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Stats & Filters Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">

        {{-- Stat: Total User --}}
        <div class="bg-[#f6f3f2] p-6 rounded-xl border border-[#e4beba] flex items-center gap-4">
            <div class="bg-[#fdcbd0] p-3 rounded-full shrink-0">
                <span class="material-symbols-outlined text-[#795358]">group</span>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] uppercase tracking-wider">Total User</p>
                <p class="text-2xl font-black font-['Lexend']">
                    {{ method_exists($items, 'total') ? number_format($items->total()) : count($items) }}
                </p>
            </div>
        </div>

        {{-- Stat: Admin --}}
        <div class="bg-[#f6f3f2] p-6 rounded-xl border border-[#e4beba] flex items-center gap-4">
            <div class="bg-red-50 p-3 rounded-full shrink-0">
                <span class="material-symbols-outlined text-[#af101a]">verified_user</span>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] uppercase tracking-wider">Active Admins</p>
                <p class="text-2xl font-black font-['Lexend'] text-[#af101a]">
                    {{ $items->where('role', 'admin')->count() }}
                </p>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="lg:col-span-2 bg-white p-4 rounded-xl border border-[#e4beba] flex flex-wrap items-end gap-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-end gap-4 w-full">
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-[10px] font-bold text-[#5b403d] uppercase tracking-widest mb-1.5">Filter by Role</label>
                    <select name="role" class="w-full px-3 py-2 bg-[#fcf9f8] border border-[#e4beba] rounded-lg text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none appearance-none cursor-pointer">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-[10px] font-bold text-[#5b403d] uppercase tracking-widest mb-1.5">Search</label>
                    <input name="search" value="{{ request('search') }}" type="text" placeholder="Nama atau email..."
                        class="w-full px-3 py-2 bg-[#fcf9f8] border border-[#e4beba] rounded-lg text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none" />
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-[#af101a] text-white text-sm font-bold rounded-lg hover:bg-red-800 transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-[#af101a] text-sm font-bold hover:bg-[#fdcbd0] rounded-lg transition-colors">
                        Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-[#e4beba] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0eded] text-[#5b403d] border-b border-[#e4beba]">
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">User Details</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Contact Info</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Role</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Reg. Date</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba]">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] transition-colors group">

                        {{-- User Details --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($item->foto_profile)
                                    <img src="{{ asset('storage/' . $item->foto_profile) }}" alt="{{ $item->name }}"
                                        class="w-10 h-10 rounded-full object-cover border border-[#e4beba] shrink-0"/>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-[#d32f2f] flex items-center justify-center text-white font-bold text-sm shrink-0 border border-[#af101a]">
                                        {{ strtoupper(substr($item->name ?? 'U', 0, 2)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-[#1b1c1c]">{{ $item->name ?? '-' }}</p>
                                    <p class="text-xs text-[#5b403d]">ID: VR-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Contact Info --}}
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-[#1b1c1c]">{{ $item->email ?? '-' }}</p>
                            <p class="text-xs text-[#5b403d]">{{ $item->no_telp ?? '-' }}</p>
                        </td>

                        {{-- Role --}}
                        <td class="px-6 py-4">
                            @if(strtolower($item->role ?? '') === 'admin')
                                <span class="px-3 py-1 bg-[#af101a] text-white text-[10px] font-black uppercase rounded-full">Admin</span>
                            @else
                                <span class="px-3 py-1 bg-[#fdcbd0] text-[#795358] text-[10px] font-black uppercase rounded-full">User</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @php $status = strtolower($item->status ?? 'active'); @endphp
                            @if($status === 'active' || $status === 'aktif')
                                <div class="flex items-center gap-1.5 text-green-600">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-xs font-bold uppercase">Active</span>
                                </div>
                            @elseif($status === 'suspended')
                                <div class="flex items-center gap-1.5 text-[#ba1a1a]">
                                    <div class="w-2 h-2 bg-[#ba1a1a] rounded-full"></div>
                                    <span class="text-xs font-bold uppercase">Suspended</span>
                                </div>
                            @else
                                <div class="flex items-center gap-1.5 text-gray-500">
                                    <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                    <span class="text-xs font-bold uppercase">Inactive</span>
                                </div>
                            @endif
                        </td>

                        {{-- Reg. Date --}}
                        <td class="px-6 py-4">
                            <p class="text-sm text-[#5b403d]">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}
                            </p>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.users.edit', $item->id) }}"
                                    class="p-2 text-[#5b403d] hover:text-[#af101a] hover:bg-red-50 rounded-lg transition-all"
                                    title="Edit Profile">
                                    <span class="material-symbols-outlined text-[20px]">edit_note</span>
                                </a>
                                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-[#5b403d] hover:text-[#ba1a1a] hover:bg-red-50 rounded-lg transition-all"
                                        title="Delete User">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-[#5b403d]">
                            <span class="material-symbols-outlined text-4xl block mb-2 text-[#e4beba]">group_off</span>
                            <p class="font-medium">Belum ada data user.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="px-6 py-4 bg-[#f6f3f2] flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-[#e4beba]">
            @if(method_exists($items, 'firstItem'))
                <p class="text-sm text-[#5b403d]">
                    Showing <span class="font-bold text-[#1b1c1c]">{{ $items->firstItem() }} - {{ $items->lastItem() }}</span>
                    of {{ number_format($items->total()) }} users
                </p>
            @endif
            @if(method_exists($items, 'links'))
                {{ $items->links() }}
            @endif
        </div>
    </div>

</div>
@endsection