<nav x-data="{ mobileMenuOpen: false }" class="bg-white dark:bg-gray-900 border-b border-gray-50 dark:border-gray-800">
    <div class="max-w-full mx-auto px-6">
        <div class="flex justify-between items-center h-20">
            <!-- Left Side: Context Info -->
            <div class="flex items-center">
                <div class="hidden md:flex items-center gap-3">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Current Context</span>
                    <div class="w-1 h-1 rounded-full bg-gray-300"></div>
                    <h2 class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest">
                        {{ request()->routeIs('dashboard') ? 'Overview' : (request()->routeIs('my-decision') ? 'Archives' : 'Experiment') }}
                    </h2>
                </div>
            </div>

            @auth
                <div class="flex items-center gap-6">
                    {{-- Theme Toggle --}}
                    <button id="theme-toggle" type="button" class="p-2 text-gray-400 hover:text-indigo-600 transition-colors">
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-3 p-1 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                            <div class="text-right hidden sm:block">
                                <div class="text-xs font-black text-gray-900 dark:text-white leading-none">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Researcher</div>
                            </div>
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="w-10 h-10 rounded-xl object-cover border-2 border-white dark:border-gray-800 shadow-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @else
                                <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black text-xs uppercase">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            @endif
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             class="absolute right-0 mt-3 w-56 rounded-[2rem] bg-white dark:bg-gray-800 shadow-2xl border border-gray-100 dark:border-gray-700 py-4 z-50 overflow-hidden">
                            
                            <div class="px-6 py-2 mb-2 border-b border-gray-50 dark:border-gray-700/50">
                                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Account</div>
                                <div class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->email }}</div>
                            </div>

                            <a href="{{ route('profile.show') }}" class="flex items-center px-6 py-3 text-sm font-bold text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/10 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Lab Settings
                            </a>

                            <div class="border-t border-gray-50 dark:border-gray-700/50 my-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center px-6 py-3 text-sm font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    End Session
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="mobileMenuOpen = ! mobileMenuOpen" class="p-2 rounded-xl text-gray-400 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path :class="{ 'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" d="M4 6h16M4 12h16M4 18h16" stroke-width="2.5"/><path :class="{ 'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" d="M6 18L18 6M6 6l12 12" stroke-width="2.5"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="sm:hidden border-t border-gray-50 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="p-6 space-y-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm font-black text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 rounded-xl">Overview</a>
            <a href="{{ route('my-decision') }}" class="block px-4 py-2 text-sm font-medium text-gray-500">Archives</a>
            <div class="border-t border-gray-50 dark:border-gray-800 pt-4">
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm font-medium text-gray-500">Profile Settings</a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="block w-full text-left px-4 py-2 text-sm font-bold text-red-500">Log Out</button></form>
            </div>
        </div>
    </div>
</nav>
