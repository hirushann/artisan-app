<?php

use Livewire\Volt\Component;
use App\Models\Decision;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public Decision $decision;
    public $parsedResponse = [];
    public $isPendingPayment = false;

    public function mount(Decision $decision): void
    {
        $this->decision = $decision;
        
        // Handle pending payment logic
        if ($this->decision->status === 'pending_payment') {
            $this->isPendingPayment = true;
        } else {
            $this->isPendingPayment = false;
        }

        // Attempt to parse AI response if it exists and is JSON
        if ($this->decision->ai_response) {
            $decoded = json_decode($this->decision->ai_response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->parsedResponse = $decoded;
            } else {
                // Handle plain text or other format
                $this->parsedResponse = ['summary' => $this->decision->ai_response];
            }
        }
    }
    
    public function checkPayment() {
        // Refresh the model from DB in case a webhook updated it
        $this->decision->refresh();
        
        if ($this->decision->status !== 'pending_payment') {
            $this->isPendingPayment = false;
            
            // If it's paid but no report exists yet, generate it
            if (empty($this->decision->ai_response)) {
                $this->decision->generateAnalysis();
            }
        }

        // Use Livewire's redirect to reload correctly
        return $this->redirect(route('decision.show', $this->decision->id), navigate: true);
    }
        public function resumePayment() {
          $priceId = env('STRIPE_PRICE_ID'); 
          if ($priceId) {
              return redirect(Auth::user()->checkout($priceId, [
                  'success_url' => route('decision.show', ['decision' => $this->decision->id]),
                  'cancel_url' => route('dashboard'),
                  'metadata' => ['decision_id' => $this->decision->id],
              ])->url);
          }
     }
}; ?>

