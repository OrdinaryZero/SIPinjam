<x-guest-layout>
    <div class="h-screen w-full bg-black relative flex items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-teal-900/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[800px] h-[800px] bg-blue-900/10 rounded-full blur-[120px]"></div>
        </div>

        <div class="relative z-10 w-full max-w-[400px] px-6">
            <div class="flex flex-col items-center mb-8">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg mb-3">
                    <svg class="w-7 h-7 text-black" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-[0.5em] text-white/70">Saintek Space</span>
            </div>

            <div class="bg-white/[0.01] backdrop-blur-[40px] border border-white/10 rounded-[40px] p-8 md:p-10 shadow-2xl">


                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-5 py-3 text-white text-xs outline-none focus:border-teal-500/30 transition-all">
                        <x-input-error :messages="$errors->get('name')" class="text-[9px] text-red-500" />
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-5 py-3 text-white text-xs outline-none focus:border-teal-500/30 transition-all">
                        <x-input-error :messages="$errors->get('email')" class="text-[9px] text-red-500" />
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Password</label>
                        <input type="password" name="password" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-5 py-3 text-white text-xs outline-none focus:border-teal-500/30 transition-all">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-5 py-3 text-white text-xs outline-none focus:border-teal-500/30 transition-all">
                    </div>

                    <button type="submit" class="w-full bg-white text-black font-black py-4 rounded-full text-[10px] uppercase tracking-[0.2em] mt-4 hover:bg-teal-400 hover:text-white transition-all active:scale-95 shadow-lg">
                        REGISTER
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>