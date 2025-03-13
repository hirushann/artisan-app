<?php

namespace App\Livewire;

use Livewire\Component;

class HowItWorks extends Component
{
    public $steps = [
        [
            'icon' => 'upload',
            'title' => 'Upload Your Data',
            'description' => 'Import data from multiple sources or connect your existing tools for seamless analysis.'
        ],
        [
            'icon' => 'brain',
            'title' => 'AI Analysis',
            'description' => 'Our advanced algorithms process your data, identifying patterns and insights humans might miss.'
        ],
        [
            'icon' => 'pie-chart',
            'title' => 'View Insights',
            'description' => 'Explore interactive visualizations and detailed reports to understand the analysis.'
        ],
        [
            'icon' => 'check-circle-2',
            'title' => 'Make Decisions',
            'description' => 'Act confidently with AI-backed recommendations and data-driven insights.'
        ],
    ];

    public function render()
    {
        return view('livewire.how-it-works');
    }
}
