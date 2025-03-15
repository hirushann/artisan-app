{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <h2 class="mb-3 font-black text-lg">Log in to your account</h2>
                <p class="font-light text-base">Welcome back!</p>
            </div>

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input placeholder="Your email address" id="email" class="block mt-1 w-full rounded-2xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-6">
                <div class="flex justify-between">
                    <x-label for="password" value="{{ __('Password') }}" />
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-input placeholder="Your password" id="password" class="block mt-1 w-full rounded-2xl" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-6">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4 w-full">
                <x-button class="w-full flex justify-center text-center rounded-2xl py-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


<x-guest-layout>
    <div class="min-h-screen flex flex-col bg-gradient-to-br from-white to-decisioner-light-orange/20">
        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-10">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <h1 class="text-3xl font-bold tracking-tight text-decisioner-charcoal">
                        Welcome back
                    </h1>
                    <p class="mt-2 text-sm text-decisioner-gray">
                        Sign in to your account to continue
                    </p>
                </div>

                <!-- Login Form -->
                <div class="mt-8 bg-white p-8 shadow-md rounded-xl border border-gray-100">
                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <!-- Email Input -->
                        <div>
                            <x-label for="email" value="Email address" />
                            <x-input 
                                id="email" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autofocus 
                                autocomplete="email"
                                placeholder="Enter your email"
                                class="mt-1 block w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange"
                            />
                        </div>

                        <!-- Password Input with Eye Icon -->
                        <div>
                            <div class="flex items-center justify-between">
                                <x-label for="password" value="Password" />
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-decisioner-orange hover:text-orange-700">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>
                            <div class="mt-1 relative">
                                <x-input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password"
                                    placeholder="Enter your password"
                                    class="block w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange pr-10"
                                />
                                <button 
                                    type="button"
                                    onclick="togglePasswordVisibility()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                                >
                                    👁️
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="flex items-center">
                            <input 
                                id="remember_me"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-decisioner-orange"
                            />
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-decisioner-orange hover:bg-orange-600 text-white flex items-center justify-center gap-2 py-3 rounded-lg">
                            Sign in
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Sign Up Link -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium text-decisioner-orange hover:bg-orange-700">
                            Sign up now
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <livewire:footer />
    </div>
</x-guest-layout>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    }
</script>