<?php

use Livewire\Volt\Component;
use App\Models\Decision;
use Illuminate\Support\Carbon;

new class extends Component {
    public Decision $decision;
    public $parsedResponse = [];

    public function mount(Decision $decision): void
    {
        $this->decision = $decision;
        
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
}; ?>

<div>
    <div class="space-y-6 max-w-6xl mx-auto p-4">
        {{-- Header Actions --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <a href="{{ route('my-decision') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 w-fit transition">
                <svg class="mr-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Reports
            </a>
    
            <div class="flex gap-2">
                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                    <svg class="mr-2 h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16M4 8h16M4 16h16" /></svg>
                    Share
                </button>
                <a href="{{ route('decision.pdf', $decision->id) }}" class="inline-flex items-center px-4 py-2 border border-blue-200 text-blue-700 bg-blue-50 rounded-lg text-sm font-medium hover:bg-blue-100 transition">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" /></svg>
                    Download PDF
                </a>
            </div>
        </div>
    
        {{-- Title Area --}}
        <div class="space-y-2">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $decision->main_purpose }}</h1>
            <div class="flex flex-wrap gap-3 text-sm">
                <div class="bg-gray-100 dark:bg-gray-700 dark:text-gray-300 px-2.5 py-1 rounded-md">
                    Category: <span class="font-medium text-gray-900 dark:text-white">{{ $decision->sub_purpose }}</span>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 dark:text-gray-300 px-2.5 py-1 rounded-md">
                    Date: <span class="font-medium text-gray-900 dark:text-white">{{ $decision->created_at->format('F j, Y') }}</span>
                </div>
            </div>
        </div>
    
        {{-- Summary & Recommendation --}}
        <div class="border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 shadow-sm p-6">
            <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Decision Summary</h3>
            <p class="text-gray-600 dark:text-gray-400">
                {{ $parsedResponse['summary'] ?? 'Analysis based on your provided options and criteria.' }}
            </p>
    
            @if(isset($parsedResponse['recommendation']))
                <div class="mt-6">
                    <h3 class="font-semibold text-lg mb-2 text-gray-900 dark:text-white">Recommendation</h3>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                        <p class="font-medium text-green-800 dark:text-green-300">
                            {{ $parsedResponse['recommended_option'] ?? 'Best Option' }}
                        </p>
                        <p class="text-green-700 dark:text-green-400 mt-2">
                            {{ $parsedResponse['recommendation'] }}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    
        {{-- Criteria Analysis (New Feature) --}}
        @if(isset($parsedResponse['criteria_analysis']) && !empty($parsedResponse['criteria_analysis']))
            <h2 class="text-2xl font-bold mt-8 text-gray-900 dark:text-white">Criteria Breakdown</h2>
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden shadow-sm mt-4">
               <div class="overflow-x-auto">
                   <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                       <thead class="bg-gray-50 dark:bg-gray-700/50">
                           <tr>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                               @foreach($parsedResponse['options_analysis'] as $opt)
                                   <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $opt['name'] }}</th>
                               @endforeach
                           </tr>
                       </thead>
                       <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                           {{-- Assuming criteria_analysis is an array of objects like {criterion: 'Cost', scores: {'Option A': 8, 'Option B': 5}} --}}
                           {{-- OR simpler: let's rely on the AI structure. I'll make the view flexible. --}}
                           @if(is_array($parsedResponse['criteria_analysis']))
                               @foreach($parsedResponse['criteria_analysis'] as $row)
                                   <tr>
                                       <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                           {{ $row['criterion'] ?? ($row['name'] ?? 'Criterion') }}
                                       </td>
                                       @foreach($parsedResponse['options_analysis'] as $opt)
                                            {{-- Try to find score for this option in this row --}}
                                            @php
                                                $score = '-';
                                                // Flexible parsing depending on how AI structured it. 
                                                // Ideally: $row['scores'][$opt['name']]
                                                if (isset($row['scores']) && isset($row['scores'][$opt['name']])) {
                                                    $score = $row['scores'][$opt['name']];
                                                }
                                            @endphp
                                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                               {{ $score }}/10
                                           </td>
                                       @endforeach
                                   </tr>
                               @endforeach
                           @endif
                       </tbody>
                   </table>
               </div>
            </div>
        @endif

        {{-- Options Analysis --}}
        @if(isset($parsedResponse['options_analysis']))
            <h2 class="text-2xl font-bold mt-8 text-gray-900 dark:text-white">Options Analysis</h2>
        
            <div class="grid gap-6 md:grid-cols-3 mt-4">
                @foreach ($parsedResponse['options_analysis'] as $option)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm bg-white dark:bg-gray-800 flex flex-col h-full relative overflow-hidden group hover:border-orange-200 transition">
                        {{-- Highlight Recommended --}}
                        @if(isset($parsedResponse['recommended_option']) && $option['name'] === $parsedResponse['recommended_option'])
                            <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-bl-xl shadow-sm z-10">
                                Recommended
                            </div>
                            <div class="absolute inset-0 border-2 border-green-500 rounded-xl pointer-events-none opacity-50"></div>
                        @endif

                        <div class="mb-4 flex justify-between items-start">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">{{ $option['name'] }}</h3>
                            @if(isset($option['score']))
                                <div class="flex flex-col items-end">
                                    <span class="text-2xl font-black text-[#F97316]">{{ $option['score'] }}</span>
                                    <span class="text-xs text-gray-500 uppercase font-bold">Score</span>
                                </div>
                            @endif
                        </div>
                        
                        @if(isset($option['reasoning']))
                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-300 italic bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                                "{{ $option['reasoning'] }}"
                            </div>
                        @endif

                        <div class="mb-4 flex-1">
                            <h4 class="font-bold text-green-700 dark:text-green-400 mb-2 flex items-center gap-1 text-sm uppercase tracking-wide">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                Pros
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                @foreach ($option['pros'] ?? [] as $pro)
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-green-400 flex-shrink-0"></span>
                                        <span>{{ $pro }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-red-700 dark:text-red-400 mb-2 flex items-center gap-1 text-sm uppercase tracking-wide">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" /></svg>
                                Cons
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                @foreach ($option['cons'] ?? [] as $con)
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>
                                        <span>{{ $con }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Fallback / raw response view --}}
            @if($decision->ai_response)
                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">AI Analysis</h2>
                    <div class="prose dark:prose-invert max-w-none bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                        {!! \Illuminate\Support\Str::markdown($decision->ai_response) !!}
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
