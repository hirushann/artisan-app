<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Pricing extends Component
{
    public $pricingTiers = [
        [
            'name' => "Starter",
            'price' => "$29",
            'description' => "Perfect for individuals and small teams just getting started.",
            'features' => [
                "5 decision projects",
                "Basic AI analysis",
                "Data visualization",
                "Email support",
                "7-day history"
            ],
            'isPopular' => false,
        ],
        [
            'name' => "Professional",
            'price' => "$79",
            'description' => "Advanced features for growing businesses and teams.",
            'features' => [
                "Unlimited decision projects",
                "Advanced AI insights",
                "All data visualizations",
                "Priority support",
                "30-day history",
                "Team collaboration",
                "API access"
            ],
            'isPopular' => true,
        ],
        [
            'name' => "Enterprise",
            'price' => "Custom",
            'description' => "Custom solutions for large organizations with complex needs.",
            'features' => [
                "All Professional features",
                "Custom AI model training",
                "Dedicated account manager",
                "Custom integrations",
                "Unlimited history",
                "Advanced security",
                "SLA guarantees",
                "On-premise deployment options"
            ],
            'isPopular' => false,
            'buttonText' => "Contact Sales",
        ],
    ];

    public function render()
    {
        return view('livewire.pages.pricing')
            ->layout('layouts.guest');
    }
}
