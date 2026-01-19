<x-app-layout>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .map-engine { animation: float 6s ease-in-out infinite; }
        .room-path { transition: all 0.3s ease; cursor: pointer; }
        .room-path:hover { filter: brightness(1.2); transform: translateY(-5px); }
    </style>

    <div x-data="{ activeFloor: 1 }" class="min-h-screen bg-black flex flex-col text-white">
        
        <div class="pt-12 pb-6 text-center z-50">
            <h1 class="text-5xl font-black uppercase italic tracking-tighter mb-8 text-white">Denah Ruangan</h1>
            <div class="flex gap-4 justify-center">
                <template x-for="floor in [1, 2, 3]">
                    <button @click="activeFloor = floor" 
                        :class="activeFloor === floor ? 'bg-white text-black scale-110 shadow-[0_0_20px_white]' : 'bg-zinc-900 text-gray-400 border-white/5'"
                        class="px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest border transition-all">
                        Floor 0<span x-text="floor"></span>
                    </button>
                </template>
            </div>
        </div>

        <div class="relative flex-1 w-full max-w-6xl mx-auto min-h-[500px] flex items-center justify-center">
            
            <div x-show="activeFloor === 1" x-transition.duration.500ms class="absolute inset-0 flex items-center justify-center map-engine">
                <svg viewBox="0 0 800 500" class="w-full h-auto drop-shadow-2xl">
                    <polygon points="400,50 780,240 400,430 20,240" fill="none" stroke="white" stroke-opacity="0.1" />
                    
                    @include('components.map-floor', ['floor' => 1, 'rooms' => $rooms])
                </svg>
            </div>

            <div x-show="activeFloor === 2" x-transition.duration.500ms class="absolute inset-0 flex items-center justify-center map-engine" style="display: none;">
                <svg viewBox="0 0 800 500" class="w-full h-auto drop-shadow-2xl">
                    <polygon points="400,50 780,240 400,430 20,240" fill="none" stroke="white" stroke-opacity="0.1" />
                    @include('components.map-floor', ['floor' => 2, 'rooms' => $rooms])
                </svg>
            </div>

            <div x-show="activeFloor === 3" x-transition.duration.500ms class="absolute inset-0 flex items-center justify-center map-engine" style="display: none;">
                <svg viewBox="0 0 800 500" class="w-full h-auto drop-shadow-2xl">
                    <polygon points="400,50 780,240 400,430 20,240" fill="none" stroke="white" stroke-opacity="0.1" />
                    @include('components.map-floor', ['floor' => 3, 'rooms' => $rooms])
                </svg>
            </div>
        </div>

        </div>
</x-app-layout>