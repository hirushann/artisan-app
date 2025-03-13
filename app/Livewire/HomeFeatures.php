<?php

namespace App\Livewire;

use Livewire\Component;

class HomeFeatures extends Component
{
    public $features = [
        [
            'icon' => 'brain',
            'title' => 'AI-Powered Analysis',
            'description' => 'Advanced machine learning algorithms analyze complex data to identify patterns and insights.'
        ],
        [
            'icon' => 'line-chart',
            'title' => 'Data Visualization',
            'description' => 'Interactive charts and graphs help you understand trends and make informed decisions.'
        ],
        [
            'icon' => 'lightbulb',
            'title' => 'Smart Recommendations',
            'description' => 'Get actionable recommendations based on data-driven insights and industry best practices.'
        ],
        [
            'icon' => 'clock',
            'title' => 'Real-time Updates',
            'description' => 'Stay informed with real-time data updates and alerts for changing conditions.'
        ],
        [
            'icon' => 'bar-chart-3',
            'title' => 'Scenario Analysis',
            'description' => 'Compare multiple scenarios and their potential outcomes before making decisions.'
        ],
        [
            'icon' => 'layers',
            'title' => 'Multi-factor Analysis',
            'description' => 'Consider multiple variables and their interactions for comprehensive decision-making.'
        ],
    ];

    public function render()
    {
        return view('livewire.home-features');
    }
}