<<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($isPendingPayment)
        <div class="max-w-2xl mx-auto py-20 animate-in fade-in zoom-in duration-700">
            <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] p-12 shadow-2xl border border-gray-100 dark:border-gray-700 text-center relative overflow-hidden">
                {{-- Decorative Glow --}}
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-indigo-500/5 blur-3xl rounded-full"></div>
                
                 <div class="mx-auto w-20 h-20 bg-indigo-50 dark:bg-indigo-900/30 rounded-3xl flex items-center justify-center mb-8 border border-indigo-100 dark:border-indigo-800">
                     <svg class="w-10 h-10 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>
                 </div>
                 <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6 tracking-tight">Unlock Analysis</h2>
                 <p class="mb-10 text-lg text-gray-500 dark:text-gray-400 font-medium">
                    The Labs engine has processed your data. Please complete the one-time access credit to view the full report.
                 </p>
                 
                 <div class="flex flex-col gap-4">
                     <button wire:click="resumePayment" 
                             class="w-full px-8 py-5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl font-black text-lg hover:scale-[1.02] shadow-2xl transition-all duration-300">
                         Verify & Continue &rarr;
                     </button>
                     <button wire:click="checkPayment" 
                             wire:loading.attr="disabled"
                             class="w-full px-8 py-4 bg-transparent text-gray-400 hover:text-indigo-600 font-bold text-sm transition-all flex items-center justify-center gap-3">
                         <span wire:loading.remove wire:target="checkPayment">Refresh Status</span>
                         <span wire:loading wire:target="checkPayment" class="animate-spin rounded-full h-4 w-4 border-b-2 border-indigo-600"></span>
                     </button>
                 </div>
            </div>
        </div>
    @else
    <div class="space-y-12 animate-in fade-in slide-in-from-bottom-5 duration-1000">
        {{-- Navigation Bar --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
            <a href="{{ route('my-decision') }}" class="group inline-flex items-center gap-3 text-sm font-bold text-gray-400 hover:text-gray-900 dark:hover:text-white transition-all">
                <div class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-gray-800 flex items-center justify-center group-hover:bg-gray-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-gray-900 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                </div>
                Return to Lab
            </a>
    
            <div class="flex gap-3">
                <button class="px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-600 dark:text-gray-300 hover:shadow-md transition-all">
                    Share
                </button>
                <a href="{{ route('decision.pdf', $decision->id) }}" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-500/20 hover:scale-105 transition-all">
                    Download PDF
                </a>
            </div>
        </div>
    
        {{-- Hero Header --}}
        <div class="space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800">
                 <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                 <span class="text-[10px] font-black text-green-700 dark:text-green-400 uppercase tracking-widest">Report Finalized</span>
            </div>
            <h1 class="text-6xl font-black text-gray-900 dark:text-white tracking-tighter leading-none">{{ $decision->main_purpose }}</h1>
            <div class="flex flex-wrap gap-6 text-sm font-bold text-gray-400 uppercase tracking-widest">
                <span>Category: <span class="text-gray-900 dark:text-white">{{ $decision->sub_purpose }}</span></span>
                <span>Generated: <span class="text-gray-900 dark:text-white">{{ $decision->created_at->format('M j, Y') }}</span></span>
            </div>
        </div>
    
        {{-- Summary Card --}}
        <div class="bg-white dark:bg-gray-800 border-x border-t border-gray-100 dark:border-gray-700 rounded-[3rem] p-12 shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
            
            <div class="max-w-4xl">
                <h3 class="text-xs font-black text-indigo-600 mb-6 uppercase tracking-[0.3em]">AI Summary</h3>
                <p class="text-2xl font-medium text-gray-800 dark:text-gray-200 leading-relaxed mb-12">
                    {{ $parsedResponse['summary'] ?? 'Our model analyzed your criteria and options to find the optimal path forward.' }}
                </p>
        
                @if(isset($parsedResponse['recommendation']))
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-600 text-white shadow-xl shadow-indigo-500/40">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                            <span class="text-sm font-black uppercase tracking-widest">Recommended Choice</span>
                        </div>
                        <h2 class="text-5xl font-black text-gray-900 dark:text-white tracking-tight">{{ $parsedResponse['recommended_option'] ?? 'The Best Choice' }}</h2>
                        <div class="p-8 bg-gray-50 dark:bg-gray-900/50 rounded-3xl border border-gray-100 dark:border-gray-800">
                            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed italic font-medium">
                                "{{ $parsedResponse['recommendation'] }}"
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    
        {{-- Criteria Breakdown --}}
        @if(isset($parsedResponse['criteria_analysis']) && !empty($parsedResponse['criteria_analysis']))
            <div class="space-y-6">
                <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">Criterion Scores</h2>
                <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl overflow-hidden shadow-xl">
                   <div class="overflow-x-auto">
                       <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                           <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                               <tr>
                                   <th scope="col" class="px-8 py-5 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Criterion</th>
                                   @foreach($parsedResponse['options_analysis'] as $opt)
                                       <th scope="col" class="px-8 py-5 text-center text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]">{{ $opt['name'] }}</th>
                                   @endforeach
                               </tr>
                           </thead>
                           <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                               @if(is_array($parsedResponse['criteria_analysis']))
                                   @foreach($parsedResponse['criteria_analysis'] as $row)
                                       <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/10 transition-colors">
                                           <td class="px-8 py-6 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-white">
                                               {{ $row['criterion'] ?? ($row['name'] ?? 'Criterion') }}
                                           </td>
                                           @foreach($parsedResponse['options_analysis'] as $opt)
                                                @php
                                                    $score = $row['scores'][$opt['name']] ?? '-';
                                                @endphp
                                               <td class="px-8 py-6 whitespace-nowrap text-center">
                                                   <span class="text-sm font-black {{ $score > 7 ? 'text-green-600' : ($score < 5 ? 'text-red-500' : 'text-gray-900 dark:text-white') }}">
                                                       {{ $score }}<span class="text-[10px] opacity-30 ml-0.5">/10</span>
                                                   </span>
                                               </td>
                                           @endforeach
                                       </tr>
                                   @endforeach
                               @endif
                           </tbody>
                       </table>
                   </div>
                </div>
            </div>
        @endif
 
        {{-- Detailed Options Grid --}}
        @if(isset($parsedResponse['options_analysis']))
            <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">Full Analysis</h2>
        
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($parsedResponse['options_analysis'] as $option)
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-[2.5rem] p-8 shadow-xl flex flex-col h-full relative group transition-all hover:scale-[1.02]">
                        
                        @if(isset($parsedResponse['recommended_option']) && $option['name'] === $parsedResponse['recommended_option'])
                            <div class="absolute -top-3 -right-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-[10px] font-black px-4 py-2 rounded-xl shadow-lg uppercase tracking-widest z-20 scale-105">
                                Recommended
                            </div>
                        @endif
 
                        <div class="mb-6 flex justify-between items-start">
                            <h3 class="font-black text-2xl text-gray-900 dark:text-white leading-none tracking-tight">{{ $option['name'] }}</h3>
                            @if(isset($option['score']))
                                <div class="bg-indigo-50 dark:bg-indigo-900/30 px-3 py-2 rounded-2xl flex flex-col items-center">
                                    <span class="text-xl font-black text-indigo-600 dark:text-indigo-400 leading-none">{{ $option['score'] }}</span>
                                    <span class="text-[8px] font-black text-indigo-400 uppercase tracking-widest mt-1">Score</span>
                                </div>
                            @endif
                        </div>
                        
                        @if(isset($option['reasoning']))
                            <div class="mb-8 p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800 text-sm italic font-medium text-gray-500 dark:text-gray-400">
                                "{{ $option['reasoning'] }}"
                            </div>
                        @endif
 
                        <div class="space-y-8 flex-1">
                            <div class="space-y-4">
                                <h4 class="text-[10px] font-black text-green-600 uppercase tracking-[0.2em] flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                    Pros
                                </h4>
                                <ul class="space-y-3">
                                    @foreach ($option['pros'] ?? [] as $pro)
                                        <li class="flex items-start gap-3">
                                            <span class="mt-2 text-[10px] text-green-300">●</span>
                                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400 leading-snug">{{ $pro }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <div class="space-y-4">
                                <h4 class="text-[10px] font-black text-red-500 uppercase tracking-[0.2em] flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400"></div>
                                    Cons
                                </h4>
                                <ul class="space-y-3">
                                    @foreach ($option['cons'] ?? [] as $con)
                                        <li class="flex items-start gap-3">
                                            <span class="mt-2 text-[10px] text-red-300">●</span>
                                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400 leading-snug">{{ $con }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @if($decision->ai_response)
                <div class="mt-12 bg-white dark:bg-gray-800 p-12 rounded-[3rem] border border-gray-100 dark:border-gray-700 shadow-2xl">
                    <h2 class="text-xs font-black text-indigo-600 mb-8 uppercase tracking-[0.3em]">AI Raw Output</h2>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400 font-medium">
                        {!! \Illuminate\Support\Str::markdown($decision->ai_response) !!}
                    </div>
                </div>
            @endif
        @endif
    </div>
    @endif
</div>
