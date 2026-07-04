<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'ArenaFlow - High-Performance Sports Booking')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/logo-icon.svg') }}" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <!-- Alpine.js for interactive components -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-high": "var(--color-surface-container-high, #eae7e7)",
                        "primary-container": "#d32f2f",
                        "secondary-fixed-dim": "#ebbabf",
                        "on-background": "var(--color-on-background, #1b1c1c)",
                        "inverse-primary": "#ffb3ac",
                        "secondary-fixed": "#ffd9dd",
                        "inverse-surface": "var(--color-inverse-surface, #303030)",
                        "surface-dim": "var(--color-surface-dim, #dcd9d9)",
                        "secondary": "#7a5459",
                        "background": "var(--color-background, #fcf9f8)",
                        "tertiary": "#005f7b",
                        "on-tertiary-container": "#e9f7ff",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed": "#2f1317",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#004d65",
                        "surface-container-low": "var(--color-surface-container-low, #f6f3f2)",
                        "tertiary-fixed": "#bee9ff",
                        "secondary-container": "#fdcbd0",
                        "on-error-container": "#93000a",
                        "surface-container": "var(--color-surface-container, #f0eded)",
                        "on-primary-fixed-variant": "#930010",
                        "on-primary-fixed": "#410003",
                        "tertiary-fixed-dim": "#7bd1f8",
                        "outline": "var(--color-outline, #8f6f6c)",
                        "error-container": "#ffdad6",
                        "inverse-on-surface": "var(--color-inverse-on-surface, #f3f0ef)",
                        "surface": "var(--color-surface, #fcf9f8)",
                        "outline-variant": "var(--color-outline-variant, #e4beba)",
                        "surface-bright": "var(--color-surface-bright, #fcf9f8)",
                        "on-tertiary": "#ffffff",
                        "on-primary-container": "#fff2f0",
                        "surface-variant": "var(--color-surface-variant, #e5e2e1)",
                        "surface-tint": "#ba1a20",
                        "surface-container-highest": "var(--color-surface-container-highest, #e5e2e1)",
                        "on-surface": "var(--color-on-surface, #1b1c1c)",
                        "primary": "#af101a",
                        "on-surface-variant": "var(--color-on-surface-variant, #5b403d)",
                        "primary-fixed-dim": "#ffb3ac",
                        "on-secondary-fixed-variant": "#603d42",
                        "on-tertiary-fixed": "#001f2a",
                        "primary-fixed": "#ffdad6",
                        "surface-container-lowest": "var(--color-surface-container-lowest, #ffffff)",
                        "error": "#ba1a1a",
                        "on-secondary-container": "#795358",
                        "tertiary-container": "#00799c"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sm": "12px",
                        "base": "8px",
                        "container-max": "1280px",
                        "gutter": "24px",
                        "lg": "48px",
                        "md": "24px",
                        "xs": "4px",
                        "xl": "80px"
                    },
                    "fontFamily": {
                        "h1": ["Lexend"],
                        "label-md": ["Inter"],
                        "h2": ["Lexend"],
                        "body-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "h3": ["Lexend"]
                    },
                    "fontSize": {
                        "h1": ["48px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "label-md": ["14px", {
                            "lineHeight": "1.2",
                            "fontWeight": "600"
                        }],
                        "h2": ["32px", {
                            "lineHeight": "1.3",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "h3": ["24px", {
                            "lineHeight": "1.4",
                            "fontWeight": "600"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        html.dark {
            --color-surface: #111827; /* gray-900 */
            --color-on-surface: #f9fafb; /* gray-50 */
            --color-surface-container-low: #1f2937; /* gray-800 */
            --color-surface-container-lowest: #030712; /* gray-950 */
            --color-surface-container: #374151; /* gray-700 */
            --color-surface-container-high: #4b5563; /* gray-600 */
            --color-surface-container-highest: #6b7280; /* gray-500 */
            --color-on-surface-variant: #9ca3af; /* gray-400 */
            --color-outline-variant: #374151; /* gray-700 */
            --color-outline: #6b7280; /* gray-500 */
            --color-background: #111827; /* gray-900 */
            --color-on-background: #f9fafb; /* gray-50 */
            --color-surface-dim: #030712; /* gray-950 */
            --color-surface-bright: #1f2937; /* gray-800 */
            --color-surface-variant: #374151; /* gray-700 */
            --color-inverse-surface: #f9fafb; /* gray-50 */
            --color-inverse-on-surface: #111827; /* gray-900 */
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-surface, #fcf9f8);
            color: var(--color-on-surface, #1b1c1c);
        }

        h1,
        h2,
        h3 {
            font-family: 'Lexend', sans-serif;
        }

        [x-cloak] { display: none !important; }

        /* Global Animation Styles */
        .motion-hidden {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .motion-hidden.slide-right {
            transform: translateX(-30px);
        }
        .motion-visible {
            opacity: 1;
            transform: translate(0, 0);
        }
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }
    </style>
    <script>
        // Apply dark mode immediately to prevent flash
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();

        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
    @stack('styles')
</head>

<body class="bg-surface font-body-md text-on-surface transition-colors duration-300">
    <header x-data="{ mobileMenuOpen: false }" @keydown.escape.window="mobileMenuOpen = false" class="fixed top-0 w-full z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 shadow-[0_4px_20px_rgba(211,47,47,0.08)]">
        <nav class="flex items-center justify-between px-6 h-16 w-full max-w-7xl mx-auto font-['Lexend'] antialiased">
            <!-- Left Side: Hamburger & Logo -->
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="lg:hidden text-gray-600 dark:text-gray-400 hover:text-red-600 transition-all p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none flex items-center justify-center -ml-2">
                    <span class="material-symbols-outlined" x-show="!mobileMenuOpen">menu</span>
                    <span class="material-symbols-outlined" x-show="mobileMenuOpen" x-cloak>close</span>
                </button>
                
                <!-- Logo (Hidden on mobile) -->
                <a href="{{ route('home') }}" class="hidden sm:block text-2xl font-black text-red-700 dark:text-red-500 tracking-tighter">ArenaFlow</a>
            </div>
            
            <!-- Desktop Links -->
            <div class="hidden lg:flex items-center gap-8">
                <a class="{{ request()->routeIs('home') ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }} font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('home') }}">Homes</a>
                <a class="{{ request()->routeIs('lapangan.*') ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }} font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('lapangan.index') }}">Venues</a>
                <a class="{{ request()->routeIs('booking.riwayat') ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }} font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('booking.riwayat') }}">My Bookings</a>
                <a class="{{ request()->routeIs('support') ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400' }} font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('support') }}">Support</a>
            </div>

            <!-- Action Buttons Container -->
            <div class="flex items-center gap-2 sm:gap-4">
                @auth
                    <!-- Notifications -->
                    <x-header.notification-dropdown variant="front" />
                @endauth

                <!-- Theme Toggle Button -->
                <button onclick="toggleDarkMode()" class="text-gray-600 dark:text-gray-400 hover:text-red-600 transition-all flex items-center justify-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" title="Toggle Theme">
                    <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                    <span class="material-symbols-outlined hidden dark:block">light_mode</span>
                </button>
                
                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 px-4 py-2 rounded-xl font-bold transition-all hover:bg-red-100 dark:hover:bg-red-900/40 border border-red-100 dark:border-red-900/50 shadow-sm hover:shadow-md">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                            <span class="hidden sm:inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-300 group-hover:rotate-180">keyboard_arrow_down</span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 top-[110%] w-56 bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl border border-gray-100 dark:border-gray-800 rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:top-full transition-all duration-300 z-50 overflow-hidden transform origin-top-right group-hover:scale-100 scale-95">
                            
                            <!-- Header / Welcome -->
                            <div class="px-4 py-3 bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Selamat datang,</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <div class="py-2">
                                <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                    <span class="material-symbols-outlined text-[20px] text-gray-400 group-hover:text-red-500">account_circle</span> 
                                    Profil Saya
                                </a>
                                <a href="{{ route('booking.riwayat') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                    <span class="material-symbols-outlined text-[20px] text-gray-400 group-hover:text-red-500">history</span> 
                                    Riwayat Booking
                                </a>
                            </div>
                            
                            <div class="border-t border-gray-100 dark:border-gray-800 py-2 bg-gray-50/30 dark:bg-gray-800/30">
                                <form action="{{ route('front.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 text-left px-4 py-2.5 text-sm font-bold text-red-600 dark:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 hover:text-red-700 dark:hover:text-red-400 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">logout</span> 
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-red-700 text-white px-4 py-2 sm:px-6 rounded-lg font-label-md transition-transform active:scale-95 hover:bg-red-800">Sign In</a>
                @endauth
            </div>
        </nav>
        
        <!-- Mobile Dropdown Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 -translate-y-4" 
             x-transition:enter-end="opacity-100 translate-y-0" 
             x-transition:leave="transition ease-in duration-150" 
             x-transition:leave-start="opacity-100 translate-y-0" 
             x-transition:leave-end="opacity-0 -translate-y-4" 
             class="lg:hidden absolute top-full left-0 w-full bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 shadow-xl z-40" 
             x-cloak>
            <div class="px-6 py-4 flex flex-col gap-4 font-['Lexend'] bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl">
                <a class="{{ request()->routeIs('home') ? 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20' : 'text-gray-600 dark:text-gray-400' }} block font-bold hover:text-red-600 dark:hover:text-red-400 transition-all px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800" href="{{ route('home') }}">Homes</a>
                <a class="{{ request()->routeIs('lapangan.*') ? 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20' : 'text-gray-600 dark:text-gray-400' }} block font-bold hover:text-red-600 dark:hover:text-red-400 transition-all px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800" href="{{ route('lapangan.index') }}">Venues</a>
                <a class="{{ request()->routeIs('booking.riwayat') ? 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20' : 'text-gray-600 dark:text-gray-400' }} block font-bold hover:text-red-600 dark:hover:text-red-400 transition-all px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800" href="{{ route('booking.riwayat') }}">My Bookings</a>
                <a class="{{ request()->routeIs('support') ? 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20' : 'text-gray-600 dark:text-gray-400' }} block font-bold hover:text-red-600 dark:hover:text-red-400 transition-all px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800" href="{{ route('support') }}">Support</a>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- Enhanced Modern Footer -->
    <footer class="bg-gradient-to-b from-white to-gray-50 dark:from-gray-950 dark:to-black w-full border-t border-gray-100 dark:border-gray-900 pt-16 pb-8 mt-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ route('home') }}" class="text-3xl font-black text-red-700 dark:text-red-500 tracking-tighter mb-4 inline-block">ArenaFlow<span class="text-gray-900 dark:text-white">.</span></a>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed max-w-md mb-6">
                        Platform reservasi fasilitas olahraga premium terdepan. Kami menghubungkan atlet dengan lapangan berkualitas tinggi untuk performa maksimal Anda setiap saat.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500 hover:border-red-200 dark:hover:border-red-900/50 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all group shadow-sm">
                            <span class="material-symbols-outlined text-[20px] group-hover:scale-110 transition-transform">language</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500 hover:border-red-200 dark:hover:border-red-900/50 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all group shadow-sm">
                            <span class="material-symbols-outlined text-[20px] group-hover:scale-110 transition-transform">alternate_email</span>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500 hover:border-red-200 dark:hover:border-red-900/50 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all group shadow-sm">
                            <span class="material-symbols-outlined text-[20px] group-hover:scale-110 transition-transform">call</span>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-['Lexend'] font-bold text-gray-900 dark:text-white mb-6 uppercase text-sm tracking-wider">Eksplorasi</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('lapangan.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:translate-x-1 inline-block transition-transform">Cari Venues</a></li>
                        <li><a href="{{ route('booking.riwayat') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:translate-x-1 inline-block transition-transform">Riwayat Booking</a></li>
                        <li><a href="{{ route('support') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:translate-x-1 inline-block transition-transform">Pusat Bantuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-['Lexend'] font-bold text-gray-900 dark:text-white mb-6 uppercase text-sm tracking-wider">Legalitas</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:translate-x-1 inline-block transition-transform">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:translate-x-1 inline-block transition-transform">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:translate-x-1 inline-block transition-transform">Kemitraan</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="font-['Lexend'] text-xs uppercase tracking-widest text-gray-400 dark:text-gray-500">
                    © {{ date('Y') }} ArenaFlow. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center gap-2 bg-white dark:bg-gray-900 px-3 py-1.5 rounded-full border border-gray-100 dark:border-gray-800 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Sistem Normal</span>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('motion-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.motion-hidden').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
