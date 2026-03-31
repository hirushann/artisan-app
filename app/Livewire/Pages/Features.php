<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Features extends Component
{
    public $featureSections = [
        [
            'title' => "AI-Powered Decision Analysis",
            'description' => "Our powerful AI algorithms analyze complex data sets to uncover insights and patterns that would be impossible to detect manually.",
            'features' => [
                "Natural language processing for unstructured data",
                "Machine learning models trained on industry-specific datasets",
                "Automated pattern recognition and anomaly detection",
                "Continuous learning from your organization's decisions"
            ],
            'isReversed' => false
        ],
        [
            'title' => "Interactive Data Visualization",
            'description' => "Turn complex data into actionable insights with our comprehensive visualization tools designed for clarity and impact.",
            'features' => [
                "Customizable dashboards for different stakeholders",
                "Real-time data updates and trend monitoring",
                "Interactive charts and graphs with drill-down capabilities",
                "Export options for presentations and reports"
            ],
            'isReversed' => true
        ],
        [
            'title' => "Collaborative Decision Workspace",
            'description' => "Bring your team together in a unified environment designed to streamline the decision-making process from start to finish.",
            'features' => [
                "Real-time collaboration tools for distributed teams",
                "Role-based access control and permissions",
                "Decision documentation and audit trails",
                "Integration with popular communication platforms"
            ],
            'isReversed' => false
        ],
        [
            'title' => "Enterprise-Grade Security",
            'description' => "Your data security is our priority with enterprise-level encryption and compliance with global security standards.",
            'features' => [
                "End-to-end encryption for all data",
                "SOC 2 and GDPR compliance",
                "Regular security audits and penetration testing",
                "Granular access controls and permissions"
            ],
            'isReversed' => true
        ]
    ];

    public function render()
    {
        return view('livewire.pages.features')
            ->layout('layouts.guest');
    }
}
