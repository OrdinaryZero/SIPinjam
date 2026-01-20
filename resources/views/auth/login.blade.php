    <x-guest-layout>
        <style>
            body { 
                background-color: #000; 
                margin: 0; 
                overflow: hidden; 
                font-family: 'Inter', sans-serif; 
            }

            /* Aksen Background Khas Welcome Page */
            .glow-bg-teal {
                position: absolute; top: -10%; left: 50%; transform: translateX(-50%);
                width: 1000px; height: 600px; 
                background: radial-gradient(circle, rgba(20, 184, 166, 0.08) 0%, rgba(0,0,0,0) 70%);
                filter: blur(120px); border-radius: 100%; z-index: -1;
            }
            .glow-bg-blue {
                position: absolute; bottom: -20%; left: -10%;
                width: 800px; height: 800px; 
                background: radial-gradient(circle, rgba(30, 58, 138, 0.06) 0%, rgba(0,0,0,0) 70%);
                filter: blur(120px); border-radius: 100%; z-index: -1;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.01);
                backdrop-filter: blur(40px);
                -webkit-backdrop-filter: blur(40px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }

            input::placeholder { color: #4b5563; }
        </style>

        <div class="h-screen w-full flex flex-col items-center justify-center p-6 relative">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-teal-900/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-20%] left-[-10%] w-[800px] h-[800px] bg-blue-900/10 rounded-full blur-[120px]"></div>
        </div>
            <div class="flex flex-col items-center mb-6">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(255,255,255,0.1)] mb-2">
                    <svg class="w-6 h-6 text-black" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
                    </svg>
                </div>
                <span class="text-[9px] font-bold uppercase tracking-[0.4em] text-white/60">Saintek Space</span>
            </div>

            <div class="glass-card w-full max-w-[380px] rounded-[32px] p-8 md:p-10 shadow-2xl relative text-white">
                


                <x-auth-session-status class="mb-4 text-[10px] text-center" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-1.5">
                        <x-input-label for="email" :value="__('Email')" class="text-[10px] font-semibold text-gray-500 uppercase tracking-widest ml-1" />
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                            class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-5 py-3 text-white outline-none focus:border-teal-500/30 focus:bg-white/[0.04] transition-all text-xs font-medium" 
                            placeholder="Alamat email">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px]" />
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between px-1">
                            <x-input-label for="password" :value="__('Password')" class="text-[10px] font-semibold text-gray-500 uppercase tracking-widest" />
                            @if (Route::has('password.request'))
                                <a class="text-[9px] font-medium text-gray-400 hover:text-white transition" href="{{ route('password.request') }}">
                                    {{ __('Lupa?') }}
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full bg-white/[0.02] border border-white/10 rounded-xl px-5 py-3 text-white outline-none focus:border-teal-500/30 focus:bg-white/[0.04] transition-all text-xs font-medium" 
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px]" />
                    </div>

                    <div class="flex items-center px-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="w-3.5 h-3.5 rounded bg-white/5 border-white/10 text-teal-500 focus:ring-0 focus:ring-offset-0">
                            <span class="ms-2 text-[10px] text-gray-500 group-hover:text-gray-300 transition italic">{{ __('Ingat saya') }}</span>
                        </label>
                    </div>

                    <div class="pt-1">
                        <button type="submit" class="w-full bg-white text-black font-bold py-3.5 rounded-full text-[10px] uppercase tracking-[0.2em] hover:bg-teal-500 hover:text-white transition-all active:scale-[0.98] shadow-lg">
                            {{ __('Log in') }}
                        </button>
                    </div>

                    <div class="text-center pt-6 border-t border-white/5">
                        <p class="text-[10px] font-medium text-gray-500">
                            Belum punya akun? <a href="{{ route('register') }}" class="text-white hover:text-teal-400 transition-colors ml-1 font-bold">Daftar</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </x-guest-layout>