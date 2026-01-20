<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SiPinjam') }}</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-black text-white selection:bg-cyan-500 selection:text-black">

        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-teal-900/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[800px] h-[800px] bg-blue-900/10 rounded-full blur-[120px]"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-[0.07]"></div>
        </div>

        @include('layouts.navigation')

        <section class="relative pt-32 pb-20 sm:pt-40 sm:pb-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 backdrop-blur-md mb-8 hover:bg-white/10 transition cursor-default">
                    <span class="flex h-1.5 w-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-cyan-300 tracking-wider uppercase">SiPinjam 2.0</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                    Booking Ruangan <br class="hidden md:block" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-b from-white to-white/40">
                        Tanpa Ribet.
                    </span>
                </h1>

                <p class="mt-4 text-base md:text-lg text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                    Sistem terintegrasi UIN Antasari. Cek ketersediaan ruangan secara real-time, ajukan peminjaman, dan pantau statusnya dari mana saja.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <a href="{{ route('dashboard') }}" class="group relative px-8 py-3 rounded-full bg-white text-black font-bold text-xs hover:scale-105 transition-all shadow-[0_0_30px_rgba(255,255,255,0.2)] overflow-hidden">
                        <span class="relative z-10">Mulai Sekarang</span>
                        <div class="absolute inset-0 bg-cyan-400 opacity-0 group-hover:opacity-20 transition-opacity"></div>
                    </a>

                    <a href="{{ route('dashboard') }}" class="px-8 py-3 rounded-full border border-white/20 text-white font-medium text-xs hover:bg-white/5 hover:border-white/40 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Lihat Denah 3D
                    </a>
                </div>

                <div class="relative max-w-5xl mx-auto mt-8 perspective-1000 group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-1000"></div>
                    <div class="relative rounded-xl bg-[#0f1014] border border-white/10 shadow-2xl overflow-hidden transform rotate-x-6 group-hover:rotate-x-0 transition-all duration-700 ease-out">
                        <div class="h-8 bg-white/5 border-b border-white/5 flex items-center px-4 gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-500/20"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/20"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-green-500/20"></div>
                        </div>
<div class="aspect-[16/9] bg-[#0a0a0a] relative overflow-hidden group">
    <img src="{{ asset('img/dashboard-preview.jpg') }}" 
         alt="SiPinjam Dashboard Preview" 
         class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-700 ease-in-out">

    <div class="absolute inset-0 bg-[url('https://play.tailwindcss.com/img/grid.svg')] opacity-[0.1] pointer-events-none"></div>

    <div class="absolute bottom-4 left-4 flex items-center gap-2 px-3 py-1.5 bg-black/60 backdrop-blur-md border border-white/10 rounded-full">
        <div class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse shadow-[0_0_8px_rgba(34,211,238,0.8)]"></div>
        <span class="text-[9px] font-bold text-white uppercase tracking-widest"> Preview</span>
    </div>
