<nav x-data="{ open: false }" class="relative z-50 w-full bg-transparent border-none pt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            
            <div class="shrink-0 flex items-center z-20">
                <a href="{{ ('/') }}" class="flex items-center gap-2 group">
                    <div class="text-white group-hover:text-cyan-400 transition-colors duration-300 drop-shadow-[0_0_8px_rgba(255,255,255,0.3)]">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
                    </div>
                    <span class="font-bold text-xl tracking-wide text-white drop-shadow-md">SiPinjam</span>
                </a>
            </div>

            <div class="hidden md:absolute md:left-1/2 md:-translate-x-1/2 md:flex md:items-center md:gap-8">
                @foreach([
                    ['name' => 'Dashboard', 'route' => 'dashboard'],
                    ['name' => 'About', 'route' => 'about']
                ] as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="text-sm font-medium transition-all hover:scale-105 hover:drop-shadow-[0_0_5px_rgba(255,255,255,0.5)]
                       {{ request()->routeIs($item['route']) ? 'text-white font-bold' : 'text-gray-300 hover:text-white' }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden md:flex md:items-center md:gap-4 z-20">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ url('/admin') }}" class="rounded-full bg-white px-5 py-2 text-xs font-bold text-black hover:bg-cyan-400 hover:scale-105 transition-all shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                            Admin Panel
                        </a>
                    @endif

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 text-sm font-medium text-gray-300 hover:text-white transition focus:outline-none bg-white/5 px-2 py-1.5 pr-3 rounded-full border border-white/5 hover:bg-white/10">
                                
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="w-8 h-8 rounded-full object-cover border border-white/20">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-cyan-600 to-blue-600 flex items-center justify-center text-xs text-white font-bold shadow-lg">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                
                                <span class="hidden lg:block">{{ Auth::user()->name }}</span>
                                <svg class="h-3 w-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-[#0a0a0a] border border-white/10 rounded-lg py-1 mt-2 shadow-2xl">
                                <x-dropdown-link :href="route('profile.edit')" class="text-gray-400 hover:bg-white/10 hover:text-white">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" class="text-rose-500 hover:bg-rose-500/10 hover:text-rose-400"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>

                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition">Log in</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-white px-6 py-2 text-sm font-bold text-black hover:bg-gray-200 transition shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                        Get Started
                    </a>
                @endauth
            </div>

            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-black/90 backdrop-blur-xl border-b border-white/10 absolute w-full z-50">
        <div class="space-y-1 pt-2 pb-3 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-gray-300">About</x-responsive-nav-link>
            
            <div class="border-t border-white/10 mt-2 pt-2">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="text-rose-500" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')" class="text-gray-300">Log In</x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>