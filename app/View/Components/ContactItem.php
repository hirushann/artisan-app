<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactItem extends Component
{
    public $icon;
    public $title;
    public $content;
    public $link;

    /**
     * Create a new component instance.
     */
    public function __construct($icon = '', $title = '', $content = '', $link = null)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->content = $content;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-item')
            ->layout('layouts.guest');
    }
}
