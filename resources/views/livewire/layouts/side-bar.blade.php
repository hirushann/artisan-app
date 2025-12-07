<div class="flex flex-col items-center lg:pt-6 sm:pt-0">

    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center pt-3 lg:p-2 mt-2 lg:ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-[15%] h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto flex flex-col bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-4 font-medium mt-4">
                {{-- Logo / Brand (Optional to keep or style) --}}
                <li class="flex items-center justify-between px-2 mb-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-start gap-3">
                        <x-application-mark class="block h-9 w-auto" />
                        <span class="text-xl font-bold text-gray-800 dark:text-white">Decisioner</span>
                    </a>
                </li>

                @auth
                    {{-- Dashboard --}}
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center p-3 text-gray-900 rounded-lg dark:text-white hover:bg-orange-50 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-orange-50 dark:bg-gray-700 text-orange-600' : '' }}">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white {{ request()->routeIs('dashboard') ? 'text-orange-600' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>

                    {{-- My Decisions --}}
                    <li>
                        <a href="{{ route('my-decision') }}"
                            class="flex items-center p-3 text-gray-900 rounded-lg dark:text-white hover:bg-orange-50 dark:hover:bg-gray-700 group {{ request()->routeIs('my-decision') ? 'bg-orange-50 dark:bg-gray-700 text-orange-600' : '' }}">
                            <svg class="shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white {{ request()->routeIs('my-decision') ? 'text-orange-600' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 17.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">My Decisions</span>
                        </a>
                    </li>

                    {{-- Show Single (Decision History/Drafts?) --}}
                    {{-- <li>
                        <a href="{{ route('decision.show', ['decision' => 1]) }}"
                            class="flex items-center p-3 text-gray-900 rounded-lg dark:text-white hover:bg-orange-50 dark:hover:bg-gray-700 group {{ request()->routeIs('decision.show') ? 'bg-orange-50 dark:bg-gray-700 text-orange-600' : '' }}">
                            <svg class="shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white {{ request()->routeIs('decision.show') ? 'text-orange-600' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Show Single</span>
                        </a>
                    </li> --}}
                @endauth

                {{-- New Decision --}}
                <li>
                    <a href="{{ route('new-decision') }}"
                        class="flex items-center p-3 text-gray-900 rounded-lg dark:text-white hover:bg-orange-50 dark:hover:bg-gray-700 group {{ request()->routeIs('new-decision') ? 'bg-orange-50 dark:bg-gray-700 text-orange-600' : '' }}">
                        <svg class="shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-orange-600 dark:group-hover:text-white {{ request()->routeIs('new-decision') ? 'text-orange-600' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">New Decision</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
