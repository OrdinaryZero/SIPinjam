<x-app-layout>
    <div class="min-h-screen bg-black flex items-center justify-center p-4">
        
        <div class="w-full max-w-md bg-[#0f1014] border border-white/10 rounded-3xl p-8 relative overflow-hidden shadow-2xl">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/20 blur-[50px] rounded-full pointer-events-none"></div>

            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/5 border border-white/10 mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h2 class="text-2xl font-black text-white uppercase tracking-tight">Quick Book</h2>
                <p class="text-gray-400 text-sm mt-1">Anda berada di depan ruangan:</p>
                <div class="mt-2 inline-block px-4 py-1 rounded-lg bg-white text-black font-bold text-lg uppercase tracking-widest transform -rotate-2">
                    {{ $room->nama_ruangan }}
                </div>
            </div>

            <form action="{{ route('scan.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Mau pakai berapa lama?</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="1" class="peer sr-only" checked>
                            <div class="rounded-xl border border-white/10 bg-white/5 p-4 text-center peer-checked:bg-cyan-500 peer-checked:text-black peer-checked:border-cyan-400 transition-all hover:bg-white/10">
                                <span class="block text-xl font-bold">1</span>
                                <span class="text-[10px] uppercase font-bold">Jam</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="2" class="peer sr-only">
                            <div class="rounded-xl border border-white/10 bg-white/5 p-4 text-center peer-checked:bg-cyan-500 peer-checked:text-black peer-checked:border-cyan-400 transition-all hover:bg-white/10">
                                <span class="block text-xl font-bold">2</span>
                                <span class="text-[10px] uppercase font-bold">Jam</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="duration" value="3" class="peer sr-only">
                            <div class="rounded-xl border border-white/10 bg-white/5 p-4 text-center peer-checked:bg-cyan-500 peer-checked:text-black peer-checked:border-cyan-400 transition-all hover:bg-white/10">
                                <span class="block text-xl font-bold">3</span>
                                <span class="text-[10px] uppercase font-bold">Jam</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Untuk Keperluan?</label>
                    <input type="text" name="keperluan" required placeholder="Contoh: Meeting Dadakan..." 
                           class="w-full bg-black border border-white/20 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all placeholder-gray-600">
                </div>

                <button type="submit" class="w-full py-4 bg-white text-black font-black uppercase tracking-[0.2em] rounded-xl hover:bg-cyan-400 hover:scale-[1.02] transition-all shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                    Kunci Ruangan Ini
                </button>
                
                <p class="text-[10px] text-center text-gray-600 mt-4">
                    *Status ruangan akan otomatis berubah menjadi "Penuh" setelah Anda menekan tombol.
                </p>
            </form>

        </div>
    </div>
</x-app-layout>