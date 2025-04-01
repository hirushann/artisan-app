<?php

use Livewire\Volt\Volt;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Pricing;
use App\Livewire\Pages\Features;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\DecisionResponse;

Route::get('/dashboard', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('new-decision');
})->name('dashboard');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/decision/{decision_id}', DecisionResponse::class)->name('decision-response');

    Volt::route('/my-decisions', 'pages.my-decision')
        ->name('my-decision');

    Volt::route('/single-decisions', 'pages.show-single-decision')
        ->name('single-decision');

    Volt::route('/home', 'pages.home')
        ->name('home');
});

Volt::route('/new-decisions', 'pages.new-decision')
    ->name('new-decision');

Route::get('/about', About::class)->name('about');
Route::get('/features', Features::class)->name('features');
Route::get('/pricing', Pricing::class)->name('pricing');
Route::get('/contact', Contact::class)->name('contact');
