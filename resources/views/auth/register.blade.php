{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-label for="first_name" value="{{ __('First Name') }}" />
                <x-input id="first_name" class="block mt-1 w-full rounded-2xl" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            </div>

            <div>
                <x-label for="last_name" value="{{ __('Last Name') }}" />
                <x-input id="last_name" class="block mt-1 w-full rounded-2xl" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            </div>
        </div>
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full rounded-2xl" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full rounded-2xl" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full rounded-2xl" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4 rounded-2xl py-3">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


<x-guest-layout>
    <div class="flex flex-col bg-gradient-to-br from-white to-decisioner-light-orange/20">
        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <h1 class="text-3xl font-bold tracking-tight text-decisioner-charcoal">
                        Create your account
                    </h1>
                    <p class="mt-2 text-sm text-decisioner-gray">
                        Start making better decisions with Decisioner
                    </p>
                </div>

                <!-- Registration Form -->
                <div class="mt-8 bg-white p-8 shadow-md rounded-xl border border-gray-100">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Full Name (Split into First and Last Name) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="first_name" value="First Name" />
                                <x-input 
                                    id="first_name" 
                                    type="text" 
                                    name="first_name" 
                                    :value="old('first_name')" 
                                    required 
                                    autofocus 
                                    autocomplete="given-name"
                                    placeholder="Enter first name"
                                    class="block mt-1 w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange"
                                />
                            </div>

                            <div>
                                <x-label for="last_name" value="Last Name" />
                                <x-input 
                                    id="last_name" 
                                    type="text" 
                                    name="last_name" 
                                    :value="old('last_name')" 
                                    required 
                                    autocomplete="family-name"
                                    placeholder="Enter last name"
                                    class="block mt-1 w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange"
                                />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <x-label for="email" value="Email address" />
                            <x-input 
                                id="email" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required 
                                autocomplete="email"
                                placeholder="Enter your email"
                                class="block mt-1 w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange"
                            />
                        </div>

                        <!-- Password with Visibility Toggle -->
                        <div>
                            <div class="flex items-center justify-between">
                                <x-label for="password" value="Password" />
                            </div>
                            <div class="mt-1 relative">
                                <x-input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Create a password"
                                    class="block w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange pr-10"
                                />
                                <button 
                                    type="button" 
                                    onclick="togglePasswordVisibility()" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 z-10 text-gray-400 hover:text-gray-600 focus:outline-none"
                                >
                                    <!-- Eye Icon (Show Password) -->
                                    <svg id="eye-icon-show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <!-- Eye Slash Icon (Hide Password) -->
                                    <svg id="eye-icon-hide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                Password must be at least 8 characters long
                            </p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-label for="password_confirmation" value="Confirm Password" />
                            <x-input 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="Confirm password"
                                class="block mt-1 w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange"
                            />
                        </div>

                        <!-- Terms & Conditions Checkbox -->
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="flex items-start mt-4">
                                <input 
                                    id="terms"
                                    name="terms"
                                    type="checkbox"
                                    required
                                    class="h-4 w-4 rounded border-gray-300 text-decisioner-orange"
                                />
                                <label for="terms" class="ml-2 text-sm text-gray-700">
                                    I agree to the 
                                    <a href="{{ route('terms.show') }}" target="_blank" class="font-medium text-decisioner-orange hover:text-orange-700">
                                        Terms of Service
                                    </a> and 
                                    <a href="{{ route('policy.show') }}" target="_blank" class="font-medium text-decisioner-orange hover:text-orange-700">
                                        Privacy Policy
                                    </a>
                                </label>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-decisioner-orange hover:bg-orange-600 text-white flex items-center justify-center gap-2 py-3 rounded-lg">
                            Create account
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 4v16"></path>
                                <path d="M5 12h14"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Already have an account? -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-decisioner-orange hover:text-orange-700">
                            Sign in
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
        var showIcon = document.getElementById("eye-icon-show");
        var hideIcon = document.getElementById("eye-icon-hide");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showIcon.classList.add("hidden");
            hideIcon.classList.remove("hidden");
        } else {
            passwordInput.type = "password";
            showIcon.classList.remove("hidden");
            hideIcon.classList.add("hidden");
        }
    }
</script>