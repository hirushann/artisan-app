<nav class="py-4 px-6 sm:px-8 w-full">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('welcome') }}" class="flex items-center">
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-decisioner-orange to-orange-500">
                    Decisioner
                </span>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('about') }}" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                About
            </a>
            <a href="{{ route('features') }}" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                Features
            </a>
            <a href="{{ route('pricing') }}" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                Pricing
            </a>
            <a href="{{ route('contact') }}" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                Contact
            </a>
            <a href="{{ route('login') }}" class="font-medium text-decisioner-orange hover:text-orange-700 flex items-center gap-1">
                <svg class="w-5 h-5 fill-decisioner-orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
                Sign in
            </a>
            <a href="{{ route('dashboard') }}" class="bg-decisioner-orange hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                Get Started
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button 
                wire:click="toggleMenu"
                class="text-gray-800 focus:outline-none"
                aria-label="Toggle menu"
            >
                @if ($isMenuOpen)
                    {{-- <x-lucide-x size="24"/> --}}
                @else
                    {{-- <x-lucide-menu size="24"/> --}}
                @endif
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    @if ($isMenuOpen)
        <div class="md:hidden absolute top-16 left-0 right-0 bg-white z-50 border-b border-gray-200 animate-fade-in">
            <div class="flex flex-col space-y-4 p-6">
                <a href="" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                    Home
                </a>
                <a href="" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                    Features
                </a>
                <a href="" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                    Pricing
                </a>
                <a href="" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors">
                    About
                </a>
                <a href="" class="text-decisioner-charcoal font-medium hover:text-decisioner-orange transition-colors flex items-center gap-1">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
                    Sign in
                </a>
                <a href="" class="bg-decisioner-orange hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-center">
                    Get Started
                </a>
            </div>
        </div>
    @endif
</nav>