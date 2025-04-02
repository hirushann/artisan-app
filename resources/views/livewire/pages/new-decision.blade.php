<?php

use Livewire\Volt\Component;
use Prism\Prism\Prism;

new class extends Component {
    public string $option1 = '';
    public string $option2 = '';
    public ?string $option1Pros = null;
    public ?string $option1Cons = null;
    public ?string $option2Pros = null;
    public ?string $option2Cons = null;
    public string $reportType = 'summary';

    public string $answer = '';
    public string $question = '';

    public function submitPrompt()
    {
        $prompt = "Compare the following two options and help me decide which is better. Provide a {$this->reportType} report.\n\n";

        $prompt .= "Option 1: {$this->option1}\n";
        if ($this->option1Pros) {
            $prompt .= "Pros of Option 1: {$this->option1Pros}\n";
        }
        if ($this->option1Cons) {
            $prompt .= "Cons of Option 1: {$this->option1Cons}\n";
        }

        $prompt .= "\nOption 2: {$this->option2}\n";
        if ($this->option2Pros) {
            $prompt .= "Pros of Option 2: {$this->option2Pros}\n";
        }
        if ($this->option2Cons) {
            $prompt .= "Cons of Option 2: {$this->option2Cons}\n";
        }

        $prompt .= "\nGive me a recommendation.";

        $this->question = $prompt;
        $this->answer = '';
        $this->js('$wire.ask()');
    }

    public function ask()
    {
        $stream = Prism::text()->using('openai', 'gpt-4o')->withPrompt($this->question)->asStream();

        foreach ($stream as $chunk) {
            $this->stream(to: 'answer', content: $chunk->text);
            $this->answer .= $chunk->text;
        }
    }
};
?>

<div class="w-full p-6 space-y-6 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-center text-primary-600">🤖 Option Comparison</h2>

    @if (!$question)
        <form wire:submit="submitPrompt" class="space-y-6 w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input label="Option 1" wire:model.defer="option1" placeholder="Enter first option" />
                    <div class="flex gap-4 w-full">
                        <x-textarea label="Pros for Option 1 (optional)" wire:model.defer="option1Pros"
                            placeholder="List pros..." />
                        <x-textarea label="Cons for Option 1 (optional)" wire:model.defer="option1Cons"
                            placeholder="List cons..." />
                    </div>
                </div>

                <div>
                    <x-input label="Option 2" wire:model.defer="option2" placeholder="Enter second option" />
                    <div class="flex gap-4 w-full">
                        <x-textarea label="Pros for Option 2 (optional)" wire:model.defer="option2Pros"
                            placeholder="List pros..." />
                        <x-textarea label="Cons for Option 2 (optional)" wire:model.defer="option2Cons"
                            placeholder="List cons..." />
                    </div>
                </div>
            </div>


            <x-select label="Report Type" placeholder="Select report type" wire:model="reportType" :options="[['name' => 'Summary', 'id' => 'summary'], ['name' => 'Detailed', 'id' => 'detailed']]"
                option-label="name" option-value="id" class="pb-8" />

            <x-button type="submit" icon="arrow-right-circle" class="w-full justify-center" primary
                spinner="submitPrompt" label="Compare Options" />
        </form>
    @endif

    @if ($question)
        <x-card title="AI Recommendation:" rounded="sm">
            <div wire:stream="answer" class="whitespace-pre-wrap text-sm p-5">{{ $answer }}</div>
        </x-card>
    @endif
</div>


