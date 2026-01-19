<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-white tracking-tight">Admin Panel</h2>
                    <p class="text-gray-400 mt-1">Kelola data ruangan dan persetujuan peminjaman.</p>
                </div>
                <div class="text-xs text-gray-500 italic">Mode: Approval System</div>
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
                            <th class="px-6 py-5">Peminjam</th>
                            <th class="px-6 py-5">Ruangan & Waktu</th>
                            <th class="px-6 py-5">Keperluan</th>
                            <th class="px-6 py-5">Status</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($bookings as $booking)
                        <tr class="hover:bg-white/5 transition group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $booking->user->name }}</div>
                                <div class="text-[10px] text-gray-500">{{ $booking->user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-black font-bold">{{ $booking->room->nama_ruangan }}</div>
                                <div class="text-[10px] text-white/70">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</div>
                                <div class="text-[10px] text-gray-500 uppercase">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-xs text-gray-400 italic line-clamp-1 max-w-[150px]">"{{ $booking->keperluan }}"</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold border 
                                    {{ $booking->status == 'pending' ? 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' : '' }}
                                    {{ $booking->status == 'approved' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : '' }}
                                    {{ $booking->status == 'rejected' ? 'bg-rose-500/10 text-rose-400 border-rose-500/20' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($booking->status == 'pending')
                                <div class="flex justify-center gap-3">
                                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button class="bg-emerald-600 hover:bg-emerald-500 p-2 rounded-xl text-white transition shadow-lg shadow-emerald-900/40">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="bg-rose-600 hover:bg-rose-500 p-2 rounded-xl text-white transition shadow-lg shadow-rose-900/40">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                </div>
                                @else
                                    <div class="text-center text-[10px] text-gray-600 font-black tracking-tighter uppercase italic opacity-50">COMPLETED</div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>