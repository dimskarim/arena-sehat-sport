@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md2 font-bold text-black dark:text-white">
        Data Jam Oprational
    </h2>

    <nav>
        <a href="{{ route('admin.oprational-waktus.create') }}" class="inline-flex items-center justify-center rounded-md bg-brand-500 py-2 px-6 text-center font-medium text-white hover:bg-opacity-90">
            Tambah Data
        </a>
    </nav>
</div>

@if(session('success'))
<div class="mb-4 flex w-full border-l-6 border-[#34D399] bg-[#34D399] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30">
    <div class="w-full">
        <p class="leading-relaxed text-[#34D399]">
            {{ session('success') }}
        </p>
    </div>
</div>
@endif

<div class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
    <div class="max-w-full overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th class="min-w-[50px] py-4 px-4 font-medium text-black dark:text-white">ID</th>
                    <th class="py-4 px-4 font-medium text-black dark:text-white">Hari</th>
                    <th class="py-4 px-4 font-medium text-black dark:text-white">Buka</th>
                    <th class="py-4 px-4 font-medium text-black dark:text-white">Tutup</th>

                    <th class="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <p class="text-black dark:text-white">{{ $item->id }}</p>
                    </td>
                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark"><p class="text-black dark:text-white">{{ $item->hari ?? '-' }}</p></td>
                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark"><p class="text-black dark:text-white">{{ $item->waktu_buka ?? '-' }}</p></td>
                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark"><p class="text-black dark:text-white">{{ $item->waktu_tutup ?? '-' }}</p></td>

                    <td class="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                        <div class="flex items-center space-x-3.5">
                            <a href="{{ route('admin.oprational-waktus.edit', $item->id) }}" class="hover:text-brand-500">Edit</a>
                            <form action="{{ route('admin.oprational-waktus.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:text-danger text-red-500">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-5 text-gray-500">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        @if(method_exists($items, 'links'))
            {{ $items->links() }}
        @endif
    </div>
</div>
@endsection
