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
            ->using('gemini', 'gemini-flash-latest')
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
        $decision->status = 'pending_payment'; // Set initial status
        $decision->save();

        // Redirect to Stripe Checkout
        $priceId = env('STRIPE_PRICE_ID'); 
        
        if (!$priceId) {
            session()->flash('error', 'Stripe Price ID missing. Please add STRIPE_PRICE_ID to your .env file.');
            return redirect()->route('dashboard');
        }

        return redirect(Auth::user()->checkout($priceId, [
            'success_url' => route('decision.show', ['decision' => $decision->id]),
            'cancel_url' => route('dashboard'),
            'metadata' => ['decision_id' => $decision->id],
        ])->url);
    }

};
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <style>
        .animate-pulse {
            animation: labs-pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes labs-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
    {{-- Labs-style Header --}}
    <div class="mb-12 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 mb-6 group transition-all hover:scale-105">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
            <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Google Labs Inspired</span>
        </div>
        <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">How can <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">AI help</span> you decide?</h1>
        <p class="text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto font-medium">Define your options and let our advanced models handle the analysis.</p>
    </div>

    {{-- Category Tabs --}}
    <div class="flex justify-center mb-12">
        <div class="inline-flex p-1 bg-gray-100 dark:bg-gray-800/50 rounded-2xl border border-gray-200 dark:border-gray-700">
            @foreach(['personal', 'business', 'family'] as $cat)
                <button wire:click="$set('category', '{{ $cat }}')"
                        class="px-8 py-3 rounded-xl text-sm font-semibold transition-all duration-300 capitalize
                               {{ $category === $cat 
                                  ? 'bg-white dark:bg-gray-700 text-indigo-600 dark:text-gray-100 shadow-xl scale-105 ring-1 ring-gray-100' 
                                  : 'text-gray-400 dark:text-gray-500 hover:text-gray-900 dark:hover:text-gray-300' }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- Decision Type Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        @foreach($personalOptions as $option)
            <div wire:click="$set('selectedDecision', '{{ $option['title'] }}')"
                 class="relative overflow-hidden group cursor-pointer rounded-3xl border p-6 transition-all duration-500
                        {{ $selectedDecision === $option['title'] 
                           ? 'border-indigo-500 bg-white dark:bg-gray-800 shadow-2xl scale-[1.02]' 
                           : 'border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50 hover:bg-white dark:hover:bg-gray-800 hover:border-gray-300 hover:shadow-lg' }}">
                
                {{-- Background Glow --}}
                @if($selectedDecision === $option['title'])
                    <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-500/10 blur-3xl rounded-full"></div>
                @endif

                <div class="flex flex-col gap-4">
                    <div class="p-3 w-fit rounded-2xl {{ $selectedDecision === $option['title'] ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'bg-white dark:bg-gray-800 text-gray-400 group-hover:text-indigo-500 border border-gray-100 dark:border-gray-700' }} transition-all duration-300">
                        @if($option['id'] === 'vehicle') <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                        @elseif($option['id'] === 'house') <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        @elseif($option['id'] === 'career') <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        @elseif($option['id'] === 'other') <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        @else <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @endif
                    </div>
                    <div>
                        <div class="font-bold text-lg text-gray-900 dark:text-gray-100 tracking-tight">
                            {{ $option['title'] }}
                        </div>
                        <p class="text-xs text-gray-400 mt-1">{{ $option['description'] }}</p>
                    </div>
                </div>

                @if($option['id'] === 'other' && $selectedDecision === 'Other')
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <input type="text" 
                               class="w-full border-0 p-0 text-sm font-medium focus:ring-0 bg-transparent text-indigo-600 placeholder-gray-300"
                               placeholder="What are you deciding?" 
                               wire:model.live="customDecision" autofocus />
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @if($customDecision || ($selectedDecision && $selectedDecision !== 'Other'))
        <div class="space-y-12 animate-in fade-in slide-in-from-bottom-5 duration-700">
            
            {{-- CRITERIA PANEL --}}
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden group">
                <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-900/30 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white">Decision Criteria</h3>
                            <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">Weighted Factors</p>
                        </div>
                    </div>
                    <button wire:click="addCriteria" class="px-5 py-2 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all duration-300">
                        + Add Factor
                    </button>
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($criteria as $index => $c)
                        <div class="bg-gray-50/50 dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-800 relative group/item transition-all hover:bg-white dark:hover:bg-gray-800 hover:shadow-xl">
                            <button wire:click="removeCriteria({{ $index }})" class="absolute top-4 right-4 text-gray-300 hover:text-red-500 opacity-0 group-hover/item:opacity-100 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Criterion Name</label>
                                    <input type="text" wire:model.live="criteria.{{ $index }}.name" 
                                           class="w-full mt-2 border-0 p-0 bg-transparent text-lg font-bold placeholder-gray-200 dark:placeholder-gray-700 focus:ring-0 text-gray-900 dark:text-white"
                                           placeholder="e.g. Budget">
                                </div>
                                <div>
                                    <div class="flex justify-between items-end mb-3">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Importance Weight</label>
                                        <span class="text-sm font-black text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg">{{ $c['weight'] }}</span>
                                    </div>
                                    <input type="range" min="1" max="10" wire:model.live="criteria.{{ $index }}.weight" 
                                           class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- OPTIONS & COMPARISON --}}
            <div class="space-y-6">
                <div class="flex items-center justify-between px-2">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        Compare Options
                    </h3>
                    <button wire:click="addOption" class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-all flex items-center gap-2">
                        + New Option
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($options as $index => $opt)
                        <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-2xl border border-gray-200 dark:border-gray-700 flex flex-col h-full relative group transition-all duration-500 hover:shadow-indigo-500/5">
                            
                            {{-- Card Header --}}
                            <div class="p-8 pb-4 flex items-start gap-5">
                                <span class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-2xl bg-gray-50 dark:bg-gray-900/50 text-indigo-600 font-black text-lg border border-gray-100 dark:border-gray-700">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[.2em] mb-1 block">Option Title</label>
                                    <input type="text" wire:model.live="options.{{ $index }}.name" 
                                           class="w-full border-0 p-0 text-2xl font-extrabold text-gray-900 dark:text-white placeholder-gray-200 dark:placeholder-gray-700 focus:ring-0 bg-transparent"
                                           placeholder="e.g. Tesla Model 3">
                                </div>
                                <button wire:click="removeOption({{ $index }})" class="mt-2 text-gray-200 hover:text-red-500 transition-all duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-8 pt-4 flex-1 flex flex-col gap-8">
                                {{-- AI Action --}}
                                <div class="flex">
                                    <button wire:click="autofillOption({{ $index }})" 
                                            wire:loading.attr="disabled"
                                            class="inline-flex items-center gap-2.5 px-6 py-3 rounded-2xl bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 font-bold text-sm transition-all hover:bg-indigo-600 hover:text-white group/btn">
                                        
                                        <div wire:loading.remove wire:target="autofillOption({{ $index }})" class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-indigo-500 group-hover/btn:text-white animation-pulse" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2"/>
                                                <path d="M12 7V17M7 12H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent group-hover/btn:text-white">Autofill with Gemini</span>
                                        </div>

                                        <span wire:loading wire:target="autofillOption({{ $index }})" class="flex items-center gap-3">
                                            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            Consulting Labs...
                                        </span>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 h-full">
                                    {{-- Pros --}}
                                    <div class="space-y-4">
                                        <h5 class="flex items-center gap-2 text-[10px] font-black text-green-600 uppercase tracking-widest">
                                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                            Pros
                                        </h5>
                                        <div class="space-y-3">
                                            @foreach($opt['pros'] as $pIndex => $pro)
                                                <div class="flex items-center gap-3 p-1 rounded-xl hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-all">
                                                    <textarea wire:model.live="options.{{ $index }}.pros.{{ $pIndex }}" 
                                                              rows="1" 
                                                              class="flex-1 text-sm border-0 p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl focus:ring-2 focus:ring-green-500 text-gray-700 dark:text-gray-300 resize-none"
                                                              placeholder="Benefit..."></textarea>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button wire:click="addPro({{ $index }})" class="text-xs font-bold text-green-600/60 hover:text-green-600 ml-4 transition-all">+ Add Pro</button>
                                    </div>

                                    {{-- Cons --}}
                                    <div class="space-y-4">
                                        <h5 class="flex items-center gap-2 text-[10px] font-black text-red-500 uppercase tracking-widest">
                                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                            Cons
                                        </h5>
                                        <div class="space-y-3">
                                            @foreach($opt['cons'] as $cIndex => $con)
                                                <div class="flex items-center gap-3 p-1 rounded-xl hover:bg-red-50/50 dark:hover:bg-red-900/10 transition-all">
                                                    <textarea wire:model.live="options.{{ $index }}.cons.{{ $cIndex }}" 
                                                              rows="1"
                                                              class="flex-1 text-sm border-0 p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl focus:ring-2 focus:ring-red-500 text-gray-700 dark:text-gray-300 resize-none"
                                                              placeholder="Drawback..."></textarea>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button wire:click="addCon({{ $index }})" class="text-xs font-bold text-red-500/60 hover:text-red-500 ml-4 transition-all">+ Add Con</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- FOOTER / SUBMIT --}}
            <div class="pt-12 border-t border-gray-100 dark:border-gray-800 flex flex-col items-center gap-10">
                
                {{-- Report Style --}}
                <div class="flex flex-wrap items-center justify-center gap-8">
                    <span class="text-sm font-black text-gray-400 uppercase tracking-widest">Analysis Type</span>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="reportType" value="detailed" wire:model.live="reportType" class="w-5 h-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-700 dark:bg-gray-800">
                            <span class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-indigo-600">Deep Labs Report</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="reportType" value="summarized" wire:model.live="reportType" class="w-5 h-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-700 dark:bg-gray-800">
                            <span class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-indigo-600">Quick Byte</span>
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <button wire:click="submitDecision" 
                        wire:loading.attr="disabled"
                        class="relative group px-16 py-5 rounded-[2rem] bg-gray-900 dark:bg-white overflow-hidden shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95">
                    
                    {{-- Button Glow Effect --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative flex items-center justify-center gap-3">
                        <span wire:loading.remove wire:target="submitDecision" class="text-lg font-black text-white dark:text-gray-900 tracking-tight">Run Analysis</span>
                        <div wire:loading.remove wire:target="submitDecision" class="w-6 h-6 rounded-full bg-indigo-500 flex items-center justify-center group-hover:bg-white group-hover:text-indigo-600 transition-all">
                            <svg class="w-4 h-4 text-white group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>

                        <span wire:loading wire:target="submitDecision" class="flex items-center gap-3 text-white dark:text-gray-900 font-black">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Initializing Labs...
                        </span>
                    </div>
                </button>
            </div>
        </div>
    @endif
</div>
v>
