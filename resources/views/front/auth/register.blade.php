<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar | ArenaFlow</title>
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
        h1, h2, h3 { font-family: 'Lexend', sans-serif; }

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
<body class="bg-background text-on-background min-h-screen flex flex-col">
    <!-- Content Canvas -->
    <main class="flex-grow flex items-center justify-center p-6 md:p-12 lg:p-16">
        <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Side: Visual/Brand Messaging (Visible on Desktop) -->
            <div class="hidden lg:flex flex-col space-y-8 animate-fade-up">
                <div class="space-y-4">
                    <span class="text-primary font-black text-4xl uppercase tracking-tighter">ArenaFlow</span>
                    <h1 class="text-5xl font-bold leading-tight text-on-surface">
                        Ubah cara Anda <br/>
                        <span class="text-primary">Berolahraga.</span>
                    </h1>
                    <p class="text-on-surface-variant text-lg max-w-md">
                        Akses instan ke ribuan lapangan berkualitas di seluruh kota. Bergabunglah hari ini dan rasakan kemudahan reservasi tanpa batas.
                    </p>
                </div>
                
                <div class="relative w-full aspect-[4/3] rounded-xl overflow-hidden shadow-2xl">
                    <img class="w-full h-full object-cover" data-alt="A cinematic, high-action shot of an outdoor tennis court" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCA_5yXJZU92EIJSJo8ovuYzgofM99b11BRfgz_KTTs3ht-fvKXRp6QInL6NaHpL2jM5PJ4qCQpviB7kv_TY2ammmp8ywsoer06IIM5ot-nv5QVblPvibMjRacXOZ8TutBJQCEiUjCNOt4ptPfwIR7WYsABR4KkyAl2JwnGYmhsM9HPJyQqh0goAb7ZXAaKh6u9WUhhWFSJqKW5fI2W7sIllLL-N5Mf4DZ5Ac2hwyulihltncevppmeo0jIobNMZR9_N2BtR_SOEu0"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                        <div class="text-white">
                            <p class="font-headline font-bold text-xl">Gelanggang Olahraga Nasional</p>
                            <p class="text-white/80">Jakarta Pusat • Tersedia Hari Ini</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Registration Form -->
            <div class="bg-surface-container-lowest p-8 md:p-10 rounded-xl shadow-sm border border-outline-variant w-full max-w-md mx-auto animate-fade-up delay-100">
                <div class="flex flex-col space-y-6">
                    <!-- Brand (Mobile only) -->
                    <div class="lg:hidden">
                        <span class="text-primary font-black text-2xl uppercase tracking-tighter">ArenaFlow</span>
                    </div>
                    
                    <!-- Header -->
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tight text-on-surface">Buat Akun Baru</h2>
                        <p class="text-on-surface-variant">Gabung dengan komunitas olahraga terbesar.</p>
                    </div>
                    
                    <!-- Registration Mode Toggle -->
                    <div class="bg-surface-container-low p-1 rounded-lg flex items-center">
                        <button class="flex-1 py-2 text-sm font-semibold rounded-md bg-white text-primary shadow-sm border border-outline-variant/20">
                            Daftar dengan Email
                        </button>
                        <button class="flex-1 py-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors">
                            Daftar dengan WhatsApp
                        </button>
                    </div>
                    
                    <!-- Form Content (Email Flow) -->
                    <form class="space-y-4" action="#" method="POST">
                        @csrf
                        <div class="space-y-1">
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1">Nama Lengkap</label>
                            <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" name="name" placeholder="Masukkan nama lengkap" type="text" required/>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1">Email</label>
                            <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" name="email" placeholder="contoh@email.com" type="email" required/>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1">Kata Sandi</label>
                                <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" name="password" placeholder="••••••••" type="password" required/>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant ml-1">Konfirmasi</label>
                                <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" name="password_confirmation" placeholder="••••••••" type="password" required/>
                            </div>
                        </div>
                        
                        <!-- Agreement Checkbox -->
                        <div class="flex items-start space-x-3 pt-2">
                            <input class="mt-1 h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary" id="terms" type="checkbox" required/>
                            <label class="text-sm text-on-surface-variant leading-relaxed" for="terms">
                                Saya setuju dengan <span class="text-primary font-semibold cursor-pointer">Syarat &amp; Ketentuan</span> serta <span class="text-primary font-semibold cursor-pointer">Kebijakan Privasi</span> ArenaFlow.
                            </label>
                        </div>
                        
                        <!-- CTA Button -->
                        <button class="w-full bg-primary text-on-primary py-4 rounded-lg font-bold text-lg hover:bg-primary-container active:scale-[0.98] transition-all shadow-md shadow-primary/20" type="submit">
                            Daftar
                        </button>
                    </form>
                    
                    <!-- Divider -->
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline-variant"></div></div>
                        <div class="relative flex justify-center text-xs uppercase tracking-widest"><span class="bg-surface-container-lowest px-2 text-on-surface-variant">Atau daftar dengan</span></div>
                    </div>
                    
                    <!-- Social Login -->
                    <button class="w-full flex items-center justify-center space-x-3 py-3 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors">
                        <svg class="w-5 h-5" viewbox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                        </svg>
                        <span class="font-semibold text-on-surface">Google</span>
                    </button>
                    
                    <!-- Login Link -->
                    <p class="text-center text-on-surface-variant">
                        Sudah punya akun? 
                        <a class="text-primary font-bold hover:underline" href="{{ route('front.login') }}">Masuk</a>
                    </p>
                    <a href="{{ route('home') }}" class="text-center flex justify-center items-center gap-2 text-primary text-sm hover:underline">
                        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
