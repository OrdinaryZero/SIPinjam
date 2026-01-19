<x-app-layout>
    <div class="min-h-screen bg-black py-12 relative overflow-hidden">
        
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-red-900/20 rounded-full mix-blend-screen filter blur-[100px] opacity-40 animate-blob"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="mb-10 flex justify-between items-end">
                <div>
                    <h2 class="font-bold text-3xl text-white tracking-tight">Admin Control Room</h2>
                    <p class="text-gray-400 mt-2">Kelola semua permohonan masuk.</p>
                </div>
            </div>

            <div class="bg-zinc-900/60 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 border-b border-white/10 text-gray-400 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Pemohon</th>
                                <th class="px-6 py-4">Ruangan</th>
                                <th class="px-6 py-4">Waktu</th>
                                <th class="px-6 py-4">Keperluan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-300 text-sm">
                            @foreach($bookings as $booking)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4 font-bold text-white">{{ $booking->user->name }}</td>
                                <td class="px-6 py-4">
                                    {{ $booking->room->nama_ruangan }}
                                    <span class="block text-xs text-gray-500">{{ $booking->room->lokasi_lantai }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->tanggal }}
                                    <span class="block text-xs text-indigo-400">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">{{ $booking->keperluan }}</td>
                                <td class="px-6 py-4">
                                    @if($booking->status == 'pending')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-900/40 text-amber-400 border border-amber-500/20">PENDING</span>
                                    @elseif($booking->status == 'approved')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-900/40 text-emerald-400 border border-emerald-500/20">APPROVED</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-900/40 text-rose-400 border border-rose-500/20">REJECTED</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('admin.update', $booking->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="p-2 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-white shadow-lg shadow-emerald-900/20 transition transform hover:scale-110">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.update', $booking->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="p-2 bg-rose-600 hover:bg-rose-500 rounded-lg text-white shadow-lg shadow-rose-900/20 transition transform hover:scale-110">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-600 italic">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>