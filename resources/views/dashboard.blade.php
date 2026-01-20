<x-app-layout>
    <style>
        .float-animation { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        .fade-in { animation: fadeIn 1s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="min-h-screen text-white flex flex-col font-sans overflow-hidden relative" 
         x-data="{ viewState: 'overview', activeFloor: 1, activeRoom: null }">


        <div x-show="viewState === 'overview'" 
             x-transition:leave="transition ease-in duration-300 opacity-0 scale-95"
             class="flex-1 flex flex-col items-center justify-center p-6 relative z-10 fade-in">
            
            <div class="text-center mb-8 relative">
                <div class="inline-block px-4 py-1.5 rounded-full border border-white/10 bg-white/5 text-[10px] font-bold uppercase tracking-[0.2em] text-cyan-400 backdrop-blur-md mb-6">
                    Saintek 2.0
                </div>
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-white mb-2 drop-shadow-2xl">
                    Denah Gedung
                </h1>
                <p class="text-gray-400 text-sm md:text-base tracking-[0.4em] uppercase font-medium">
                    Interactive 3D Visualization
                </p>
            </div>

            <div @click="viewState = 'map'" 
                 class="cursor-pointer group relative w-full max-w-2xl aspect-video flex items-center justify-center transition-all duration-500 hover:scale-105">
                
                <div class="absolute inset-0 bg-cyan-500/10 blur-[60px] rounded-full scale-75 group-hover:scale-100 transition-transform duration-700"></div>

                <svg viewBox="0 0 800 500" class="w-full h-full float-animation drop-shadow-2xl overflow-visible">
                    <path d="M250 400 L400 450 L650 370 L500 320 Z" fill="black" opacity="0.5" filter="url(#blur)"/>
                    <defs><filter id="blur"><feGaussianBlur stdDeviation="15"/></filter></defs>

                    <g transform="translate(400, 250)">
                        <path d="M-120 40 L-120 180 L40 250 L40 110 Z" fill="#1e293b"/> 
                        <path d="M40 250 L40 110 L200 40 L200 180 Z" fill="#cbd5e1"/> 
                        <path d="M40 140 L200 70 L200 100 L40 170 Z" fill="#0ea5e9" />
                        <path d="M40 190 L200 120 L200 150 L40 220 Z" fill="#0ea5e9" />
                        <path d="M-120 40 L40 110 L200 40 L40 -30 Z" fill="#f1f5f9"/>
                        <g transform="translate(20, 220)"><path d="M-10 0 L30 -20 L50 -10 L10 10 Z" fill="#0f172a"/> </g>
                    </g>
                </svg>


            </div>
        </div>

        <div x-show="viewState === 'map'" style="display: none;"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 translate-y-20"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="flex-1 flex flex-col h-full relative z-10">
            
            <div class="px-6 py-6 flex flex-col md:flex-row justify-between items-center z-20 gap-4">
                <button @click="viewState = 'overview'" class="flex items-center gap-2 px-5 py-2 rounded-full border border-white/10 text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-white hover:border-white transition-all">
                    &larr; KEMBALI
                </button>
                
                <div class="flex bg-white/5 backdrop-blur-md p-1 rounded-full border border-white/10 shadow-lg">
                    <template x-for="floor in [1, 2, 3]">
                        <button @click="activeFloor = floor; activeRoom = null"
                                :class="activeFloor === floor ? 'bg-white text-black shadow-md' : 'text-gray-400 hover:text-white'"
                                class="px-8 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest transition-all">
                            LANTAI <span x-text="floor"></span>
                        </button>
                    </template>
                </div>
                
                <div class="w-32 hidden md:block"></div>
            </div>

            <div class="flex-1 relative flex items-center justify-center overflow-hidden -mt-8">
                @foreach([1, 2, 3] as $floor)
                    <div x-show="activeFloor === {{ $floor }}" 
                         x-transition.opacity.duration.500ms
                         class="absolute inset-0 flex items-center justify-center">
                        <svg viewBox="0 0 800 500" class="w-full h-full max-w-7xl drop-shadow-2xl">
                            @include('components.map-floor', ['floor' => $floor, 'rooms' => $rooms])
                        </svg>
                    </div>
                @endforeach
            </div>
        </div>

        <div x-show="activeRoom" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             class="fixed bottom-10 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
            
            <div class="pointer-events-auto bg-[#0a0a0a]/95 backdrop-blur-xl w-full max-w-md rounded-3xl border border-white/10 p-6 shadow-2xl relative">
                <button @click="activeRoom = null" class="absolute top-4 right-4 text-gray-500 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="flex flex-col gap-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-[10px] font-bold tracking-widest text-cyan-400 uppercase block mb-1">LANTAI <span x-text="activeRoom.lokasi_lantai"></span></span>
                            <h3 x-text="activeRoom.nama_ruangan" class="text-2xl font-black text-white leading-none"></h3>
                        </div>
                        <div :class="(activeRoom.status.toLowerCase() == 'tersedia' || activeRoom.status.toLowerCase() == 'available') ? 'bg-white text-black' : 'bg-rose-600 text-white'"
                             class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-full border border-white/10">
                            <span x-text="activeRoom.status"></span>
                        </div>
                    </div>
                    
                    <p x-text="activeRoom.fasilitas" class="text-gray-400 text-sm leading-relaxed"></p>

                    <template x-if="activeRoom.status.toLowerCase() == 'tersedia' || activeRoom.status.toLowerCase() == 'available'">
                        <a :href="'/peminjaman?room_id=' + activeRoom.id" 
                           class="block w-full py-3 bg-white text-black font-bold text-center text-xs uppercase tracking-widest rounded-full hover:bg-gray-200 transition-all mt-2">
                            BOOKING SEKARANG
                        </a>
                    </template>
                    <template x-if="activeRoom.status.toLowerCase() != 'tersedia' && activeRoom.status.toLowerCase() != 'available'">
                        <button disabled class="block w-full py-3 bg-white/5 text-gray-500 font-bold text-center text-xs uppercase tracking-widest rounded-full cursor-not-allowed border border-white/5 mt-2">
                            TIDAK TERSEDIA
                        </button>
                    </template>
                </div>
            </div>
        </div>

    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek apakah ada pesan 'success' dari Controller
        @if(session('success'))
            Swal.fire({
                title: 'RUANGAN TERKUNCI!',
                text: "{{ session('success') }}",
                icon: 'success',
                
                // Styling Dark Mode agar sesuai tema
                background: '#0f1014', 
                color: '#ffffff',
                iconColor: '#22d3ee', // Warna Cyan
                
                confirmButtonText: 'SIAP, TERIMA KASIH',
                confirmButtonColor: '#ffffff',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'px-6 py-3 bg-white text-black font-bold uppercase tracking-widest rounded-full hover:bg-gray-200 transition-all',
                    popup: 'border border-white/10 rounded-3xl shadow-2xl'
                },
                
                // Efek masuk
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        @endif

        // Cek apakah ada pesan 'error'
        @if(session('error'))
            Swal.fire({
                title: 'GAGAL!',
                text: "{{ session('error') }}",
                icon: 'error',
                background: '#0f1014',
                color: '#ffffff',
                confirmButtonText: 'TUTUP',
                confirmButtonColor: '#f43f5e'
            });
        @endif
    </script>

</x-app-layout>

