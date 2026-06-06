@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">
    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.slot-waktus.index') }}" class="hover:text-red-700 dark:hover:text-red-400 transition-colors">Slot Waktu</a>
                <svg class="text-base inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-900 dark:text-white font-semibold">Semua Slot</span>
            </div>
            <h1 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white">Daftar Slot Waktu</h1>
            <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Kelola jam sewa lapangan yang tersedia untuk di booking.</p>
        </div>
        <a href="{{ route('admin.slot-waktus.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:bg-red-800 transition-all shadow-lg shadow-red-700/20 active:scale-95 dark:bg-red-600 dark:hover:bg-red-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Slot Waktu
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-7 py-4 shadow-sm rounded-r-xl dark:bg-green-900/20 dark:border-green-500">
        <p class="leading-relaxed text-green-800 dark:text-green-400 font-semibold text-sm">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Data Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-slate-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-gray-900/50 text-slate-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider border-b border-slate-100 dark:border-gray-700">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Venue Lapangan</th>
                        <th class="px-6 py-4">Jam Mulai</th>
                        <th class="px-6 py-4">Jam Selesai</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-gray-700">
                    @forelse($items as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-700/20 transition-colors group">
                        <td class="px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white">
                            #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ optional($item->lapangan)->name ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-gray-700 dark:text-gray-300">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $item->waktu_mulai ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 dark:bg-gray-700 dark:text-gray-300">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $item->waktu_selesai ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.slot-waktus.edit', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-[#af101a] hover:bg-red-50 transition-colors dark:hover:bg-red-900/30 dark:hover:text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                                <form action="{{ route('admin.slot-waktus.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus slot waktu ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors dark:hover:bg-red-900/30 dark:hover:text-red-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <p class="font-medium text-sm">Belum ada data slot waktu.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-slate-50 dark:bg-gray-800/50 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-100 dark:border-gray-700">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs text-slate-500 dark:text-gray-400">Menampilkan <span class="font-bold text-slate-900 dark:text-white">{{ $items->firstItem() }} - {{ $items->lastItem() }}</span> dari {{ number_format($items->total()) }} data</p>
            @endif
            @if(method_exists($items, 'links')) {{ $items->links('components.pagination') }} @endif
        </div>
    </div>
</div>
@endsection