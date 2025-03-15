<div>
    <main class="container mx-auto py-20 px-4">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold mb-4">Simple, Transparent Pricing</h1>
            <p class="text-decisioner-gray max-w-2xl mx-auto">
                Choose the plan that's right for your business. All plans include a 14-day free trial.
            </p>
        </div>

        <!-- Pricing Tiers -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach ($pricingTiers as $tier)
                <div class="rounded-xl p-6 shadow-lg border {{ $tier['isPopular'] ? 'border-decisioner-orange ring-2 ring-decisioner-orange/20' : 'border-gray-200' }} bg-white h-full flex flex-col relative">
                    @if ($tier['isPopular'])
                        <div class="absolute -top-4 left-0 right-0 flex justify-center">
                            <span class="bg-decisioner-orange text-white text-sm font-medium rounded-full px-4 py-1">
                                Most Popular
                            </span>
                        </div>
                    @endif
                    <h3 class="text-xl font-bold mb-2">{{ $tier['name'] }}</h3>
                    <div class="mb-4">
                        <span class="text-3xl font-bold">{{ $tier['price'] }}</span>
                        @if ($tier['price'] !== 'Custom')
                            <span class="text-decisioner-gray">/month</span>
                        @endif
                    </div>
                    <p class="text-decisioner-gray mb-6">{{ $tier['description'] }}</p>
                    <div class="space-y-3 mb-8 flex-grow">
                        @foreach ($tier['features'] as $feature)
                            <div class="flex items-start">
                                <span class="h-5 w-5 text-decisioner-orange shrink-0 mr-2">✔</span>
                                <span class="text-sm">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('register') }}" class="w-full px-4 py-2 text-center rounded-lg {{ $tier['isPopular'] ? 'bg-decisioner-orange text-white hover:bg-orange-600' : 'bg-white text-decisioner-charcoal border-2 border-gray-200 hover:bg-gray-50' }}">
                        {{ $tier['buttonText'] ?? 'Get Started' }}
                    </a>
                </div>
            @endforeach
        </div>

        <!-- FAQ Section -->
        <div class="mt-24">
            <h2 class="text-2xl font-bold text-center mb-8">Frequently Asked Questions</h2>
            <div class="max-w-3xl mx-auto grid gap-6">
                <div class="bg-decisioner-light-gray/50 p-6 rounded-lg">
                    <h3 class="font-semibold mb-2">Can I change my plan later?</h3>
                    <p class="text-decisioner-gray">Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.</p>
                </div>
                <div class="bg-decisioner-light-gray/50 p-6 rounded-lg">
                    <h3 class="font-semibold mb-2">What happens after my trial ends?</h3>
                    <p class="text-decisioner-gray">After your 14-day trial, you'll be automatically switched to your selected plan. We'll send you a reminder before your trial ends.</p>
                </div>
                <div class="bg-decisioner-light-gray/50 p-6 rounded-lg">
                    <h3 class="font-semibold mb-2">Do you offer discounts for nonprofits or educational institutions?</h3>
                    <p class="text-decisioner-gray">Yes, we offer special pricing for eligible nonprofits and educational institutions. Please contact our sales team for more information.</p>
                </div>
                <div class="bg-decisioner-light-gray/50 p-6 rounded-lg">
                    <h3 class="font-semibold mb-2">How does billing work?</h3>
                    <p class="text-decisioner-gray">We offer monthly and annual billing options. Annual plans come with a 15% discount compared to monthly pricing.</p>
                </div>
            </div>
        </div>
    </main>
</div>
