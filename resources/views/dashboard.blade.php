<x-app-layout>
    <div class="mx-auto px-6 lg:px-12 py-12">
        {{-- Top Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter">Dashboard</h1>
                <p class="text-gray-500 dark:text-gray-400 font-medium mt-1">Overview of your intelligent decision workspace.</p>
            </div>
            <a href="{{ route('new-decision') }}" 
               class="inline-flex items-center gap-3 px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-sm shadow-xl shadow-indigo-500/20 transition-all hover:scale-105 active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                New Experiment
            </a>
        </div>

        {{-- Stats Row --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            {{-- Total Decisions --}}
            <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] p-8 shadow-xl border border-gray-50 dark:border-gray-700 relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-indigo-500/5 blur-2xl rounded-full"></div>
                <div class="relative z-10">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Total Decisions</h3>
                    <div class="text-5xl font-black text-gray-900 dark:text-white mb-2">{{ \App\Models\Decision::where('user_id', auth()->id())->count() }}</div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Across all time</p>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] p-8 shadow-xl border border-gray-50 dark:border-gray-700 relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-purple-500/5 blur-2xl rounded-full"></div>
                <div class="relative z-10">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Recent Activity</h3>
                    <div class="text-5xl font-black text-indigo-600 dark:text-indigo-400 mb-2">
                        {{ \App\Models\Decision::where('user_id', auth()->id())->where('created_at', '>=', now()->subDays(7))->count() }}
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Decisions last 7 days</p>
                </div>
            </div>

            {{-- Decision Types --}}
            <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] p-8 shadow-xl border border-gray-50 dark:border-gray-700 relative overflow-hidden group">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-pink-500/5 blur-2xl rounded-full"></div>
                <div class="relative z-10">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Decision Types</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-600 dark:text-gray-300">Business</span>
                            <span class="px-2 py-1 rounded-lg bg-gray-50 dark:bg-gray-700 text-[10px] font-black text-gray-900 dark:text-white">{{ \App\Models\Decision::where('user_id', auth()->id())->where('sub_purpose', 'Business')->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-600 dark:text-gray-300">Personal</span>
                            <span class="px-2 py-1 rounded-lg bg-gray-50 dark:bg-gray-700 text-[10px] font-black text-gray-900 dark:text-white">{{ \App\Models\Decision::where('user_id', auth()->id())->where('sub_purpose', 'Personal')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Activity Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-[3rem] p-10 lg:p-14 shadow-2xl border border-gray-50 dark:border-gray-700">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">Recent Decision Reports</h2>
                    <p class="text-gray-400 font-medium text-sm mt-1">Access your latest analysis results</p>
                </div>
                <a href="{{ route('my-decision') }}" class="text-indigo-600 dark:text-indigo-400 font-black text-xs uppercase tracking-widest hover:underline ring-offset-8">View All</a>
            </div>

            <div class="space-y-6">
                @php
                    $latestDecisions = \App\Models\Decision::where('user_id', auth()->id())->latest()->take(5)->get();
                @endphp

                @forelse($latestDecisions as $decision)
                    <div class="group flex items-center justify-between p-6 rounded-[2rem] bg-gray-50/50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-800 transition-all hover:bg-white dark:hover:bg-gray-800 hover:shadow-xl hover:scale-[1.01]">
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-gray-800 flex items-center justify-center text-indigo-600 shadow-sm border border-gray-100 dark:border-gray-700">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-gray-900 dark:text-white tracking-tight mb-1">{{ $decision->main_purpose }}</h4>
                                <div class="flex items-center gap-3">
                                    <span class="px-2 py-0.5 rounded-lg bg-indigo-50 dark:bg-indigo-900/40 text-[9px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">{{ $decision->sub_purpose }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Created {{ $decision->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('decision.show', $decision->id) }}" class="px-6 py-2.5 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-[10px] font-black uppercase tracking-[0.2em] text-gray-900 dark:text-white rounded-xl transition-all hover:bg-indigo-600 hover:text-white hover:border-indigo-600 hover:shadow-lg shadow-indigo-500/20">
                            View
                        </a>
                    </div>
                @empty
                    <div class="py-20 text-center">
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">No analysis history yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>