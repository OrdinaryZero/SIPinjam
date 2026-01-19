<x-app-layout>
    
    <div class="relative overflow-hidden py-12">
        
        <div class="absolute top-0 left-1/4 w-64 h-64 md:w-96 md:h-96 bg-indigo-900/30 rounded-full mix-blend-screen filter blur-[100px] opacity-40 animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 md:w-96 md:h-96 bg-blue-900/30 rounded-full mix-blend-screen filter blur-[100px] opacity-40 animate-blob animation-delay-2000"></div>

        <div x-data="{ loaded: false }" 
             x-init="setTimeout(() => loaded = true, 100)" 
             class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div x-show="loaded" 
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-5"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="mb-6 md:mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="font-bold text-3xl md:text-4xl text-white tracking-tight">
                        Dashboard
                    </h2>
                    <p class="text-gray-400 mt-2 text-base md:text-lg font-light">
                        Kelola aktivitas ruangan dalam mode gelap.
                    </p>
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Hari Ini</p>
                    <p class="text-xl md:text-2xl font-medium text-gray-200">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>

            @if(session('success'))
                <div x-show="loaded" 
                     x-transition:enter="transition ease-out duration-500 delay-100"
                     class="mb-6 md:mb-8 bg-emerald-900/30 backdrop-blur-md border border-emerald-500/30 text-emerald-400 p-4 rounded-2xl flex items-center gap-3 shadow-lg shadow-emerald-900/20">
                    <div class="bg-emerald-500/20 p-2 rounded-full flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="font-medium text-sm md:text-base">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div x-show="loaded" 
                     x-transition:enter="transition ease-out duration-500"
                     class="mb-6 md:mb-8 bg-rose-900/30 backdrop-blur-md border border-rose-500/30 text-rose-400 p-4 rounded-2xl flex items-center gap-3 shadow-lg shadow-rose-900/20 animate-pulse">
                    <div class="bg-rose-500/20 p-2 rounded-full flex-shrink-0">
                        <svg class="h-5 w-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold block">Gagal Booking!</span>
                        <span class="text-sm opacity-90">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-rose-900/30 border border-rose-500/30 text-rose-300 p-4 rounded-2xl">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8">
                
                <div class="lg:col-span-4" 
                     x-show="loaded"
                     x-transition:enter="transition ease-out duration-700 delay-200"
                     x-transition:enter-start="opacity-0 translate-y-10"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <div class="bg-zinc-900/60 backdrop-blur-xl border border-white/10 rounded-3xl p-6 md:p-8 lg:sticky lg:top-24 transition-all duration-300 hover:border-white/20 hover:shadow-lg hover:shadow-white/5">
                        
                        <div class="flex items-center gap-3 mb-6 md:mb-8">
                            <div class="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center shadow-inner border border-white/10 flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white leading-tight">Buat Pengajuan</h3>
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Form Baru</p>
                            </div>
                        </div>

                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-5 md:space-y-6">
                            @csrf
                            
                            <div class="group">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 group-focus-within:text-white transition-colors">Pilih Ruangan</label>
                                <div class="relative">
<select name="room_id" class="w-full bg-black border border-white/10 rounded-xl text-white px-4 py-3">
    <option value="">-- Pilih Ruangan --</option>
    
    {{-- Tambahkan '?? []' agar jika $rooms null, ia berubah jadi list kosong dan tidak error --}}
    @if(count($rooms ?? []) > 0)
        @foreach($rooms as $room)
            <option value="{{ $room->id }}" @selected($room->id == ($selectedRoomId ?? null))>
                {{ strtoupper($room->nama_ruangan) }}
            </option>
        @endforeach
    @else
        <option value="">Data ruangan tidak ditemukan</option>
    @endif
