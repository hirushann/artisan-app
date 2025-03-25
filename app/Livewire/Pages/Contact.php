<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class Contact extends Component
{
    public $name, $email, $subject, $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|min:10',
    ];

    public function submit()
    {
        $this->validate();

        // Send Email (Optional)
        Mail::to('support@decisioner.com')->send(new ContactFormMail($this->name, $this->email, $this->subject, $this->message));

        // Clear form fields
        $this->reset();

        // Success message
        session()->flash('success', 'Message sent successfully!');
    }

    public function render()
    {
        return view('livewire.pages.contact')
            ->layout('layouts.guest');
    }
}
