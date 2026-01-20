<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Saintek Space - Booking Ruangan</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Custom Animation untuk Loader */
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="antialiased bg-black text-white min-h-screen overflow-x-hidden relative selection:bg-rose-500 selection:text-white">

        <div id="loader" class="fixed inset-0 z-[100] bg-black flex flex-col items-center justify-center transition-opacity duration-700 ease-out">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-600/20 rounded-full blur-[80px] animate-pulse"></div>
            
            <div class="relative flex flex-col items-center gap-6 animate-float">
                <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                    <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                
                <div class="text-center">
                    <h1 class="text-3xl font-bold tracking-tight text-white">Saintek<span class="text-gray-400">Space</span></h1>
                    <p class="text-indigo-400 text-sm mt-2 tracking-widest uppercase opacity-0 animate-[fadeIn_1s_ease-in_forwards]">Loading System...</p>
                </div>
            </div>
        </div>

        <div id="main-content" class="opacity-0 transition-opacity duration-1000">
            
            <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
                <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-900/40 rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-blob"></div>
                <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-rose-900/40 rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-blob animation-delay-2000"></div>
            </div>

            <div class="relative z-10 flex justify-between items-center p-6 md:px-12">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(255,255,255,0.3)]">
                        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight">Saintek<span class="text-gray-400">Space</span></span>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-300 hover:text-white transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hidden md:block font-medium text-gray-300 hover:text-white transition">Masuk</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-white text-black font-bold rounded-full hover:bg-gray-200 transition transform hover:scale-105 shadow-[0_0_20px_rgba(255,255,255,0.15)]">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

            <main class="relative z-10 flex flex-col items-center justify-center min-h-[80vh] px-4 text-center">
                
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-medium text-indigo-300 mb-6 backdrop-blur-md">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    Sistem Peminjaman Terintegrasi
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                    Kelola Ruangan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-200 to-gray-500">Tanpa Ribet.</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-400 max-w-2xl mb-10 leading-relaxed">
                    Platform peminjaman ruangan online untuk mahasiswa Teknologi Informasi. <br>
                </p>

                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <a href="{{ route('peminjaman') }}" class="px-8 py-4 bg-white text-black text-lg font-bold rounded-2xl hover:bg-gray-100 transition shadow-[0_0_30px_rgba(255,255,255,0.1)] flex items-center justify-center gap-2 group">
                        <span>Ajukan Peminjaman</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>

                    <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-white/5 text-white text-lg font-semibold rounded-2xl border border-white/10 hover:bg-white/10 transition flex items-center justify-center backdrop-blur-sm">
                        Lihat Ketersediaan
                    </a>
                </div>

                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 w-full max-w-4xl">
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 backdrop-blur-sm hover:bg-white/10 transition">
                        <div class="text-3xl font-bold text-white">{{ \App\Models\Room::count() }}</div>
                        <div class="text-sm text-gray-400">Ruangan</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 backdrop-blur-sm hover:bg-white/10 transition">
                        <div class="text-3xl font-bold text-white">24/7</div>
                        <div class="text-sm text-gray-400">Akses Online</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 backdrop-blur-sm hover:bg-white/10 transition">
                        <div class="text-3xl font-bold text-white"><></div>
                        <div class="text-sm text-gray-400">Approval Cepat</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/5 border border-white/5 backdrop-blur-sm hover:bg-white/10 transition">
                        <div class="text-3xl font-bold text-white">100+</div>
                        <div class="text-sm text-gray-400">Mahasiswa</div>
                    </div>
                </div>

            </main>

            <footer class="relative z-10 py-8 text-center text-sm text-gray-600 border-t border-white/5 mt-10">
                &copy; {{ date('Y') }} SaintekSpace. All rights reserved.
            </footer>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const loader = document.getElementById('loader');
                const content = document.getElementById('main-content');
                
                // Durasi loading dalam milidetik (contoh: 2000ms = 2 detik)
                const loadingDuration = 2000; 

                setTimeout(() => {
                    // 1. Hilangkan loader (fade out)
                    loader.classList.add('opacity-0', 'pointer-events-none');
                    
                    // 2. Tampilkan konten utama (fade in)
                    content.classList.remove('opacity-0');
                    
                    // 3. Hapus elemen loader dari HTML agar tidak menutupi element lain secara logis
                    setTimeout(() => {
                        loader.remove();
                    }, 1000); // Tunggu sampai transisi CSS (duration-700) selesai
                    
                }, loadingDuration);
            });
        </script>

    </body>
</html>