</select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 group-focus-within:text-white transition-colors">Tanggal</label>
                                <input type="date" name="tanggal" class="w-full px-4 py-3 rounded-2xl border border-white/10 bg-black/40 text-gray-200 focus:ring-2 focus:ring-white/20 focus:border-white/30 focus:bg-zinc-900 transition-all text-sm [color-scheme:dark]">
                            </div>

                            <div class="grid grid-cols-2 gap-3 md:gap-4">
                                <div class="group">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 group-focus-within:text-white transition-colors">Mulai</label>
                                    <input type="time" name="jam_mulai" class="w-full px-3 py-3 rounded-2xl border border-white/10 bg-black/40 text-gray-200 focus:ring-2 focus:ring-white/20 focus:border-white/30 focus:bg-zinc-900 transition-all text-sm [color-scheme:dark]">
                                </div>
                                <div class="group">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 group-focus-within:text-white transition-colors">Selesai</label>
                                    <input type="time" name="jam_selesai" class="w-full px-3 py-3 rounded-2xl border border-white/10 bg-black/40 text-gray-200 focus:ring-2 focus:ring-white/20 focus:border-white/30 focus:bg-zinc-900 transition-all text-sm [color-scheme:dark]">
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 group-focus-within:text-white transition-colors">Keperluan</label>
                                <textarea name="keperluan" rows="3" class="w-full px-4 py-3 rounded-2xl border border-white/10 bg-black/40 text-gray-200 focus:ring-2 focus:ring-white/20 focus:border-white/30 focus:bg-zinc-900 transition-all text-sm resize-none" placeholder="Tulis detail kegiatan..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-white text-black font-bold py-4 rounded-2xl shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_25px_rgba(255,255,255,0.2)] hover:bg-gray-100 transform transition-all duration-300 hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2 group">
                                <span>Kirim Pengajuan</span>
                                <svg class="w-4 h-4 text-gray-600 group-hover:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-8"
                     x-show="loaded"
                     x-transition:enter="transition ease-out duration-700 delay-400"
                     x-transition:enter-start="opacity-0 translate-y-10"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    
                    <div class="bg-zinc-900/60 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden flex flex-col h-full hover:border-white/20 transition-colors duration-300">
                        <div class="p-6 md:p-8 border-b border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">Riwayat Pengajuan</h3>
                                <p class="text-sm text-gray-400 mt-1">Status permohonanmu.</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="px-4 py-2 bg-white/5 rounded-full text-xs font-bold text-gray-300 border border-white/10">
                                    Total: {{ count($myBookings) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse min-w-[600px] md:min-w-full">
                                <thead>
                                    <tr class="border-b border-white/5">
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Ruangan</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Waktu</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @forelse($myBookings as $booking)
                                    <tr class="group hover:bg-white/5 transition-colors duration-200">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 rounded-full bg-white/10 flex items-center justify-center text-gray-300 font-bold text-sm group-hover:bg-white group-hover:text-black transition-colors duration-300 flex-shrink-0">
                                                    {{ substr($booking->room->nama_ruangan, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-gray-200 text-sm md:text-base group-hover:text-white">{{ $booking->room->nama_ruangan }}</div>
                                                    <div class="text-xs text-gray-500">{{ $booking->room->lokasi_lantai ?? 'Lantai Dasar' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-gray-400 group-hover:text-gray-200">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</span>
                                                <span class="text-xs text-gray-600 mt-1 font-mono">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-5">
                                            @if($booking->status == 'pending')
                                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-900/30 border border-amber-500/20">
                                                    <span class="relative flex h-2 w-2">
                                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                                      <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                                    </span>
                                                    <span class="text-xs font-bold text-amber-400 uppercase tracking-wide">Menunggu</span>
                                                </div>
                                            @elseif($booking->status == 'approved')
                                                <div class="flex flex-col items-start gap-2">
                                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-900/30 border border-emerald-500/20">
                                                        <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-wide">Disetujui</span>
                                                    </div>
                                                    
                                                    <a href="{{ route('booking.download', $booking->id) }}" target="_blank" class="flex items-center gap-1 text-xs font-bold text-emerald-400 hover:text-emerald-200 transition underline decoration-emerald-500/30 hover:decoration-emerald-200">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                        Cetak Surat
                                                    </a>
                                                </div>
                                            @else
                                                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-rose-900/30 border border-rose-500/20">
                                                    <span class="text-xs font-bold text-rose-400 uppercase tracking-wide">Ditolak</span>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-5">
                                            <p class="text-sm text-gray-500 max-w-[150px] truncate group-hover:text-gray-300 transition-colors">{{ $booking->keperluan }}</p>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center opacity-40">
                                                <svg class="w-8 h-8 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                <p class="text-gray-500 font-medium text-sm">Belum ada riwayat pengajuan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>