<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DecisionForm extends Component
{
    public $mainPurpose, $subPurpose, $otherPurpose;
    public $options = [['option' => '', 'pros' => '', 'cons' => '']];


    function saveForm() : void {
        Log::info($this->options);
    }
    
    public function render()
    {
        return view('livewire.decision-form');
    }
}
