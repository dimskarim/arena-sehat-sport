<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'ArenaFlow - High-Performance Sports Booking')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-high": "#eae7e7",
                        "primary-container": "#d32f2f",
                        "secondary-fixed-dim": "#ebbabf",
                        "on-background": "#1b1c1c",
                        "inverse-primary": "#ffb3ac",
                        "secondary-fixed": "#ffd9dd",
                        "inverse-surface": "#303030",
                        "surface-dim": "#dcd9d9",
                        "secondary": "#7a5459",
                        "background": "#fcf9f8",
                        "tertiary": "#005f7b",
                        "on-tertiary-container": "#e9f7ff",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed": "#2f1317",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#004d65",
                        "surface-container-low": "#f6f3f2",
                        "tertiary-fixed": "#bee9ff",
                        "secondary-container": "#fdcbd0",
                        "on-error-container": "#93000a",
                        "surface-container": "#f0eded",
                        "on-primary-fixed-variant": "#930010",
                        "on-primary-fixed": "#410003",
                        "tertiary-fixed-dim": "#7bd1f8",
                        "outline": "#8f6f6c",
                        "error-container": "#ffdad6",
                        "inverse-on-surface": "#f3f0ef",
                        "surface": "#fcf9f8",
                        "outline-variant": "#e4beba",
                        "surface-bright": "#fcf9f8",
                        "on-tertiary": "#ffffff",
                        "on-primary-container": "#fff2f0",
                        "surface-variant": "#e5e2e1",
                        "surface-tint": "#ba1a20",
                        "surface-container-highest": "#e5e2e1",
                        "on-surface": "#1b1c1c",
                        "primary": "#af101a",
                        "on-surface-variant": "#5b403d",
                        "primary-fixed-dim": "#ffb3ac",
                        "on-secondary-fixed-variant": "#603d42",
                        "on-tertiary-fixed": "#001f2a",
                        "primary-fixed": "#ffdad6",
                        "surface-container-lowest": "#ffffff",
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3 {
            font-family: 'Lexend', sans-serif;
        }

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
    @stack('styles')
</head>

<body class="bg-surface font-body-md text-on-surface">
    <!-- TopAppBar -->
    <header class="fixed top-0 w-full z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 shadow-[0_4px_20px_rgba(211,47,47,0.08)]">
        <nav class="flex items-center justify-between px-6 h-16 w-full max-w-7xl mx-auto font-['Lexend'] antialiased">
            <a href="{{ route('home') }}" class="text-2xl font-black text-red-700 dark:text-red-500 tracking-tighter">ArenaFlow</a>
            <div class="hidden md:flex items-center gap-8">
                <a class="text-gray-600 dark:text-gray-400 font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('home') }}">Homes</a>
                <a class="text-gray-600 dark:text-gray-400 font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('lapangan.index') }}">Venues</a>
                <a class="text-gray-600 dark:text-gray-400 font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('booking.riwayat') }}">My Bookings</a>
                <a class="text-gray-600 dark:text-gray-400 font-medium hover:text-red-600 dark:hover:text-red-400 transition-all" href="{{ route('support') }}">Support</a>
            </div>
            <div class="flex items-center gap-4">
                <button class="material-symbols-outlined text-gray-600 dark:text-gray-400 hover:text-red-600 transition-all">search</button>
                <a href="{{ route('front.login') }}" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md transition-transform active:scale-95 hover:opacity-90">Sign In</a>
            </div>
        </nav>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-950 w-full py-12 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-lg font-bold text-gray-900 dark:text-white">ArenaFlow</div>
            <div class="flex flex-wrap justify-center gap-8 font-['Lexend'] text-xs uppercase tracking-widest">
                <a class="text-gray-500 dark:text-gray-400 hover:text-red-600 underline decoration-2 underline-offset-4 transition-opacity" href="#">Privacy</a>
                <a class="text-gray-500 dark:text-gray-400 hover:text-red-600 underline decoration-2 underline-offset-4 transition-opacity" href="#">Terms</a>
                <a class="text-gray-500 dark:text-gray-400 hover:text-red-600 underline decoration-2 underline-offset-4 transition-opacity" href="#">Partner with Us</a>
                <a class="text-gray-500 dark:text-gray-400 hover:text-red-600 underline decoration-2 underline-offset-4 transition-opacity" href="#">Contact</a>
            </div>
            <p class="font-['Lexend'] text-xs uppercase tracking-widest text-gray-400">© 2024 ArenaFlow High-Performance Booking.</p>
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