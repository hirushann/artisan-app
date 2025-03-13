<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public $links = [
        'Product' => [
            ['url' => 'features', 'label' => 'Features'],
            ['url' => 'pricing', 'label' => 'Pricing'],
            ['url' => 'integrations', 'label' => 'Integrations'],
            ['url' => 'changelog', 'label' => 'Changelog'],
        ],
        'Company' => [
            ['url' => 'about', 'label' => 'About'],
            ['url' => 'blog', 'label' => 'Blog'],
            ['url' => 'careers', 'label' => 'Careers'],
            ['url' => 'contact', 'label' => 'Contact'],
        ],
        'Resources' => [
            ['url' => 'documentation', 'label' => 'Documentation'],
            ['url' => 'help', 'label' => 'Help Center'],
            ['url' => 'privacy', 'label' => 'Privacy Policy'],
            ['url' => 'terms', 'label' => 'Terms of Service'],
        ],
    ];

    public function render()
    {
        return view('livewire.footer');
    }
}
