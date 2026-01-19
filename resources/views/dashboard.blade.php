<x-app-layout>
    <div class="py-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-900/20 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white mb-2">Daftar Ruangan</h2>
            <p class="text-gray-400 mb-8">Fasilitas UIN Antasari Banjarmasin yang bisa kamu pinjam.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                <div class="bg-zinc-900/60 border border-white/10 rounded-2xl overflow-hidden hover:scale-[1.02] transition duration-300 shadow-xl group">
                    
                    <div class="h-56 bg-gradient-to-br from-gray-800 to-black flex items-center justify-center relative overflow-hidden">
                        @if($room->gambar)
                            <img src="{{ asset('img/ruangan/' . $room->gambar) }}" 
                                 alt="{{ $room->nama_ruangan }}" 
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @else
                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @endif
                        
                        <div class="absolute top-3 right-3 flex flex-col items-end gap-2">
                            <div class="bg-black/50 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider text-white border border-white/10">
                                {{ $room->lokasi_lantai }}
                            </div>
                            <div class="px-2 py-0.5 rounded-md text-[10px] font-extrabold uppercase {{ $room->status == 'tersedia' ? 'bg-emerald-500/80 text-white' : 'bg-rose-500/80 text-white' }}">
                                {{ $room->status }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-white group-hover:text-white transition">{{ $room->nama_ruangan }}</h3>
                        <p class="text-sm text-gray-400 mt-2 line-clamp-2 h-10">{{ $room->fasilitas }}</p>
                        
                        <div class="mt-4 flex justify-between items-center border-t border-white/5 pt-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span class="text-xs text-gray-500">{{ $room->kapasitas }} Kapasitas</span>
                            </div>
                            <a href="{{ route('peminjaman') }}" class="px-4 py-1.5 bg-white/10/20 hover:bg-white/10 text-black hover:text-white border border-indigo-500/30 rounded-lg text-xs font-bold transition duration-300">
                                Pinjam &rarr;
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>