<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Features;
use App\Livewire\Pages\Pricing;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/about', About::class)->name('about');
Route::get('/features', Features::class)->name('features');
Route::get('/pricing', Pricing::class)->name('pricing');