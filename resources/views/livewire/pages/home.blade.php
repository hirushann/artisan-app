<?php

use Livewire\Volt\Component;
use App\Models\Decision;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public function with()
    {
        $userId = Auth::id();
        
        $totalDecisions = Decision::where('user_id', $userId)->count();
        $recentDecisions = Decision::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();
            
        $decisionTypes = Decision::where('user_id', $userId)
            ->selectRaw('sub_purpose as category, count(*) as count')
            ->groupBy('sub_purpose')
            ->get();
            
        $latestReports = Decision::where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return [
            'totalDecisions' => $totalDecisions,
            'recentDecisions' => $recentDecisions,
            'decisionTypes' => $decisionTypes,
            'latestReports' => $latestReports,
        ];
    }
}; ?>

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
                <div class="text-5xl font-black text-gray-900 dark:text-white mb-2">{{ $totalDecisions }}</div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none">Your decision-making activity</p>
                <p class="text-[10px] font-bold text-gray-400/60 uppercase tracking-widest mt-1">Across all time</p>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] p-8 shadow-xl border border-gray-50 dark:border-gray-700 relative overflow-hidden group">
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-purple-500/5 blur-2xl rounded-full"></div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Recent Activity</h3>
                <div class="text-5xl font-black text-indigo-600 dark:text-indigo-400 mb-2">{{ $recentDecisions }}</div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none">Last 7 days</p>
                <p class="text-[10px] font-bold text-gray-400/60 uppercase tracking-widest mt-1">Decisions made this week</p>
            </div>
        </div>

        {{-- Decision Types --}}
        <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] p-8 shadow-xl border border-gray-50 dark:border-gray-700 relative overflow-hidden group">
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-pink-500/5 blur-2xl rounded-full"></div>
            <div class="relative z-10">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Decision Types</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Top Categories</p>
                <div class="space-y-4">
                    @forelse($decisionTypes as $type)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-600 dark:text-gray-300 capitalize">{{ str_replace('-', ' ', $type->category) }}</span>
                            <span class="px-2 py-1 rounded-lg bg-gray-50 dark:bg-gray-700 text-[10px] font-black text-gray-900 dark:text-white">{{ $type->count }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400">No data yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Main Activity Section --}}
    <div class="bg-white dark:bg-gray-800 rounded-[3rem] p-10 lg:p-14 shadow-2xl border border-gray-50 dark:border-gray-700">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight leading-none mb-1">Recent Decision Reports</h2>
                <p class="text-gray-400 font-medium text-sm">Your latest decision analysis</p>
            </div>
            <a href="{{ route('my-decision') }}" class="text-indigo-600 dark:text-indigo-400 font-black text-xs uppercase tracking-widest hover:underline ring-offset-8">View All</a>
        </div>

        <div class="space-y-6">
            @forelse($latestReports as $decision)
                <div class="group flex items-center justify-between p-6 rounded-[2.5rem] bg-gray-50/50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-800 transition-all hover:bg-white dark:hover:bg-gray-800 hover:shadow-xl hover:scale-[1.01]">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 rounded-2xl bg-white dark:bg-gray-800 flex items-center justify-center text-indigo-600 shadow-sm border border-gray-100 dark:border-gray-700 transition-transform group-hover:scale-110">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-gray-900 dark:text-white tracking-tight mb-1">{{ $decision->main_purpose }}</h4>
                            <div class="flex items-center gap-3">
                                <span class="px-2 py-0.5 rounded-lg bg-indigo-50 dark:bg-indigo-900/40 text-[9px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">{{ $decision->sub_purpose }}</span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Created {{ $decision->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('decision.show', $decision->id) }}" class="px-8 py-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-[10px] font-black uppercase tracking-[0.2em] text-gray-900 dark:text-white rounded-2xl transition-all hover:bg-indigo-600 hover:text-white hover:border-indigo-600 hover:shadow-lg shadow-indigo-500/20">
                        View
                    </a>
                </div>
            @empty
                <div class="py-20 text-center">
                    <div class="w-20 h-20 bg-gray-50 dark:bg-gray-900 rounded-[2rem] flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-200 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                    </div>
                    <p class="text-gray-400 font-black uppercase tracking-widest text-sm">Initiate your first experiment</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

