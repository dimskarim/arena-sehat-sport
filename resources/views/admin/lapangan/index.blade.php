@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-2 mb-8">
        <div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 mb-2">Venues</h1>
            <p class="text-slate-500 text-[16px] max-w-md">Manage your arena's court availability, pricing, and operational status across all facilities.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 text-[14px] font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-lg">file_download</span>
                Export PDF
            </button>
            <a href="{{ route('admin.lapangans.create') }}" class="flex items-center gap-2 px-6 py-3 bg-[#af101a] text-white text-[14px] font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <span class="material-symbols-outlined text-lg">add_circle</span>
                Add New Venue
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-6 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Bento Dashboard Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col gap-2">
            <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">Total Venues</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900">{{ $items->total() ?? count($items) }}</span>
                <span class="text-green-600 text-xs font-bold">data aktif</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col gap-2">
            <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">Avg. Occupancy</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900">82%</span>
                <span class="text-red-600 text-xs font-bold">-4% today</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col gap-2">
            <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">Active Now</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900">{{ $items->where('status', 'tersedia')->count() }}</span>
                <span class="text-slate-500 text-xs">courts active</span>
            </div>
        </div>
        <div class="bg-red-50 p-6 rounded-xl border border-red-100 shadow-sm flex flex-col gap-2">
            <span class="text-red-700 text-xs font-bold uppercase tracking-widest">Revenue Forecast</span>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-black text-red-700">+12%</span>
                <span class="text-red-600 text-xs font-bold">this month</span>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-4 flex-1">
            <form method="GET" action="{{ route('admin.lapangans.index') }}" class="relative w-full max-w-md">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-red-100 focus:border-red-500 transition-all text-sm outline-none" placeholder="Search by name, type, or ID..." type="text" />
            </form>
            <div class="h-10 w-[1px] bg-slate-100 hidden md:block"></div>
            <div class="hidden md:flex items-center gap-2">
                <span class="text-sm font-semibold text-slate-500 px-2">Filters:</span>
                <button class="px-4 py-2 bg-red-50 text-red-700 text-xs font-bold rounded-full border border-red-100">All Sports</button>
                <button class="px-4 py-2 bg-white text-slate-600 text-xs font-bold rounded-full border border-slate-200 hover:border-red-200 transition-colors">Indoor</button>
                <button class="px-4 py-2 bg-white text-slate-600 text-xs font-bold rounded-full border border-slate-200 hover:border-red-200 transition-colors">Premium</button>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button class="p-2.5 text-slate-500 hover:bg-slate-50 rounded-lg border border-transparent hover:border-slate-200 transition-all">
                <span class="material-symbols-outlined">filter_list</span>
            </button>
            <button class="p-2.5 text-slate-500 hover:bg-slate-50 rounded-lg border border-transparent hover:border-slate-200 transition-all">
                <span class="material-symbols-outlined">sort_by_alpha</span>
            </button>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider">Venue Name</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider text-center">Hourly Rate</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider">Operational Status</th>
                        <th class="px-6 py-4 text-xs font-black text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($items as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        {{-- Venue Name --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-16 rounded-lg bg-slate-100 overflow-hidden shrink-0">
                                    @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->name }}" class="w-full h-full object-cover" />
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined">stadium</span>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">{{ $item->name ?? '-' }}</p>
                                    <p class="text-xs text-slate-400">ID: LPN-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Type / Kategori --}}
                        <td class="px-6 py-4">
                            @php
                            $kategoriColors = [
                            'futsal' => 'bg-blue-50 text-blue-700 bg-blue-500',
                            'badminton' => 'bg-orange-50 text-orange-700 bg-orange-500',
                            'tennis' => 'bg-emerald-50 text-emerald-700 bg-emerald-500',
                            'basketball' => 'bg-purple-50 text-purple-700 bg-purple-500',
                            'voli' => 'bg-yellow-50 text-yellow-700 bg-yellow-500',
                            ];
                            $namaKat = strtolower($item->kategori->name ?? '');
                            $matched = null;
                            foreach ($kategoriColors as $key => $classes) {
                            if (str_contains($namaKat, $key)) {
                            $matched = $classes;
                            break;
                            }
                            }
                            $colorParts = $matched ? explode(' ', $matched) : ['bg-slate-50', 'text-slate-700', 'bg-slate-500'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $colorParts[0] }} {{ $colorParts[1] }} rounded-full text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full {{ $colorParts[2] }}"></span>
                                {{ $item->kategori->name ?? '-' }}
                            </span>
                        </td>

                        {{-- Hourly Rate --}}
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold text-slate-900">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</span>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">
                            @if(strtolower($item->status ?? '') === 'tersedia')
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-bold border border-green-100">Active</span>
                            @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-xs font-bold border border-slate-200">Inactive</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.lapangans.edit', $item->id) }}" class="p-2 text-slate-400 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-lg">edit_note</span>
                                </a>
                                <form action="{{ route('admin.lapangans.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus lapangan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                            <span class="material-symbols-outlined text-4xl block mb-2">stadium</span>
                            <p class="font-medium">Belum ada data lapangan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs font-medium text-slate-500">Showing {{ $items->firstItem() ?? 0 }} – {{ $items->lastItem() ?? 0 }} of {{ $items->total() ?? 0 }} venues</p>
            @endif
            @if(method_exists($items, 'links'))
            {{ $items->links() }}
            @endif
        </div>
    </div>

    {{-- Promo / Help Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-8 rounded-2xl bg-gradient-to-br from-red-600 to-red-800 text-white relative overflow-hidden">
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <h3 class="font-['Lexend'] text-xl font-semibold mb-2">Venue Insights Pro</h3>
                    <p class="text-red-100 text-sm max-w-xs">Get advanced analytics on court performance and peak-hour heatmaps for better scheduling.</p>
                </div>
                <button class="mt-8 px-6 py-2.5 bg-white text-red-700 font-bold rounded-lg text-sm self-start hover:bg-red-50 transition-colors">Explore Analytics</button>
            </div>
            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-[120px] opacity-10 rotate-12">trending_up</span>
        </div>
        <div class="p-8 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-start gap-6">
            <div class="h-16 w-16 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-red-700 text-3xl">contact_support</span>
            </div>
            <div>
                <h3 class="font-['Lexend'] text-xl font-semibold mb-1">Need assistance?</h3>
                <p class="text-slate-500 text-sm mb-4">Our dedicated venue support team is available 24/7 to help you optimize your sports facility management.</p>
                <a class="text-red-700 font-bold text-sm flex items-center gap-1 hover:underline" href="#">
                    Open Support Center
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection