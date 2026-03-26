<?php

namespace App\Livewire\Pages;

use App\Models\Decision;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Component;
use Prism\Prism\Prism;

class DecisionResponse extends Component
{
    public $aiDecision = [];
    public $decision_model;
    #[Url]
    public $decision_id;

    function mount(): void
    {
        // Log::info($this->decision_id);
        $this->decision_model = Decision::find($this->decision_id);
        if(empty($this->decision_model) || empty($this->decision_model->ai_response)){
            $this->aiDecisionResponse();
        }

        $this->aiDecision = $this->decision_model->ai_response;
    }

    function aiDecisionResponse(): void
    {
        // if(empty($this->decision_model) || empty($this->decision_model->ai_response)){
            $this->aiDecision = Prism::text()
                ->using('gemini', 'gemini-flash-latest')
                ->withPrompt('Tell me a story about a brave knight.')
                ->generate();
            // Log::info(json_encode($this->aiDecision));
            $this->decision_model->ai_response = json_encode($this->aiDecision);
            $this->decision_model->save();

            $this->stream(to: 'aiDecisionResponse', content: $this->aiDecision);
            Log::info('Generated ' . json_encode($this->aiDecision));
        // }
    }

    public function render()
    {
        return view('livewire.pages.decision-response');
    }
}
