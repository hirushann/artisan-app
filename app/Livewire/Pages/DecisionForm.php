<?php

namespace App\Livewire\Pages;

use App\Models\Decision;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Prism\Prism\Prism;

class DecisionForm extends Component
{
    #[Validate('required')]
    public $mainPurpose;
    
    #[Validate('required')]
    public $subPurpose;
    
    #[Validate('required')]
    public $otherPurpose;

    #[Validate('required', 'array|min:2')]
    public $options = [['option' => '', 'pros' => '', 'cons' => '']];

    #[Validate('required')]
    public $reportType = '';

    public $aiResponse = '';

    function saveForm() : void {
        // $this->validate();

        $decision = Decision::create(
            ['main_purpose' => $this->mainPurpose,
            'sub_purpose' => $this->subPurpose,
            'other_purpose' => $this->otherPurpose,
            'options' => json_encode($this->options),
            'report_type' => $this->reportType]
        );

        // $aiResponse = Prism::stream()
        //     ->using('openai', 'gpt-4o-mini')
        //     ->withPrompt('Tell me a story about a brave knight.')
        //     ->generate();
        // Log::info($this->options);
    }
    
    public function render()
    {
        return view('livewire.pages.decision-form');
    }
}
