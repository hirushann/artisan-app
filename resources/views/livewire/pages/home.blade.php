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

<div class="h-full">
    <div class="flex items-center justify-between max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h2 class="text-3xl font-bold tracking-tight text-gray-800 dark:text-white">
            Dashboard
        </h2>
        <a href="{{ route('new-decision') }}" class="inline-flex items-center px-4 py-2 bg-[#F97316] hover:bg-[#ea6a0c] text-white text-sm font-medium rounded-md transition border border-transparent hover:shadow-md">
            <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            New Decision
        </a>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-white dark:bg-gray-800 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Decisions</h3>
                    <p class="text-sm text-gray-500">Your decision-making activity</p>
                    <div class="mt-4 text-3xl font-bold text-[#F97316]">{{ $totalDecisions }}</div>
                    <p class="text-xs text-gray-400 mt-1">All time</p>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-white dark:bg-gray-800 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Recent Activity</h3>
                    <p class="text-sm text-gray-500">Last 7 days</p>
                    <div class="mt-4 text-3xl font-bold text-[#F97316]">{{ $recentDecisions }}</div>
                    <p class="text-xs text-gray-400 mt-1">Decisions made this week</p>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-white dark:bg-gray-800 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Decision Types</h3>
                    <p class="text-sm text-gray-500">Top Categories</p>
                    <div class="mt-4 space-y-2 text-sm">
                        @forelse($decisionTypes as $type)
                            <div class="flex justify-between items-center text-gray-600 dark:text-gray-300">
                                <span>{{ $type->category }}</span>
                                <span class="font-bold bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full text-xs text-gray-800 dark:text-gray-200">{{ $type->count }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-gray-400">No data available.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-white dark:bg-gray-800 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Recent Decision Reports</h3>
                        <p class="text-sm text-gray-500">Your latest decision analysis</p>
                    </div>
                    <a href="{{ route('my-decision') }}" class="text-sm text-[#F97316] hover:underline">View All</a>
                </div>
                
                <div class="mt-4 space-y-2">
                    @forelse($latestReports as $decision)
                        <div class="flex justify-between items-center p-4 border border-gray-100 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $decision->main_purpose }}</h4>
                                <div class="flex space-x-2 text-xs text-gray-500 mt-1">
                                    <span class="bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded">{{ $decision->sub_purpose }}</span>
                                    <span>Created {{ $decision->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <a href="{{ route('decision.show', $decision->id) }}" class="px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition">View</a>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400">
                            No decisions created yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
