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
        ['title' => "Accuracy", 'description' => "We're committed to providing precise, reliable insights.", 'icon' => "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-circle-check h-6 w-6 text-decisioner-orange'><circle cx='12' cy='12' r='10'></circle><path d='m9 12 2 2 4-4'></path></svg>"],
        ['title' => "Security", 'description' => "Your data security is paramount.", 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield h-6 w-6 text-decisioner-orange"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>'],
        ['title' => "Collaboration", 'description' => "We believe great decisions come from diverse perspectives.", 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-6 w-6 text-decisioner-orange"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>'],
        ['title' => "Transparency", 'description' => "We provide clear explanations of AI decisions.", 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square h-6 w-6 text-decisioner-orange"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>'],
        ['title' => "Accessibility", 'description' => "We design our tools to be understandable by everyone.", 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe h-6 w-6 text-decisioner-orange"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path><path d="M2 12h20"></path></svg>'],
        ['title' => "Efficiency", 'description' => "We streamline decision-making without sacrificing quality.", 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-6 w-6 text-decisioner-orange"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>'],
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
