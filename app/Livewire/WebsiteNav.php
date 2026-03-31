<?php

namespace App\Livewire;

use Livewire\Component;

class WebsiteNav extends Component
{
    public $isMenuOpen = false;

    public function toggleMenu()
    {
        $this->isMenuOpen = !$this->isMenuOpen;
    }
    
    public function render()
    {
        return view('livewire.website-nav');
    }
}
