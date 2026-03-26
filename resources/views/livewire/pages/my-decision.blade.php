<?php

use Livewire\Volt\Component;
use App\Models\Decision;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public function with()
    {
        return [
            'decisions' => Decision::where('user_id', Auth::id())
                ->latest()
                ->get()
                ->map(function ($decision) {
                    $aiData = json_decode($decision->ai_response, true);
                    $decision->recommendation = $aiData['recommended_option'] ?? 'Pending...';
                    return $decision;
                })
        ];
    }
}; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 mb-4">
                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                <span class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Archive</span>
            </div>
            <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight">Your Decision Library</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2 font-medium">Revisit and manage your AI-powered insights.</p>
        </div>
        
        <a href="{{ route('new-decision') }}" 
           class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl font-black text-sm shadow-2xl transition-all hover:scale-105">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
            Start New Experiment
        </a>
    </div>

    @if($decisions->isEmpty())
        <div class="py-24 text-center bg-white dark:bg-gray-800 rounded-[3rem] border border-gray-100 dark:border-gray-700 shadow-2xl animate-in fade-in zoom-in duration-700">
            <div class="mx-auto w-24 h-24 bg-gray-50 dark:bg-gray-700/50 rounded-[2rem] flex items-center justify-center mb-8">
                <svg class="w-10 h-10 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            </div>
            <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">No experiments yet</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-10 max-w-sm mx-auto font-medium">Run your first AI decision analysis to populate your personal library.</p>
            <a href="{{ route('new-decision') }}" class="text-indigo-600 dark:text-indigo-400 font-black text-sm uppercase tracking-widest hover:underline ring-offset-8">Run your first analysis &rarr;</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-5 duration-700">
            @foreach($decisions as $decision)
                <a href="{{ route('decision.show', $decision->id) }}" 
                   class="group bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-[2.5rem] p-8 shadow-xl transition-all hover:shadow-indigo-500/5 hover:-translate-y-2 relative overflow-hidden">
                    
                    {{-- Status Indicator --}}
                    <div class="flex items-center justify-between mb-8">
                        <div class="px-3 py-1 rounded-lg {{ $decision->status === 'completed' || $decision->status === 'paid' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }} text-[10px] font-black uppercase tracking-widest">
                            {{ $decision->status === 'completed' || $decision->status === 'paid' ? 'Ready' : 'Pending Payment' }}
                        </div>
                        <span class="text-[10px] font-black text-gray-300 uppercase tracking-widst">{{ $decision->created_at->format('M j, Y') }}</span>
                    </div>

                    <h3 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight mb-4 group-hover:text-indigo-600 transition-colors leading-tight">
                        {{ $decision->main_purpose }}
                    </h3>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Category:</span>
                            <span class="text-xs font-bold text-gray-900 dark:text-white capitalize">{{ $decision->sub_purpose }}</span>
                        </div>

                        <div class="p-6 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800 group-hover:border-indigo-100 dark:group-hover:border-indigo-900/50 transition-colors">
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Recommendation</div>
                            <p class="text-sm font-bold text-gray-700 dark:text-gray-300 {{ $decision->recommendation === 'Pending...' ? 'italic' : '' }}">
                                {{ $decision->recommendation }}
                            </p>
                        </div>
                    </div>

                    {{-- Arrow Icon --}}
                    <div class="mt-8 flex justify-end">
                        <div class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-700 group-hover:bg-indigo-600 group-hover:text-white flex items-center justify-center transition-all duration-300">
                             <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
