<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class About extends Component
{
    public $teamMembers = [
        [
            'name' => "Emma Thompson",
            'role' => "CEO & Co-Founder",
            'description' => "Former AI research scientist with 15+ years of experience in decision intelligence systems."
        ],
        [
            'name' => "Michael Chen",
            'role' => "CTO & Co-Founder",
            'description' => "Machine learning expert who previously led engineering teams at major tech companies."
        ],
        [
            'name' => "Sarah Johnson",
            'role' => "Head of Product",
            'description' => "Passionate about creating intuitive user experiences that make complex data accessible."
        ],
        [
            'name' => "David Rodriguez",
            'role' => "Chief Data Scientist",
            'description' => "PhD in computational decision making with experience developing AI models for Fortune 500 companies."
        ],
    ];

    public $values = [
        ['title' => "Accuracy", 'description' => "We're committed to providing precise, reliable insights."],
        ['title' => "Security", 'description' => "Your data security is paramount."],
        ['title' => "Collaboration", 'description' => "We believe great decisions come from diverse perspectives."],
        ['title' => "Transparency", 'description' => "We provide clear explanations of AI decisions."],
        ['title' => "Accessibility", 'description' => "We design our tools to be understandable by everyone."],
        ['title' => "Efficiency", 'description' => "We streamline decision-making without sacrificing quality."],
    ];

    public $timeline = [
        ['year' => "2018", 'title' => "The Idea Takes Shape", 'description' => "Emma & Michael conceptualize Decisioner while working on AI research."],
        ['year' => "2019", 'title' => "Seed Funding & First Team", 'description' => "Secured initial funding and assembled an AI team."],
        ['year' => "2020", 'title' => "Beta Launch", 'description' => "Released beta version to select companies for feedback."],
        ['year' => "2021", 'title' => "Series A & Official Launch", 'description' => "Secured Series A funding and officially launched Decisioner."],
        ['year' => "2022", 'title' => "Expansion & Recognition", 'description' => "Grew to 50+ employees and received AI innovation awards."],
        ['year' => "2023", 'title' => "Global Growth", 'description' => "Expanded globally with multi-language support."],
    ];

    public function render()
    {
        return view('livewire.pages.about')
            ->layout('layouts.guest');
    }
}
