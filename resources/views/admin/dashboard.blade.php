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
                    <table class="w-full">
    <thead>
        <tr>
            <th class="px-6 py-4">Ruangan</th>
            <th class="px-6 py-4">Status & Sisa Waktu</th> <th class="px-6 py-4 text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
        <tr>
            <td class="px-6 py-4 font-bold">{{ $room->nama_ruangan }}</td>
            <td class="px-6 py-4">
                @php
                    // Ambil data booking yang sedang jalan di ruangan ini
                    $active = $room->bookings->first();
                    $isOccupied = (strtolower($room->status) != 'tersedia' && $active);
                @endphp

                @if($isOccupied)
                    <div class="flex flex-col">
                        <span class="text-rose-500 font-bold uppercase text-[10px]">● Sedang Dipakai</span>
                        <span class="text-yellow-400 font-mono font-bold text-lg" 
                              id="admin-timer-{{ $room->id }}" 
                              data-end="{{ \Carbon\Carbon::parse($active->tanggal . ' ' . $active->jam_selesai)->timestamp * 1000 }}">
                            00:00:00
                        </span>
                    </div>
                @else
                    <span class="text-emerald-500 font-bold uppercase text-[10px]">● Tersedia</span>
                @endif
            </td>
            <td class="px-6 py-4 text-right">
                @if($isOccupied)
                    <form action="{{ route('admin.rooms.reset', $room->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-rose-600 px-3 py-1 rounded text-[10px] font-bold text-white hover:bg-rose-700 transition">
                            STOP PAKSA
                        </button>
                    </form>
                @endif
                <a href="{{ route('rooms.edit', $room->id) }}" class="text-cyan-400 text-xs ml-2">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>

<script>
    function startAdminTimers() {
        setInterval(() => {
            // Cari semua element yang ada ID admin-timer-
            document.querySelectorAll('[id^="admin-timer-"]').forEach(timer => {
                const endTime = parseInt(timer.getAttribute('data-end'));
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance < 0) {
                    timer.innerHTML = "WAKTU HABIS";
                    timer.classList.remove('text-yellow-400');
                    timer.classList.add('text-gray-500');
                } else {
                    const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const s = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    // Format biar jadi 00:00:00
                    timer.innerHTML = 
                        (h < 10 ? "0" + h : h) + ":" + 
                        (m < 10 ? "0" + m : m) + ":" + 
                        (s < 10 ? "0" + s : s);
                }
            });
        }, 1000);
    }
    document.addEventListener('DOMContentLoaded', startAdminTimers);
</script>

</x-app-layout>