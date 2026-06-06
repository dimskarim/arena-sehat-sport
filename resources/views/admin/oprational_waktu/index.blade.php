@extends('layouts.app')

@section('content')
<div class="max-w-[1280px] mx-auto font-['Inter'] text-slate-900">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-['Lexend'] text-[32px] font-semibold tracking-tight text-slate-900 dark:text-white">
                Manajemen Jadwal Operasional
            </h2>
            <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Kelola jam buka dan tutup untuk setiap lapangan.</p>
        </div>

        <nav>
            <a href="{{ route('admin.oprational-waktus.create') }}" class="flex items-center gap-2 px-6 py-2.5 bg-[#af101a] text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-lg shadow-red-700/20 active:scale-95">
                <svg class="text-lg inline-block align-middle w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Jadwal Baru
            </a>
        </nav>
    </div>

@if(session('success'))
<div class="mb-6 flex w-full border-l-4 border-green-500 bg-green-50 px-6 py-4 shadow-sm rounded-r-xl dark:bg-green-900/20 dark:border-green-500">
    <div class="w-full">
        <p class="leading-relaxed text-green-800 dark:text-green-400 text-sm font-bold">
            {{ session('success') }}
        </p>
    </div>
</div>
@endif

<div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-slate-50 text-left border-b border-slate-100 dark:bg-gray-900/50 dark:border-gray-700">
                    <th class="min-w-[50px] py-4 px-6 font-bold text-xs uppercase tracking-widest text-slate-500 dark:text-gray-400">ID</th>
                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-widest text-slate-500 dark:text-gray-400">Venue Lapangan</th>
                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-widest text-slate-500 dark:text-gray-400">Hari Operasional</th>
                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-widest text-slate-500 dark:text-gray-400">Jam Buka</th>
                    <th class="py-4 px-6 font-bold text-xs uppercase tracking-widest text-slate-500 dark:text-gray-400">Jam Tutup</th>

                    <th class="min-w-[120px] py-4 px-6 font-bold text-xs uppercase tracking-widest text-slate-500 dark:text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-gray-700">
                @forelse($items as $item)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-gray-700/20 transition-colors">
                    <td class="py-4 px-6">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $item->id }}</p>
                    </td>
                    <td class="py-4 px-6"><p class="text-sm text-slate-600 dark:text-gray-300">{{ optional($item->lapangan)->name ?? '-' }}</p></td>
                    <td class="py-4 px-6"><p class="text-sm text-slate-600 dark:text-gray-300">{{ $item->hari ?? '-' }}</p></td>
                    <td class="py-4 px-6"><p class="text-sm text-slate-600 dark:text-gray-300">{{ $item->waktu_buka ?? '-' }}</p></td>
                    <td class="py-4 px-6"><p class="text-sm text-slate-600 dark:text-gray-300">{{ $item->waktu_tutup ?? '-' }}</p></td>

                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.oprational-waktus.edit', $item->id) }}" class="text-slate-400 hover:text-[#af101a] dark:text-gray-500 dark:hover:text-red-400 transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.oprational-waktus.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-600 dark:text-gray-500 dark:hover:text-red-400 transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-500 dark:text-gray-400">
                            <svg class="w-12 h-12 mb-3 text-slate-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm font-medium">Belum ada jadwal operasional yang diatur.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-6 border-t border-slate-100 dark:border-gray-700">
        @if(method_exists($items, 'links'))
            {{ $items->links('components.pagination') }}
        @endif
    </div>
</div>
</div>
@endsection
