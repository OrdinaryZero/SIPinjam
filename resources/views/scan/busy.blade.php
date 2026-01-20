<x-app-layout>
    <div class="min-h-screen bg-black flex items-center justify-center p-4">
        
        <div class="w-full max-w-md bg-[#0f1014] border border-rose-500/30 rounded-3xl p-8 text-center relative overflow-hidden shadow-2xl">
            
            <div class="absolute top-[-50%] left-1/2 -translate-x-1/2 w-64 h-64 bg-rose-600/20 blur-[80px] rounded-full pointer-events-none"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-500 mb-6 animate-pulse">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                
                <h2 class="text-3xl font-black text-white mb-2 uppercase tracking-tight">Ruangan Penuh!</h2>
                
                <div class="bg-rose-900/20 border border-rose-500/20 rounded-xl p-4 mb-8">
                    <p class="text-rose-200 text-sm leading-relaxed">
                        Maaf, Ruangan <span class="font-bold text-white border-b border-rose-500/50 uppercase">{{ $room->nama_ruangan }}</span> sedang digunakan saat ini.
                    </p>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('dashboard') }}" class="block w-full py-4 bg-white text-black font-black uppercase tracking-widest rounded-xl hover:bg-gray-200 transition-all shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                        Cari Ruangan Lain
                    </a>
                    <a href="{{ url('/') }}" class="block w-full py-4 bg-transparent border border-white/10 text-gray-400 font-bold uppercase tracking-widest rounded-xl hover:text-white hover:border-white transition-all">
                        Kembali ke Home
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>