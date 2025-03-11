<?php

namespace App\Livewire;

use App\Models\Decision;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

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

    function saveForm() : void {
        // $this->validate();

        $decision = Decision::create(
            ['main_purpose' => $this->mainPurpose,
            'sub_purpose' => $this->subPurpose,
            'other_purpose' => $this->otherPurpose,
            'options' => json_encode($this->options),
            'report_type' => $this->reportType]
        );
        Log::info($this->options);
    }
    
    public function render()
    {
        return view('livewire.decision-form');
    }
}