{{-- <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="md:col-span-1">
                <div class="sticky top-24">
                    <h2 class="text-xl font-medium mb-4">Category</h2>
                    <div class="space-y-4">
                        <template x-for="option in ['personal', 'business', 'family']" :key="option">
                            <div class="flex items-start space-x-2">
                                <input type="radio" :id="option" name="category" x-model="category"
                                    :value="option" class="mt-1">
                                <div class="grid gap-1">
                                    <label :for="option" class="font-medium capitalize"
                                        x-text="option"></label>
                                    <span class="text-sm text-gray-500">Some helpful instruction goes here.</span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-show="category === 'personal'">
                    <template x-for="option in personalOptions" :key="option.id">
                        <div class="border rounded-lg cursor-pointer hover:border-[#F97316] p-6 transition"
                            :class="{
                                'border-[#F97316]': (option.id === 'other' && customDecision) || selectedDecision ===
                                    option.title
                            }"
                            @click="option.id !== 'other' ? selectedDecision = option.title : null">
                            <h3 class="font-medium text-lg" x-text="option.title"></h3>
                            <p class="text-sm text-gray-500" x-text="option.description"></p>
                            <template x-if="option.id === 'other'">
                                <div class="mt-3 flex items-center gap-2">
                                    <input type="text" class="border border-dashed rounded p-2 w-full"
                                        placeholder="Decision is about" x-model="customDecision" />
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536M9 13l3 3 8-8M5 21h4l10-10-4-4L5 17v4z" />
                                    </svg>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="customDecision || selectedDecision" class="mt-12">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold">Options</h2>
                <div class="flex justify-center items-center gap-4 mt-2">
                    <div class="h-px w-24 bg-gray-300"></div>
                    <span class="text-[#F97316] font-semibold">with</span>
                    <div class="h-px w-24 bg-gray-300"></div>
                </div>
                <h3 class="text-4xl font-bold mt-2">Pros & Cons</h3>
            </div>

            <template x-for="(opt, index) in options" :key="opt.id">
                <div class="border p-6 rounded mb-8">
                    <h4 class="text-lg text-[#F97316] mb-4">Option .<span x-text="index + 1"></span></h4>
                    <input type="text" class="w-full p-2 border rounded mb-4" placeholder="Enter an option"
                        x-model="opt.name">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h5 class="font-medium mb-2">Pros</h5>
                            <template x-for="(pro, pi) in opt.pros" :key="pi">
                                <textarea class="w-full border rounded p-2 mb-2" x-model="opt.pros[pi]" placeholder="Enter pro"></textarea>
                            </template>
                            <button class="text-[#F97316] text-sm" @click="addPro(index)">+ Add another pro</button>
                        </div>
                        <div>
                            <h5 class="font-medium mb-2">Cons</h5>
                            <template x-for="(con, ci) in opt.cons" :key="ci">
                                <textarea class="w-full border rounded p-2 mb-2" x-model="opt.cons[ci]" placeholder="Enter con"></textarea>
                            </template>
                            <button class="text-[#F97316] text-sm" @click="addCon(index)">+ Add another con</button>
                        </div>
                    </div>
                </div>
            </template>

            <button class="w-full border border-dashed p-3 rounded text-[#F97316] mb-6" @click="addOption">
                + Add Option
            </button>

            <div class="flex items-center space-x-4 mb-6">
                <label><input type="radio" name="reportType" value="detailed" x-model="reportType"> Detailed
                    Report</label>
                <label><input type="radio" name="reportType" value="summarized" x-model="reportType"> Summarized
                    Report</label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-4 rounded" @click="aiDecision">
                    Let AI make the decision...
                </button>
                <button class="bg-[#F97316] hover:bg-[#ea6a0c] text-white py-4 rounded" @click="submitDecision">
                    Submit
                </button>
            </div>
        </div> --}}

{{-- <script>
    function decisionForm() {
        return {
            category: 'personal',
            selectedDecision: '',
            customDecision: '',
            reportType: 'detailed',
            personalOptions: [{
                    id: 'vehicle',
                    title: 'Buy a vehicle',
                    description: 'Best for small purchases and personal use.'
                },
                {
                    id: 'house',
                    title: 'Buy a house',
                    description: 'Good for long-term personal investment.'
                },
                {
                    id: 'mobile',
                    title: 'New mobile',
                    description: 'Choosing a new smartphone or device.'
                },
                {
                    id: 'internet',
                    title: 'New internet line',
                    description: 'Picking the best ISP for home internet.'
                },
                {
                    id: 'pet',
                    title: 'New pet',
                    description: 'Adopting a pet for companionship.'
                },
                {
                    id: 'gadget',
                    title: 'Buy something new',
                    description: 'Selecting a gadget, appliance, or accessory.'
                },
                {
                    id: 'other',
                    title: 'Other',
                    description: 'Custom decision.'
                }
            ],
            options: [{
                id: 1,
                name: '',
                pros: [''],
                cons: ['']
            }, ],
            addOption() {
                const newId = this.options.length ? Math.max(...this.options.map(o => o.id)) + 1 : 1;
                this.options.push({
                    id: newId,
                    name: '',
                    pros: [''],
                    cons: ['']
                });
            },
            addPro(index) {
                this.options[index].pros.push('');
            },
            addCon(index) {
                this.options[index].cons.push('');
            },
            aiDecision() {
                alert('AI decision popup triggered!');
            },
            submitDecision() {
                window.location.href = '/reports';
            }
        };
    }
</script> --}}
