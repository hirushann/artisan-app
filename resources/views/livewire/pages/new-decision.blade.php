<?php

use Livewire\Volt\Component;
use Prism\Prism\Prism;
use App\Models\Decision;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public string $category = 'personal';
    public string $selectedDecision = ''; // Title of selected card
    public string $customDecision = '';   // Custom input if "Other" is selected
    public string $reportType = 'detailed';

    // Criteria for decision making
    public array $criteria = [
        ['id' => 1, 'name' => 'Cost', 'weight' => 10],
        ['id' => 2, 'name' => 'Long-term Benefit', 'weight' => 8],
    ];

    // List of option objects
    public array $options = [
        ['id' => 1, 'name' => '', 'pros' => [''], 'cons' => ['']]
    ];

    // Static data for categories
    public array $personalOptions = [
        ['id' => 'vehicle', 'title' => 'Buy a vehicle', 'description' => 'Best for small purchases and personal use.', 'icon' => 'truck'],
        ['id' => 'house', 'title' => 'Buy a house', 'description' => 'Good for long-term personal investment.', 'icon' => 'home'],
        ['id' => 'career', 'title' => 'Career Change', 'description' => 'Evaluating a new job or career path.', 'icon' => 'briefcase'],
        ['id' => 'mobile', 'title' => 'New mobile', 'description' => 'Choosing a new smartphone or device.', 'icon' => 'device-phone-mobile'],
        ['id' => 'internet', 'title' => 'New internet line', 'description' => 'Picking the best ISP for home internet.', 'icon' => 'wifi'],
        ['id' => 'pet', 'title' => 'New pet', 'description' => 'Adopting a pet for companionship.', 'icon' => 'heart'],
        ['id' => 'gadget', 'title' => 'Buy something new', 'description' => 'Selecting a gadget, appliance, or accessory.', 'icon' => 'shopping-bag'],
        ['id' => 'other', 'title' => 'Other', 'description' => 'Custom decision.', 'icon' => 'pencil'],
    ];

    public function mount() {
        // Ensure at least two options for valid comparison
        if (count($this->options) < 2) {
             $this->options[] = ['id' => 2, 'name' => '', 'pros' => [''], 'cons' => ['']];
        }
    }

    public function addOption()
    {
        $newId = count($this->options) > 0 ? max(array_column($this->options, 'id')) + 1 : 1;
        $this->options[] = ['id' => $newId, 'name' => '', 'pros' => [''], 'cons' => ['']];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function addPro($index)
    {
        $this->options[$index]['pros'][] = '';
    }

    public function addCon($index)
    {
        $this->options[$index]['cons'][] = '';
    }

    public function addCriteria()
    {
        $newId = count($this->criteria) > 0 ? max(array_column($this->criteria, 'id')) + 1 : 1;
        $this->criteria[] = ['id' => $newId, 'name' => '', 'weight' => 5];
    }

    public function removeCriteria($index)
    {
        unset($this->criteria[$index]);
        $this->criteria = array_values($this->criteria);
    }

    // AI Autofill for a specific option
    public function autofillOption($index)
    {
        $optionName = $this->options[$index]['name'];
        $context = $this->customDecision ? $this->customDecision : $this->selectedDecision;

        if (empty($optionName)) {
            return;
        }

        // Build criteria string
        $criteriaStr = "";
        foreach ($this->criteria as $c) {
            if (!empty($c['name'])) {
                $criteriaStr .= "- {$c['name']} (Importance: {$c['weight']}/10)\n";
            }
        }

        $prompt = "I am making a decision about: '{$context}'.
        
        One of my options is '{$optionName}'.
        
        Please list 3 pros and 3 cons for this specific option.
        
        IMPORTANT: Consider the following decision criteria when generating pros and cons:
        {$criteriaStr}
        
        Return ONLY valid JSON in this format:
        { \"pros\": [\"pro1\", \"pro2\", \"pro3\"], \"cons\": [\"con1\", \"con2\", \"con3\"] }";

        $response = Prism::text()
            ->using('openai', 'gpt-4o')
            ->withPrompt($prompt)
            ->generate();

        // Extract JSON from response
        $json = $response->text;
        $json = preg_replace('/^```json\s*|\s*```$/', '', $json); 
        $data = json_decode($json, true);

        if ($data) {
            $this->options[$index]['pros'] = $data['pros'] ?? [''];
            $this->options[$index]['cons'] = $data['cons'] ?? [''];
        }
    }

    public function submitDecision()
    {
        $this->validate([
            'selectedDecision' => 'required',
            'options' => 'required|array|min:2',
            'options.*.name' => 'required|string',
            'criteria.*.name' => 'required|string',
        ]);

        $title = $this->selectedDecision === 'Other' ? $this->customDecision : $this->selectedDecision;

        // Create Decision
        $decision = new Decision();
        $decision->user_id = Auth::id();
        $decision->main_purpose = $title;
        $decision->sub_purpose = ucfirst($this->category);
        
        // Store structured data including criteria
        $decisionData = [
            'criteria' => $this->criteria,
            'options' => $this->options
        ];
        $decision->options = json_encode($decisionData);
        
        $decision->report_type = $this->reportType;
        $decision->save();

        // Generate AI Analysis immediately
        $this->generateAnalysis($decision);

        return redirect()->route('decision.show', ['decision' => $decision->id]);
    }

    public function generateAnalysis(Decision $decision)
    {
        $data = json_decode($decision->options, true);
        // Handle backward compatibility if strictly array of options
        $optionsData = isset($data['options']) ? $data['options'] : $data;
        $criteriaData = isset($data['criteria']) ? $data['criteria'] : [];

        $prompt = "I need a {$decision->report_type} decision report for '{$decision->main_purpose}'.\n\n";
        
        if (!empty($criteriaData)) {
            $prompt .= "The decision is based on these Weighted Criteria:\n";
            foreach ($criteriaData as $c) {
                $prompt .= "- {$c['name']} (Weight: {$c['weight']}/10)\n";
            }
            $prompt .= "\n";
        }

        foreach ($optionsData as $opt) {
            $prompt .= "Option: {$opt['name']}\n";
            $prompt .= "Pros: " . implode(', ', $opt['pros']) . "\n";
            $prompt .= "Cons: " . implode(', ', $opt['cons']) . "\n\n";
        }

        $prompt .= "Provide a JSON response with the following structure:
        {
            \"summary\": \"Overall summary of the decision context.\",
            \"criteria_analysis\": [
                {
                    \"criterion\": \"Criterion Name\",
                    \"scores\": {
                        \"Option Name 1\": 8, // Score 1-10
                        \"Option Name 2\": 6
                    }
                }
            ],
            \"options_analysis\": [
                {
                    \"name\": \"Option Name\",
                    \"pros\": [\"Expanded Pro 1\", \"...\"],
                    \"cons\": [\"Expanded Con 1\", \"...\"],
                    \"score\": 85, // Calculated total weighted score out of 100
                    \"reasoning\": \"Why this score?\"
                }
            ],
            \"recommended_option\": \"Exact Name of Best Option\",
            \"recommendation\": \"Detailed reasoning for the recommendation, referencing the criteria weights.\"
        }";

        $response = Prism::text()
            ->using('openai', 'gpt-4o')
            ->withPrompt($prompt)
            ->generate();
        
        $json = $response->text;
        $json = preg_replace('/^```json\s*|\s*```$/', '', $json);

        $decision->ai_response = $json;
        $decision->save();
    }
};
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Start a New Decision</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Select a category and define your options to get AI-powered insights.</p>
    </div>

    <!-- Category Tabs -->
    <div class="flex space-x-1 bg-gray-100 dark:bg-gray-800 p-1 rounded-xl w-fit mb-8">
        @foreach(['personal', 'business', 'family'] as $cat)
            <button wire:click="$set('category', '{{ $cat }}')"
                    class="px-6 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 capitalize
                           {{ $category === $cat 
                              ? 'bg-white dark:bg-gray-700 text-orange-600 shadow-sm' 
                              : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                {{ $cat }}
            </button>
        @endforeach
    </div>

    <!-- Decision Type Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @foreach($personalOptions as $option)
            <div wire:click="$set('selectedDecision', '{{ $option['title'] }}')"
                 class="relative group cursor-pointer rounded-xl border-2 p-4 transition-all duration-200
                        {{ $selectedDecision === $option['title'] 
                           ? 'border-orange-500 bg-orange-50 dark:bg-orange-900/20' 
                           : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-orange-300' }}">
                
                <div class="flex items-center gap-3 mb-2">
                    {{-- Simple Icons based on ID --}}
                    <div class="p-2 rounded-lg {{ $selectedDecision === $option['title'] ? 'bg-orange-100 text-orange-600' : 'bg-gray-100 text-gray-500 group-hover:bg-orange-50 group-hover:text-orange-500' }} transition-colors">
                        @if($option['id'] === 'vehicle') <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                        @elseif($option['id'] === 'house') <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        @elseif($option['id'] === 'career') <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        @elseif($option['id'] === 'other') <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        @else <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @endif
                    </div>
                    <div class="font-semibold text-sm text-gray-900 dark:text-gray-100 leading-tight">
                        {{ $option['title'] }}
                    </div>
                </div>

                @if($option['id'] === 'other' && $selectedDecision === 'Other')
                    <input type="text" 
                           class="mt-2 text-sm w-full border-0 border-b border-orange-300 focus:border-orange-500 focus:ring-0 bg-transparent px-0 py-1"
                           placeholder="What are you deciding?" 
                           wire:model.live="customDecision" autofocus />
                @endif
            </div>
        @endforeach
    </div>

    @if($customDecision || ($selectedDecision && $selectedDecision !== 'Other'))
        <div class="space-y-8 animate-fade-in-up">
            
            {{-- CRITERIA PANEL --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/50 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white">Decision Criteria</h3>
                        <p class="text-xs text-gray-500">Define what matters most.</p>
                    </div>
                    <button wire:click="addCriteria" class="text-xs font-semibold text-orange-600 hover:text-orange-700 hover:bg-orange-50 px-3 py-1.5 rounded-lg transition">
                        + Add Criterion
                    </button>
                </div>
                
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($criteria as $index => $c)
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-100 dark:border-gray-700 relative group">
                            <button wire:click="removeCriteria({{ $index }})" class="absolute top-2 right-2 text-gray-300 hover:text-red-500 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</label>
                                    <input type="text" wire:model.live="criteria.{{ $index }}.name" 
                                           class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-md text-sm focus:ring-orange-500 focus:border-orange-500"
                                           placeholder="e.g. Cost">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</label>
                                        <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded">{{ $c['weight'] }}</span>
                                    </div>
                                    <input type="range" min="1" max="10" wire:model.live="criteria.{{ $index }}.weight" 
                                           class="w-full h-1.5 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-orange-500">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- OPTIONS & COMPARISON --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Compare Options</h3>
                    <button wire:click="addOption" class="flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-orange-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add Option
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($options as $index => $opt)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col h-full relative group">
                            
                            {{-- Card Header --}}
                            <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex items-start gap-4">
                                <span class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-500 font-bold text-sm">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1">
                                    <input type="text" wire:model.live="options.{{ $index }}.name" 
                                           class="w-full border-0 p-0 text-lg font-bold text-gray-900 dark:text-white placeholder-gray-300 focus:ring-0 bg-transparent"
                                           placeholder="Option Name...">
                                </div>
                                <button wire:click="removeOption({{ $index }})" class="text-gray-300 hover:text-red-500 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-5 flex-1 flex flex-col gap-6">
                                {{-- AI Action --}}
                                <div class="flex justify-end">
                                    <button wire:click="autofillOption({{ $index }})" 
                                            wire:loading.attr="disabled"
                                            class="text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-full transition flex items-center gap-1.5">
                                        <span wire:loading.remove wire:target="autofillOption({{ $index }})">✨ AI Autofill Pros/Cons</span>
                                        <span wire:loading wire:target="autofillOption({{ $index }})" class="flex items-center gap-1">
                                            <svg class="animate-spin w-3 h-3" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            Thinking...
                                        </span>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 h-full">
                                    {{-- Pros --}}
                                    <div class="space-y-2">
                                        <h5 class="text-xs font-bold text-green-600 uppercase tracking-widest flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            Pros
                                        </h5>
                                        <div class="space-y-2">
                                            @foreach($opt['pros'] as $pIndex => $pro)
                                                <div class="flex items-start gap-2 group/item">
                                                    <div class="mt-2 w-1.5 h-1.5 rounded-full bg-green-400 flex-shrink-0"></div>
                                                    <textarea wire:model.live="options.{{ $index }}.pros.{{ $pIndex }}" 
                                                              rows="1" 
                                                              class="flex-1 text-sm border-gray-200 dark:border-gray-700 dark:bg-gray-900 rounded-md focus:border-green-500 focus:ring-green-500 resize-none overflow-hidden min-h-[38px]"
                                                              placeholder="Add a benefit..."></textarea>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button wire:click="addPro({{ $index }})" class="text-xs text-gray-400 hover:text-green-600 font-medium ml-3.5">+ Add</button>
                                    </div>

                                    {{-- Cons --}}
                                    <div class="space-y-2">
                                        <h5 class="text-xs font-bold text-red-600 uppercase tracking-widest flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Cons
                                        </h5>
                                        <div class="space-y-2">
                                            @foreach($opt['cons'] as $cIndex => $con)
                                                <div class="flex items-start gap-2 group/item">
                                                    <div class="mt-2 w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></div>
                                                    <textarea wire:model.live="options.{{ $index }}.cons.{{ $cIndex }}" 
                                                              rows="1"
                                                              class="flex-1 text-sm border-gray-200 dark:border-gray-700 dark:bg-gray-900 rounded-md focus:border-red-500 focus:ring-red-500 resize-none overflow-hidden min-h-[38px]"
                                                              placeholder="Add a drawback..."></textarea>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button wire:click="addCon({{ $index }})" class="text-xs text-gray-400 hover:text-red-600 font-medium ml-3.5">+ Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- FOOTER / SUBMIT --}}
            <div class="pt-8 border-t border-gray-200 dark:border-gray-700 mt-12 flex flex-col sm:flex-row justify-between items-center gap-6">
                
                {{-- Report Style --}}
                <div class="flex items-center gap-6 text-sm">
                    <span class="text-gray-500 font-medium">Report Type:</span>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="reportType" value="detailed" wire:model.live="reportType" class="text-orange-600 focus:ring-orange-500">
                        <span class="text-gray-700 dark:text-gray-300">Detailed Analysis</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="reportType" value="summarized" wire:model.live="reportType" class="text-orange-600 focus:ring-orange-500">
                        <span class="text-gray-700 dark:text-gray-300">Quick Summary</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button wire:click="submitDecision" 
                        wire:loading.attr="disabled"
                        class="bg-gray-900 dark:bg-white dark:text-gray-900 text-white hover:bg-gray-800 dark:hover:bg-gray-100 text-base font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                    <span wire:loading.remove wire:target="submitDecision">Create Decision</span>
                    <span wire:loading wire:target="submitDecision" class="flex items-center gap-2">
                         <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Analysing...
                    </span>
                </button>
            </div>
        </div>
    @endif
</div>
