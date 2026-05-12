@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap');

    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>

<div class="max-w-[1280px] mx-auto font-['Inter'] text-[#1b1c1c]">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h2 class="font-['Lexend'] text-[32px] font-semibold tracking-tight leading-[1.3] text-[#1b1c1c]">Booking Management</h2>
            <p class="text-[16px] text-[#5b403d] mt-1">Review and manage all incoming court reservations.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.bookings.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#e4beba] rounded-xl text-[14px] font-semibold hover:bg-[#f6f3f2] transition-colors active:scale-95 text-[#1b1c1c]">
                <span class="material-symbols-outlined text-xl" data-icon="add">add</span>
                Add Booking
            </a>
            <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#e4beba] rounded-xl text-[14px] font-semibold hover:bg-[#f6f3f2] transition-colors active:scale-95 text-[#1b1c1c]">
                <span class="material-symbols-outlined text-xl" data-icon="file_download">file_download</span>
                Export CSV
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 flex w-full border-l-4 border-green-500 bg-green-50 px-7 py-4 shadow-sm rounded-r-xl">
        <p class="leading-relaxed text-green-800 font-semibold text-sm">
            {{ session('success') }}
        </p>
    </div>
    @endif

    <!-- Stats Overview (Asymmetric/Bento Style) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="md:col-span-2 bg-[#d32f2f] p-6 rounded-xl text-[#fff2f0] shadow-lg shadow-[#af101a]/20 flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-[14px] font-semibold opacity-80 uppercase tracking-wider text-xs">Total Revenue (Month)</p>
                <h3 class="text-4xl font-bold mt-2">Rp 42.850.000</h3>
                <p class="text-sm mt-4 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span>
                    12% increase from last month
                </p>
            </div>
            <span class="material-symbols-outlined absolute -right-4 -bottom-4 text-9xl opacity-10 rotate-12" data-icon="payments">payments</span>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between">
            <div>
                <p class="text-sm text-[#5b403d] font-semibold text-[14px]">Active Bookings</p>
                <h3 class="text-3xl font-bold text-[#1b1c1c] mt-1">128</h3>
            </div>
            <div class="mt-4 flex -space-x-2">
                <img alt="User 1" class="w-8 h-8 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDvGBU2SLUFlIuLO3MnJxSMJQpLnsMyNcdlo1NIxILpYfCz3BmaUN0sNDzMinNu1ywrtsZ9pdLyLJahyt9DribRjXn5mUaPLDAMowZnHP7CqJ5dIWnYz6diitvE0vfHw7pa15anQeXsFrVlb0OMVlH_jRcjEoziYBvZkCx1bCXWFpTWgzQ3CqRU8_Slcu6-gavqUIzTe7mSrpB2X8LL7nAxhQeUPxSPaHOYXyBmuLzKXctKwhg0gWsDkLh4eL5jbt2WKyxxs779lA" />
                <img alt="User 2" class="w-8 h-8 rounded-full border-2 border-white" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDtPQ1RtajNuhvDIy4Dv7AvEjLRt5DLtxZtx7zVNT7KML8iC6cQ9W6QL9wLfwW3Qsz9pk6toRa-0YXdZID7IYilnoTFz6dDhIza5FUIaFiOjC5HAjnnpvX394PYrfOujVOGnM9abQOJHztTL-2oSbUQ0IAWcdfLAW1gv2n0rrp703pkIRQ0MPogWhQ1wHakp9HvK8EnGHAtvG1Veb2hXmc4Nw0y5wpVJ3_WVxhFd4HEBlSzOZ4yXbt1hMEY2pdO0p88j0EEusIAzyM" />
                <div class="w-8 h-8 rounded-full border-2 border-white bg-zinc-100 flex items-center justify-center text-[10px] font-bold text-zinc-600">+120</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-[#e4beba] shadow-sm flex flex-col justify-between">
            <div>
                <p class="text-sm text-[#5b403d] font-semibold text-[14px]">Pending Approval</p>
                <h3 class="text-3xl font-bold text-[#ba1a1a] mt-1">14</h3>
            </div>
            <button class="text-[#af101a] font-bold text-sm text-left hover:underline">View all pending</button>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-2xl border border-[#e4beba] shadow-sm overflow-hidden mb-8">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="p-6 border-b border-[#e4beba]">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block">Booking Date</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#5b403d] text-lg" data-icon="event"></span>
                            <input name="date" value="{{ request('date') }}" class="w-full pl-10 pr-4 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all" type="date" />
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block">Status</label>
                        <select name="status" class="w-full px-4 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all appearance-none cursor-pointer">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-[#5b403d] mb-1.5 block">Venue</label>
                        <select name="venue_id" class="w-full px-4 py-2.5 bg-[#fcf9f8] rounded-xl border border-[#e4beba] text-sm focus:border-[#af101a] focus:ring-0 transition-all appearance-none cursor-pointer">
                            <option value="">All Venues</option>
                        </select>
                    </div>
                </div>
                <div class="lg:pt-6">
                    <button type="submit" class="w-full lg:w-auto px-8 py-2.5 bg-[#1b1c1c] text-[#fcf9f8] rounded-xl font-bold hover:bg-zinc-800 transition-colors active:scale-95">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Content -->
    <div class="overflow-x-auto bg-white rounded-t-xl border border-[#e4beba] border-b-0">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#f0eded] text-[#5b403d] text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">User</th>
                    <th class="px-6 py-4">Venue/Court</th>
                    <th class="px-6 py-4">Date & Time</th>
                    <th class="px-6 py-4 text-right">Total Price</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e4beba]">
                @forelse($items as $item)
                <tr class="hover:bg-[#f6f3f2] transition-colors group">
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center font-bold text-[#af101a]">
                                {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-bold text-[#1b1c1c]">{{ $item->user->name ?? '-' }}</p>
                                <p class="text-xs text-[#5b403d]">{{ $item->user->email ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        <p class="font-medium text-[#1b1c1c]">{{ $item->lapangan->name ?? '-' }}</p>
                        <p class="text-xs text-[#5b403d]">{{ $item->lapangan->kategori->name ?? 'Venue' }}</p>
                    </td>
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        <p class="font-medium text-[#1b1c1c]">{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d M Y') }}</p>
                        <p class="text-xs text-[#5b403d]">{{ $item->waktu_mulai ?? '' }} - {{ $item->waktu_selesai ?? '' }}</p>
                    </td>
                    <td class="px-6 py-5 text-right font-bold text-[#1b1c1c] border-b border-[#e4beba]">
                        Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-5 border-b border-[#e4beba]">
                        @if(strtolower($item->status) == 'paid' || strtolower($item->status) == 'completed' || strtolower($item->status) == 'confirmed')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5"></span>
                            {{ ucfirst($item->status) }}
                        </span>
                        @elseif(strtolower($item->status) == 'pending')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-600 mr-1.5"></span>
                            Pending
                        </span>
                        @elseif(strtolower($item->status) == 'canceled' || strtolower($item->status) == 'cancelled')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-zinc-200 text-zinc-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-zinc-500 mr-1.5"></span>
                            Canceled
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-600 mr-1.5"></span>
                            {{ ucfirst($item->status) }}
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-center border-b border-[#e4beba]">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.bookings.edit', $item->id) }}" class="text-[#af101a] font-bold text-xs hover:bg-[#ffdad6] px-3 py-1.5 rounded-lg transition-colors">
                                View Details
                            </a>
                            <form action="{{ route('admin.bookings.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-bold text-xs hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-[#5b403d]">Belum ada data pemesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-6 bg-[#f6f3f2] flex flex-col sm:flex-row items-center justify-between rounded-b-xl border border-[#e4beba] border-t-0">
        <div class="mb-4 sm:mb-0">
            @if(method_exists($items, 'firstItem'))
            <p class="text-xs font-medium text-[#5b403d]">Showing {{ $items->firstItem() ?? 0 }} to {{ $items->lastItem() ?? 0 }} of {{ $items->total() ?? 0 }} bookings</p>
            @endif
        </div>
        <div>
            @if(method_exists($items, 'links'))
            {{ $items->links() }}
            @endif
        </div>
    </div>

    <!-- Promotion / Action Section (Bento Bottom) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="bg-zinc-900 text-white p-8 rounded-2xl items-center">
            <div>
                <h4 class="text-xl font-bold mb-2">Automated Reports</h4>
                <p class="text-sm text-zinc-400">Generate weekly revenue and occupancy reports automatically and send to venue owners.</p>
                <button class="mt-6 px-6 py-2 bg-white text-zinc-900 rounded-xl font-bold text-sm hover:bg-zinc-200 transition-colors">Setup Schedule</button>
            </div>
        </div>
        <div class="bg-[#fdcbd0] text-[#795358] p-8 rounded-2xl items-center">
            <div>
                <h4 class="text-xl font-bold mb-2">Venue Capacity</h4>
                <p class="text-sm opacity-80">Monitor real-time court availability and manage peak-hour pricing strategies.</p>
                <button class="mt-6 px-6 py-2 bg-[#795358] text-white rounded-xl font-bold text-sm hover:opacity-90 transition-colors">Check Availability</button>
            </div>
        </div>
    </div>
</div>
@endsection