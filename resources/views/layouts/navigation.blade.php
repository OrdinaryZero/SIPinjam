<nav x-data="{ open: false }" class="bg-black/80 backdrop-blur-xl border-b border-white/10 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(255,255,255,0.3)] hover:scale-110 transition">
                            <svg class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('denah')" :active="request()->routeIs('denah')" class="text-[10px] font-black uppercase tracking-[0.2em]">
    {{ __('Denah 3D') }}
</x-nav-link>

                    <x-nav-link :href="route('peminjaman')" :active="request()->routeIs('peminjaman')" class="text-gray-300 hover:text-white">
                        {{ __('Peminjaman') }}
                    </x-nav-link>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-gray-300 hover:text-white">
                        {{ __('About Us') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                
                @if(Auth::user()->role === 'admin')
                    <a href="{{ url('/admin') }}" 
                       style="background-color: white !important; color: black !important; border: none !important;"
                       class="px-4 py-2 text-xs font-bold uppercase tracking-widest rounded-lg shadow-[0_0_15px_rgba(255,255,255,0.4)] transition-all duration-300 transform hover:scale-105">
                        Admin Panel
                    </a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none transition ease-in-out duration-150 gap-3 group">
                            
                            @if(Auth::user()->avatar)
                                <img class="h-8 w-8 rounded-full object-cover border border-white/20 group-hover:border-white/50 transition" 
                                     src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     alt="{{ Auth::user()->name }}" />
                            @else
                                <div class="h-8 w-8 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-300 font-bold text-xs border border-indigo-500/30">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            @endif

                            <div class="flex flex-col items-start">
                                <span class="leading-tight">{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
    <div class="px-4 py-3 border-b border-white/10 bg-white/5">
        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Status Akun</p>
        <p class="text-xs font-bold text-white mt-1 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full {{ Auth::user()->role === 'admin' ? 'bg-white shadow-[0_0_8px_rgba(255,255,255,0.8)]' : 'bg-gray-500' }}"></span>
            {{ strtoupper(Auth::user()->role) }}
        </p>
    </div>

    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 py-3 hover:bg-white/10 transition">
        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        {{ __('Account Settings') }}
    </x-dropdown-link>

    <div class="border-t border-white/5"></div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-dropdown-link :href="route('logout')"
                class="flex items-center gap-2 py-3 text-rose-400 hover:bg-rose-500/10 transition"
                onclick="event.preventDefault(); this.closest('form').submit();">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            {{ __('Sign Out') }}
        </x-dropdown-link>
    </form>
</x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-zinc-900 border-b border-white/10">
    <div class="pt-2 pb-3 space-y-1">
        
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-white hover:bg-white/5 transition duration-150 ease-in-out">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('denah3d')" :active="request()->routeIs('denah3d')" class="text-gray-300 hover:text-white hover:bg-white/5 transition duration-150 ease-in-out">
            {{ __('D E N A H  3 D') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('peminjaman')" :active="request()->routeIs('peminjaman')" class="text-gray-300 hover:text-white hover:bg-white/5 transition duration-150 ease-in-out">
            {{ __('Peminjaman') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-gray-300 hover:text-white hover:bg-white/5 transition duration-150 ease-in-out">
            {{ __('About Us') }}
        </x-responsive-nav-link>
        
        @if(Auth::user()->role === 'admin')
            <div class="px-4 py-2 mt-2 border-t border-white/10">
                <a href="{{ url('/admin') }}" 
                   class="block w-full text-center py-3 text-xs font-extrabold uppercase tracking-widest rounded-lg bg-white text-black shadow-[0_0_15px_rgba(255,255,255,0.3)] hover:shadow-[0_0_20px_rgba(255,255,255,0.6)] transition-all duration-300">
                      Admin Panel
                </a>
            </div>
        @endif
    </div>
</div>
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4 flex items-center gap-3">
                @if(Auth::user()->avatar)
                    <img class="h-10 w-10 rounded-full object-cover border border-white/20" 
                         src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                         alt="{{ Auth::user()->name }}" />
                @else
                    <div class="h-10 w-10 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-300 font-bold border border-indigo-500/30">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-gray-300">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>