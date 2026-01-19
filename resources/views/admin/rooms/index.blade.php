<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-white tracking-tight">Admin Panel</h2>
                    <p class="text-gray-400 mt-1">Kelola data ruangan dan persetujuan peminjaman.</p>
                </div>
<a href="{{ route('admin.rooms.create') }}" 
   class="px-4 py-2 bg-white hover:bg-gray-100 text-black rounded-xl font-bold shadow-lg transition duration-200">
    + Tambah Ruangan
</a>
            </div>

            <div class="flex gap-2 mb-8 bg-white/5 p-1 rounded-2xl w-fit border border-white/10">
                <a href="{{ route('admin.rooms.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-bold transition {{ request()->routeIs('admin.rooms.*') ? 'bg-white/10 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                     Kelola Ruangan
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-bold transition flex items-center gap-2 {{ request()->routeIs('admin.bookings.*') ? 'bg-white/10 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                     Daftar Peminjaman
                    @php $pendingCount = \App\Models\Booking::where('status', 'pending')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="bg-rose-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>
            </div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-zinc-900 border border-white/10 p-6 rounded-2xl relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/5 rounded-full blur-2xl group-hover:bg-white/10 transition"></div>
        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500">Total Ruangan</p>
        <h3 class="text-3xl font-black text-white mt-1">{{ \App\Models\Room::count() }}</h3>
    </div>
    
    <div class="bg-zinc-900 border border-white/10 p-6 rounded-2xl relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition"></div>
        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500">Permohonan Aktif</p>
        <h3 class="text-3xl font-black text-white mt-1">{{ \App\Models\Booking::where('status', 'pending')->count() }}</h3>
    </div>

    <div class="bg-white p-6 rounded-2xl relative overflow-hidden group">
        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Ruangan Tersedia</p>
        <h3 class="text-3xl font-black text-black mt-1">{{ \App\Models\Room::where('status', 'tersedia')->count() }}</h3>
    </div>
</div>
            <div class="bg-zinc-900/60 border border-white/10 rounded-3xl overflow-hidden shadow-2xl backdrop-blur-md">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-white/5 uppercase text-[10px] font-black text-gray-500 tracking-widest">
                        <tr>
                            <th class="px-6 py-5">Foto</th>
                            <th class="px-6 py-5">Ruangan</th>
                            <th class="px-6 py-5">Kapasitas</th>
                            <th class="px-6 py-5">Status</th>
                            <th class="px-6 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($rooms as $room)
                        <tr class="hover:bg-white/5 transition group">
                            <td class="px-6 py-4">
                                @if($room->gambar)
                                    <img src="{{ asset('img/ruangan/'.$room->gambar) }}" class="w-14 h-14 object-cover rounded-xl border border-white/10 group-hover:border-indigo-500/50 transition">
                                @else
                                    <div class="w-14 h-14 bg-white/5 rounded-xl flex items-center justify-center text-[10px] text-gray-600 border border-dashed border-white/10">No Pic</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $room->nama_ruangan }}</div>
                                <div class="text-[10px] text-gray-500 uppercase">{{ $room->lokasi_lantai }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $room->kapasitas }} Orang</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold border 
                                    {{ $room->status == 'tersedia' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border-rose-500/20' }}">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3 text-xs font-bold">
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="text-indigo-400 hover:text-white transition">EDIT</a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Hapus ruangan ini?');">
                                        @csrf @method('DELETE')
                                        <button class="text-rose-500 hover:text-rose-300 transition uppercase">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>