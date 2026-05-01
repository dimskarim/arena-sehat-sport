@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
    <!-- Card Item Start -->
    <div class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    {{ $totalLapangans }}
                </h4>
                <span class="text-sm font-medium">Total Lapangan</span>
            </div>
        </div>
    </div>
    <!-- Card Item End -->
    
    <!-- Card Item Start -->
    <div class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    {{ $totalBookings }}
                </h4>
                <span class="text-sm font-medium">Total Booking</span>
            </div>
        </div>
    </div>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <div class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    {{ $totalUsers }}
                </h4>
                <span class="text-sm font-medium">Total Pengguna</span>
            </div>
        </div>
    </div>
    <!-- Card Item End -->

    <!-- Card Item Start -->
    <div class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h4>
                <span class="text-sm font-medium">Total Pendapatan</span>
            </div>
        </div>
    </div>
    <!-- Card Item End -->
</div>
@endsection
