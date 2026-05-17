<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk - ArenaFlow</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#af101a",
                        "primary-fixed": "#ffdad6",
                        "on-primary": "#ffffff",
                        "on-error": "#ffffff",
                        "outline": "#8f6f6c",
                        "on-secondary-container": "#795358",
                        "secondary": "#7a5459",
                        "on-primary-container": "#fff2f0",
                        "surface-container-highest": "#e5e2e1",
                        "surface": "#fcf9f8",
                        "error-container": "#ffdad6",
                        "outline-variant": "#e4beba",
                        "on-secondary-fixed": "#2f1317",
                        "on-background": "#1b1c1c",
                        "primary-container": "#d32f2f",
                        "on-tertiary-container": "#e9f7ff",
                        "on-surface-variant": "#5b403d",
                        "surface-container-lowest": "#ffffff",
                        "inverse-surface": "#303030",
                        "tertiary-fixed-dim": "#7bd1f8",
                        "secondary-container": "#fdcbd0",
                        "inverse-on-surface": "#f3f0ef",
                        "surface-container": "#f0eded",
                        "surface-container-high": "#eae7e7",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#930010",
                        "tertiary": "#005f7b",
                        "surface-bright": "#fcf9f8",
                        "on-surface": "#1b1c1c",
                        "on-secondary-fixed-variant": "#603d42",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed-variant": "#004d65",
                        "on-primary-fixed": "#410003",
                        "secondary-fixed": "#ffd9dd",
                        "inverse-primary": "#ffb3ac",
                        "background": "#fcf9f8",
                        "tertiary-fixed": "#bee9ff",
                        "surface-dim": "#dcd9d9",
                        "on-secondary": "#ffffff",
                        "surface-container-low": "#f6f3f2",
                        "tertiary-container": "#00799c",
                        "on-tertiary-fixed": "#001f2a",
                        "surface-tint": "#ba1a20",
                        "secondary-fixed-dim": "#ebbabf",
                        "primary-fixed-dim": "#ffb3ac",
                        "surface-variant": "#e5e2e1",
                        "error": "#ba1a1a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Lexend"],
                        "display": ["Lexend"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .brand-font { font-family: 'Lexend', sans-serif; }

        /* Animation Styles */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col items-center justify-center relative overflow-x-hidden">
    <!-- Subtle Background Accents -->
    <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-primary-fixed opacity-20 blur-[120px] -z-10 rounded-full"></div>
    <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-secondary-container opacity-30 blur-[100px] -z-10 rounded-full"></div>
    
    <!-- Main Container -->
    <main class="w-full max-w-md px-6 py-12 md:py-24">
        <!-- Header / Logo -->
        <div class="text-center mb-10 animate-fade-up">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-xl mb-6 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-on-primary text-4xl" style="font-variation-settings: 'FILL' 1;">sports_tennis</span>
            </div>
            <h2 class="text-[#af101a] text-2xl font-black uppercase tracking-tighter mb-8 brand-font">ArenaFlow</h2>
            <h1 class="text-3xl font-bold tracking-tight text-on-surface mb-2 font-headline">Selamat Datang Kembali</h1>
            <p class="text-on-surface-variant font-body">Masuk ke akun Anda untuk mulai booking lapangan.</p>
        </div>
        
        <!-- Social Login -->
        <button class="w-full flex items-center justify-center gap-3 bg-surface-container-lowest border border-outline-variant hover:bg-surface-container-low transition-colors py-3.5 px-4 rounded-lg shadow-sm group active:scale-95 transition-transform duration-150 animate-fade-up delay-100">
            <svg class="w-5 h-5" fill="none" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.766 12.2764C23.766 11.4607 23.6999 10.6406 23.5588 9.83807H12.24V14.4591H18.7217C18.4528 15.9494 17.5885 17.2678 16.323 18.1056V21.1039H20.19C22.4608 19.0139 23.766 15.9274 23.766 12.2764Z" fill="#4285F4"></path>
                <path d="M12.2401 24.0008C15.4766 24.0008 18.2059 22.9382 20.1945 21.1039L16.3275 18.1055C15.2517 18.8375 13.8627 19.252 12.2445 19.252C9.11388 19.252 6.45946 17.1399 5.50705 14.3003H1.5166V17.3912C3.55371 21.4434 7.7029 24.0008 12.2401 24.0008Z" fill="#34A853"></path>
                <path d="M5.50253 14.3003C5.25363 13.5545 5.12124 12.7665 5.12124 11.961C5.12124 11.1555 5.25363 10.3675 5.50253 9.62175V6.53088H1.51208C0.666113 8.21251 0.1875 10.0357 0.1875 11.961C0.1875 13.8863 0.666113 15.7095 1.51208 17.3911L5.50253 14.3003Z" fill="#FBBC05"></path>
                <path d="M12.2401 4.75C14.0003 4.75 15.5761 5.35332 16.8197 6.55184L20.2739 3.09758C18.197 1.17695 15.4678 0 12.2401 0C7.7029 0 3.55371 2.55742 1.5166 6.60957L5.50705 9.70043C6.45946 6.86082 9.11388 4.75 12.2401 4.75Z" fill="#EA4335"></path>
            </svg>
            <span class="text-on-surface font-semibold text-sm">Masuk dengan Google</span>
        </button>
        
        <!-- Divider -->
        <div class="flex items-center my-8 animate-fade-up delay-200">
            <div class="flex-grow border-t border-surface-container-highest"></div>
            <span class="px-4 text-xs font-medium text-on-surface-variant uppercase tracking-widest bg-background">atau masuk dengan email</span>
            <div class="flex-grow border-t border-surface-container-highest"></div>
        </div>
        
        <!-- Form Fields -->
        <form class="space-y-5 animate-fade-up delay-300" action="#" method="POST">
            @csrf
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase" for="email">Email</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors text-xl">mail</span>
                    <input class="w-full bg-white border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg py-3 pl-11 pr-4 text-sm transition-all outline-none" id="email" name="email" placeholder="nama@email.com" required type="email"/>
                </div>
            </div>
            
            <div class="space-y-1.5">
                <div class="flex justify-between items-center px-1">
                    <label class="text-xs font-bold text-on-surface-variant uppercase" for="password">Password</label>
                    <a class="text-xs font-bold text-primary hover:underline transition-all" href="#">Lupa Password?</a>
                </div>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors text-xl">lock</span>
                    <input class="w-full bg-white border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg py-3 pl-11 pr-4 text-sm transition-all outline-none" id="password" name="password" placeholder="••••••••" required type="password"/>
                </div>
            </div>
            
            <!-- Primary CTA -->
            <button class="w-full bg-primary hover:bg-primary-container text-on-primary font-bold py-4 rounded-lg shadow-lg shadow-primary/10 active:scale-95 transition-all duration-150 mt-4 font-headline uppercase tracking-wide" type="submit">
                Masuk
            </button>
        </form>
        
        <!-- Secondary Option -->
        <p class="text-center mt-8 text-sm text-on-surface-variant font-body animate-fade-up delay-400">
            Belum punya akun? <a class="text-primary font-bold hover:underline transition-all" href="{{ route('front.register') }}">Daftar sekarang</a>
        </p>
        
        <!-- Footer / OTP Option -->
        <div class="mt-12 pt-8 border-t border-surface-container-highest flex flex-col items-center">
            <p class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest mb-4">Butuh cara lain?</p>
            <button class="flex items-center gap-2 px-6 py-2 rounded-full border border-secondary text-secondary hover:bg-secondary-fixed transition-colors active:scale-95">
                <span class="material-symbols-outlined text-lg">chat</span>
                <span class="text-xs font-bold uppercase tracking-tight">Masuk via WhatsApp OTP</span>
            </button>
            <a href="{{ route('home') }}" class="mt-4 flex items-center gap-2 text-primary text-sm hover:underline">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Beranda
            </a>
        </div>
    </main>
    
    <!-- Side Decoration (Hidden on small screens) -->
    <div class="hidden lg:flex fixed left-0 top-0 bottom-0 w-1/4 items-center justify-center p-12 pointer-events-none opacity-20">
        <img class="w-full h-auto object-contain transform -rotate-12" data-alt="A stylized abstract digital artwork of a tennis court" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyh7bkwSNNlQeH6IB2foG21RxQRr4f9GsI0twt4GyucEoQJQo6wclqPoV9gsG-2HlLdOpjEb2HXnBi8_SOiDHxu4f2-6n0uYmPCGrpoGXvoMYZsSyYHeNu9e_3lJteUQ657J0yS_xxqNPEPvDfC765kSDjPGeUAymIYJDlUatpCQcTdyrHk3WAtHQV4zC76CPHtMb3CB17n6BzFM_7kWPkXZUcrawx7GV5I0mxl1qtaO6eSBRAO3rkBQk388Z8ZdpnK6uZXELz4nA"/>
    </div>
    <div class="hidden lg:flex fixed right-0 top-0 bottom-0 w-1/4 items-center justify-center p-12 pointer-events-none opacity-20">
        <img class="w-full h-auto object-contain transform rotate-12" data-alt="An artistic digital rendering of a basketball hoop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMO2bDj4HqmreiWKcg7rh6AEAx3l5hr4I2xuV4sQQBeKSqDggMcKoDGKLyJ7f4wHvuCBWldEV-9X5zdQ1-HOFwg43VMD8ohNY4eND-wR9X4KZmsARK4G718Upe5PvUnbGJHmFxBa2iVMWa0DlzUtqJo1R7QY0HMOc2y-CCrepBZVfoK-QshXttzO7i1OdWX8ziwQdChUGFPI8QF4sQyQengYZRI0gIXXYM4OofJIoq8VdFzmnYfxs4KaW2qKdau5OWm9cIHyoOAFc"/>
    </div>
</body>
</html>
