@props(['variant' => 'admin'])
@php
    $user = auth()->user();
    $userId = $user ? $user->id : null;
    $role = $user ? $user->role : 'pengguna';
    
    if ($userId) {
        if ($role === 'pemilik') {
            $query = \App\Models\Notifikasi::where(function($q) use ($userId) {
                $q->whereHas('booking.lapangan', function ($q2) use ($userId) {
                    $q2->where('pemilik_id', $userId);
                })->orWhere('user_id', $userId);
            });
        } else {
            $query = \App\Models\Notifikasi::where('user_id', $userId);
        }
        $notifications = (clone $query)->latest()->take(4)->get();
        $unreadCount = (clone $query)->where('is_read', false)->count();
    } else {
        $notifications = collect([]);
        $unreadCount = 0;
    }
    
    $hasUnread = $unreadCount > 0;
    $readRouteName = in_array($role, ['admin', 'pemilik']) ? 'admin.notifications.read' : 'front.notifications.read';
@endphp
{{-- Notification Dropdown Component --}}
<div class="relative" x-data="{
    dropdownOpen: false,
    notifying: {{ $hasUnread ? 'true' : 'false' }},
    toggleDropdown() {
        this.dropdownOpen = !this.dropdownOpen;
        this.notifying = false;
    },
    closeDropdown() {
        this.dropdownOpen = false;
    }
}" @click.away="closeDropdown()">
    <!-- Notification Button -->
    <button
        class="{{ $variant === 'front' ? 'relative flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-red-600 transition-all p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none' : 'relative flex items-center justify-center text-gray-500 transition-colors bg-white border border-gray-200 rounded-full hover:text-dark-900 h-11 w-11 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white' }}"
        @click="toggleDropdown()"
        type="button"
    >
        <!-- Notification Badge -->
        <span
            x-show="notifying"
            class="{{ $variant === 'front' ? 'absolute top-1.5 right-1.5 z-10 h-2.5 w-2.5 rounded-full bg-orange-500 border-2 border-white dark:border-gray-900' : 'absolute right-0 top-0.5 z-10 h-2 w-2 rounded-full bg-orange-400' }}"
        >
            <span class="absolute inline-flex w-full h-full bg-orange-400 rounded-full opacity-75 -z-10 animate-ping"></span>
        </span>

        <!-- Bell Icon -->
        @if($variant === 'front')
            <span class="material-symbols-outlined">notifications</span>
        @else
            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.75 2.29248C10.75 1.87827 10.4143 1.54248 10 1.54248C9.58583 1.54248 9.25004 1.87827 9.25004 2.29248V2.83613C6.08266 3.20733 3.62504 5.9004 3.62504 9.16748V14.4591H3.33337C2.91916 14.4591 2.58337 14.7949 2.58337 15.2091C2.58337 15.6234 2.91916 15.9591 3.33337 15.9591H4.37504H15.625H16.6667C17.0809 15.9591 17.4167 15.6234 17.4167 15.2091C17.4167 14.7949 17.0809 14.4591 16.6667 14.4591H16.375V9.16748C16.375 5.9004 13.9174 3.20733 10.75 2.83613V2.29248ZM14.875 14.4591V9.16748C14.875 6.47509 12.6924 4.29248 10 4.29248C7.30765 4.29248 5.12504 6.47509 5.12504 9.16748V14.4591H14.875ZM8.00004 17.7085C8.00004 18.1228 8.33583 18.4585 8.75004 18.4585H11.25C11.6643 18.4585 12 18.1228 12 17.7085C12 17.2943 11.6643 16.9585 11.25 16.9585H8.75004C8.33583 16.9585 8.00004 17.2943 8.00004 17.7085Z" fill="" />
            </svg>
        @endif
    </button>

    <!-- Dropdown Start -->
    <div
        x-show="dropdownOpen"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="fixed inset-x-4 top-[72px] sm:absolute sm:inset-auto sm:right-0 sm:mt-[17px] flex h-auto max-h-[480px] w-auto sm:w-[350px] flex-col rounded-2xl border border-gray-200 bg-white p-3 shadow-xl dark:border-gray-800 dark:bg-gray-900 z-50"
        style="display: none;"
    >
        <!-- Dropdown Header -->
        <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100 dark:border-gray-800">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-white/90">Notification</h5>

            <button @click="closeDropdown()" class="text-gray-500 dark:text-gray-400" type="button">
                <svg
                    class="fill-current"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z"
                        fill=""
                    />
                </svg>
            </button>
        </div>

        <!-- Notification List -->
        <ul class="flex flex-col h-auto overflow-y-auto custom-scrollbar">
            @forelse ($notifications as $notification)
                <li>
                    <a
                        class="flex gap-4 rounded-xl border border-transparent p-3 transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50 {{ !$notification->is_read ? 'bg-red-50/50 dark:bg-red-900/10 border-red-100 dark:border-red-900/30' : '' }}"
                        href="{{ route($readRouteName, $notification->id) }}"
                    >
                        <div class="flex-shrink-0 mt-1">
                            <div class="flex items-center justify-center w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full text-red-600 dark:text-red-400">
                                @if($variant === 'front')
                                    <span class="material-symbols-outlined text-[20px]">notifications_active</span>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                <p class="font-bold text-gray-900 dark:text-white leading-snug mb-1">
                                    {{ $notification->pesan }}
                                </p>
                                <p class="text-xs leading-relaxed line-clamp-2">{{ $notification->deskripsi }}</p>
                            </div>

                            <p class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500 font-medium mt-2">
                                @if($variant === 'front')
                                    <span class="material-symbols-outlined text-[14px]">schedule</span>
                                @else
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endif
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                </li>
            @empty
                <li class="p-4 text-center text-gray-500 dark:text-gray-400 text-sm">
                    Belum ada notifikasi
                </li>
            @endforelse
        </ul>

        <!-- View All Button -->
        @if(in_array($role, ['admin', 'pemilik']))
        <a
            href="{{ route('admin.notifications.index') }}"
            class="mt-3 flex justify-center rounded-lg border border-gray-300 bg-white p-3 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
        >
            View All Notification
        </a>
        @endif
    </div>
    <!-- Dropdown End -->
</div>

@if(!request()->routeIs('notifications.dropdown'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.notificationPollInterval) return;
        window.notificationPollInterval = setInterval(function() {
            const wrapper = document.getElementById('notification-dropdown-wrapper');
            if (wrapper) {
                const currentDropdown = wrapper.querySelector('[x-data]');
                let isOpen = false;
                if (currentDropdown && window.Alpine) {
                    try {
                        isOpen = Alpine.$data(currentDropdown).dropdownOpen;
                    } catch (e) { }
                }
                if (!isOpen) {
                    fetch('{{ route("notifications.dropdown") }}', {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(r => {
                        if (r.redirected || r.url.includes('/login')) {
                            window.location.reload();
                            return Promise.reject('Session expired');
                        }
                        return r.ok ? r.text() : Promise.reject('Network Error');
                    })
                    .then(html => { 
                        wrapper.innerHTML = html;
                    })
                    .catch(e => console.error('Error polling notifications:', e));
                }
            }
        }, 10000); // Check every 10 seconds
    });
</script>
@endif
