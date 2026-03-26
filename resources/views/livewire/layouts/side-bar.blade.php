<div class="flex flex-col items-center">
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/></svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 border-r border-gray-100 dark:border-gray-800"
        aria-label="Sidebar">
        <div class="h-full px-4 py-8 flex flex-col bg-white dark:bg-gray-900">
            {{-- Brand Logo --}}
            <div class="px-3 mb-10">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-xl font-black text-gray-900 dark:text-white tracking-tighter">Artisan<span class="text-indigo-600">Lab</span></span>
                </a>
            </div>

            <nav class="flex-1 space-y-2">
                @auth
                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-3 text-sm font-bold rounded-2xl transition-all group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400 font-black' : 'text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-300 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                        <span class="ms-4">Overview</span>
                    </a>

                    {{-- Archive --}}
                    <a href="{{ route('my-decision') }}"
                        class="flex items-center p-3 text-sm font-bold rounded-2xl transition-all group {{ request()->routeIs('my-decision') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400 font-black' : 'text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('my-decision') ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-300 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        <span class="ms-4">Archives</span>
                    </a>
                @endauth

                {{-- New Experiment --}}
                <div class="pt-6 mt-6 border-t border-gray-100 dark:border-gray-800">
                    <a href="{{ route('new-decision') }}"
                        class="flex items-center p-3 text-sm font-bold rounded-2xl transition-all group shadow-2xl shadow-indigo-500/10 {{ request()->routeIs('new-decision') ? 'bg-indigo-600 text-white font-black' : 'text-indigo-600 bg-indigo-50 dark:bg-indigo-900/20 hover:scale-105' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                        <span class="ms-4">New Experiment</span>
                    </a>
                </div>
            </nav>

            {{-- Footer Info --}}
            <div class="mt-auto p-4 bg-gray-50 dark:bg-gray-800/50 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">AI Ready</span>
                </div>
                <p class="text-[10px] text-gray-500 font-bold leading-relaxed">Powered by Gemini 1.5 Flash. Processing in safe lab environment.</p>
            </div>
        </div>
    </aside>
</div>
