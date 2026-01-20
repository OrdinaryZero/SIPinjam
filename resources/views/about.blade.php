<x-app-layout>
    <div class="min-h-screen  text-white relative overflow-hidden font-sans">

        <div class="max-w-7xl mx-auto px-6 py-20 relative z-10">
            
            <div class="text-center mb-20">
                <div class="inline-block px-4 py-1.5 rounded-full border border-white/10 bg-white/5 text-[10px] font-bold uppercase tracking-[0.2em] text-cyan-400 backdrop-blur-md mb-6">
                    Project Info
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 bg-gradient-to-b from-white to-gray-400 bg-clip-text text-transparent">
                    SiPinjam V2.0
                </h1>
                <p class="max-w-2xl mx-auto text-gray-400 text-lg leading-relaxed font-medium opacity-80">
                    Solusi cerdas manajemen ruangan kampus berbasis visualisasi interaktif. Mempermudah birokrasi dan transparansi penggunaan fasilitas akademik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
                
                <div class="group bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-xl hover:border-cyan-500/50 transition-all duration-500 hover:-translate-y-2 shadow-2xl">
                    <div class="w-12 h-12 bg-cyan-500/20 rounded-2xl flex items-center justify-center text-cyan-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 tracking-tight">Visualisasi Presisi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-300 transition-colors">
                        Melihat posisi ruangan secara presisi melalui denah interaktif yang memudahkan navigasi di setiap lantai gedung.
                    </p>
                </div>

                <div class="group bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-xl hover:border-indigo-500/50 transition-all duration-500 hover:-translate-y-2 shadow-2xl">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-2xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 tracking-tight">Akses Real-Time</h3>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-300 transition-colors">
                        Sistem pemantauan status ruangan yang diperbarui setiap detik. Transparansi penuh untuk seluruh civitas akademika.
                    </p>
                </div>

                <div class="group bg-white/5 border border-white/10 p-8 rounded-3xl backdrop-blur-xl hover:border-emerald-500/50 transition-all duration-500 hover:-translate-y-2 shadow-2xl">
                    <div class="w-12 h-12 bg-emerald-500/20 rounded-2xl flex items-center justify-center text-emerald-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 tracking-tight">Quick Scan QR</h3>
                    <p class="text-gray-500 text-sm leading-relaxed group-hover:text-gray-300 transition-colors">
                        Teknologi peminjaman instan di lokasi. Cukup scan kode QR di pintu dan ruangan resmi terkunci untuk Anda.
                    </p>
                </div>

            </div>

            <div class="border-t border-white/5 pt-12 flex flex-col md:flex-row justify-between items-center gap-10">
                
                <div class="flex items-center gap-3 group">
                    <div class="text-white group-hover:text-cyan-400 transition-colors duration-300 drop-shadow-[0_0_8px_rgba(255,255,255,0.3)]">
                        <svg class="h-10 w-10" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-white uppercase">SiPinjam</span>
                </div>

                <div class="text-right">
                    <p class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.3em] mb-1">Developed By</p>
                    <p class="text-sm font-bold text-white tracking-widest uppercase">Feb - Project</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>