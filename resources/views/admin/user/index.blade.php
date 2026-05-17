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
            <svg class=" inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
            </svg>
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
                <svg class="text-[#795358] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] uppercase tracking-wider">Total Pengguna</p>
                <p class="text-2xl font-black font-['Lexend']">
                    {{ method_exists($items, 'total') ? number_format($items->total()) : count($items) }}
                </p>
            </div>
        </div>

        {{-- Stat: Admin --}}
        <div class="bg-[#f6f3f2] p-6 rounded-xl border border-[#e4beba] flex items-center gap-4">
            <div class="bg-red-50 p-3 rounded-full shrink-0">
                <svg class="text-[#af101a] inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold text-[#5b403d] uppercase tracking-wider">Admin Aktif</p>
                <p class="text-2xl font-black font-['Lexend'] text-[#af101a]">
                    {{ $items->where('role', 'admin')->count() }}
                </p>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="lg:col-span-2 bg-white p-4 rounded-xl border border-[#e4beba] flex flex-wrap items-end gap-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-end gap-4 w-full">
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-[10px] font-bold text-[#5b403d] uppercase tracking-widest mb-1.5">Filter Peran</label>
                    <select name="role" class="w-full px-3 py-2 bg-[#fcf9f8] border border-[#e4beba] rounded-lg text-sm focus:ring-2 focus:ring-red-100 focus:border-[#af101a] outline-none appearance-none cursor-pointer">
                        <option value="">Semua Peran</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Pengguna</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[140px]">
                    <label class="block text-[10px] font-bold text-[#5b403d] uppercase tracking-widest mb-1.5">Pencarian</label>
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
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Detail Pengguna</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Info Kontak</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Peran</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest">Tgl. Daftar</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e4beba]">
                    @forelse($items as $item)
                    <tr class="hover:bg-[#f6f3f2] transition-colors group">

                        {{-- User Details --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($item->foto_profile)
                                <img src="https://ui-avatars.com/api/?name=User&background=FFCDD2&color=D32F2F" alt="{{ $item->name }}"
                                    class="w-10 h-10 rounded-full object-cover border border-[#e4beba] shrink-0" />
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
                                <span class="text-xs font-bold uppercase">Aktif</span>
                            </div>
                            @elseif($status === 'suspended')
                            <div class="flex items-center gap-1.5 text-[#ba1a1a]">
                                <div class="w-2 h-2 bg-[#ba1a1a] rounded-full"></div>
                                <span class="text-xs font-bold uppercase">Ditangguhkan</span>
                            </div>
                            @else
                            <div class="flex items-center gap-1.5 text-gray-500">
                                <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                <span class="text-xs font-bold uppercase">Tidak Aktif</span>
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
                                    title="Ubah Profil">
                                    <svg class="text-[20px] inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-[#5b403d] hover:text-[#ba1a1a] hover:bg-red-50 rounded-lg transition-all"
                                        title="Hapus Pengguna">
                                        <svg class="text-[20px] inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-[#5b403d]">
                            <svg class="text-4xl block mb-2 text-[#e4beba] inline-block align-middle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
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
                Menampilkan <span class="font-bold text-[#1b1c1c]">{{ $items->firstItem() }} - {{ $items->lastItem() }}</span>
                dari {{ number_format($items->total()) }} pengguna
            </p>
            @endif
            @if(method_exists($items, 'links'))
            {{ $items->links() }}
            @endif
        </div>
    </div>

</div>
@endsection