</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-y border-white/5 bg-white/[0.02]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold text-white mb-1">24+</div>
                        <div class="text-xs text-gray-500 uppercase tracking-widest">Ruangan</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white mb-1">500+</div>
                        <div class="text-xs text-gray-500 uppercase tracking-widest">Mahasiswa</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white mb-1">100%</div>
                        <div class="text-xs text-gray-500 uppercase tracking-widest">Real-time</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white mb-1">24/7</div>
                        <div class="text-xs text-gray-500 uppercase tracking-widest">Akses</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-white mb-4">Kenapa Pakai SiPinjam?</h2>
                    <p class="text-gray-400 max-w-2xl mx-auto">Kami mendesain ulang pengalaman peminjaman ruangan agar lebih cepat, transparan, dan efisien.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-cyan-500/50 hover:bg-white/[0.07] transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-lg bg-cyan-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Cek Jadwal Real-time</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">Tidak perlu lagi datang ke kampus untuk cek ruangan kosong. Lihat jadwal langsung dari HP.</p>
                    </div>

                    <div class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-blue-500/50 hover:bg-white/[0.07] transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Denah Interaktif 3D</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">Bingung lokasi ruangan? Gunakan fitur denah 3D kami untuk navigasi visual yang jelas.</p>
                    </div>

                    <div class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-purple-500/50 hover:bg-white/[0.07] transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-lg bg-purple-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Approval Cepat</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">Sistem notifikasi otomatis mempercepat proses persetujuan peminjaman ruangan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 border-t border-white/5 relative bg-black">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-12">
                    <div class="md:w-1/2">
                        <h2 class="text-3xl font-bold text-white mb-6">Cara Mudah Meminjam</h2>
                        <div class="space-y-8">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-cyan-900/50 text-cyan-400 flex items-center justify-center font-bold text-sm border border-cyan-500/30">1</div>
                                <div>
                                    <h4 class="text-white font-bold mb-1">Pilih Ruangan</h4>
                                    <p class="text-sm text-gray-400">Jelajahi daftar ruangan dan cek fasilitas yang tersedia.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-cyan-900/50 text-cyan-400 flex items-center justify-center font-bold text-sm border border-cyan-500/30">2</div>
                                <div>
                                    <h4 class="text-white font-bold mb-1">Isi Formulir</h4>
                                    <p class="text-sm text-gray-400">Lengkapi data kegiatan dan waktu peminjaman.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-cyan-900/50 text-cyan-400 flex items-center justify-center font-bold text-sm border border-cyan-500/30">3</div>
                                <div>
                                    <h4 class="text-white font-bold mb-1">Tunggu Persetujuan</h4>
                                    <p class="text-sm text-gray-400">Admin akan memverifikasi. Tiket akan muncul di dashboard.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-1/2 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-blue-600/20 blur-3xl rounded-full"></div>
                        <div class="relative p-6 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                            <div class="space-y-3">
                                <div class="h-2 w-1/3 bg-white/20 rounded"></div>
                                <div class="h-2 w-2/3 bg-white/10 rounded"></div>
                                <div class="h-24 w-full bg-white/5 rounded border border-white/5 mt-4"></div>
                                <div class="flex justify-end mt-4">
                                    <div class="h-8 w-24 bg-cyan-500/80 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="border-t border-white/10 bg-[#050505] pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                    <div class="col-span-2 md:col-span-1">
                        <a href="/" class="flex items-center gap-2 mb-4">
                            <div class="text-white">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
                            </div>
                            <span class="font-bold text-lg text-white">SiPinjam</span>
                        </a>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-xs">
                            Sistem Informasi Peminjaman Ruangan Gedung Saintek UIN Antasari Banjarmasin.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4">Menu</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('dashboard') }}" class="text-xs text-gray-500 hover:text-cyan-400 transition">Dashboard</a></li>
                            <li><a href="/" class="text-xs text-gray-500 hover:text-cyan-400 transition">Denah</a></li>
                            <li><a href="{{ route('peminjaman') }}" class="text-xs text-gray-500 hover:text-cyan-400 transition">Cek Jadwal</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4">Bantuan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-xs text-gray-500 hover:text-cyan-400 transition">Panduan</a></li>
                            <li><a href="#" class="text-xs text-gray-500 hover:text-cyan-400 transition">Kontak Admin</a></li>
                            <li><a href="#" class="text-xs text-gray-500 hover:text-cyan-400 transition">Laporkan Bug</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold text-xs uppercase tracking-widest mb-4">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-xs text-gray-500 hover:text-cyan-400 transition">Privacy Policy</a></li>
                            <li><a href="#" class="text-xs text-gray-500 hover:text-cyan-400 transition">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-[10px] text-gray-600">
                        &copy; 2026 UIN Antasari Banjarmasin. All rights reserved.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-600 hover:text-white transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="text-gray-600 hover:text-white transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.072 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>