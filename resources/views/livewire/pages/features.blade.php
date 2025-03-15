<div>
    <main>
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-decisioner-light-orange to-white py-20 px-4">
            <div class="container mx-auto text-center max-w-4xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Powerful Features to Transform Your Decision Making</h1>
                <p class="text-decisioner-gray text-lg mb-10 max-w-3xl mx-auto">
                    Decisioner combines cutting-edge AI technology with intuitive design to help you make better decisions, faster and with more confidence.
                </p>
                <a href="{{ route('register') }}" class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                    Get Started
                </a>
            </div>
        </section>

        <!-- Core Features Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">Core Features</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="flex flex-col items-center text-center p-6 hover:bg-decisioner-light-gray/30 rounded-xl transition-colors">
                        <div class="w-16 h-16 bg-decisioner-light-orange rounded-full flex items-center justify-center mb-4">
                            <!-- Brain SVG Icon -->
                            <svg class="w-8 h-8 text-decisioner-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9 12h6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">AI Analysis</h3>
                        <p class="text-decisioner-gray">Advanced algorithms that analyze complex data to extract meaningful insights.</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-6 hover:bg-decisioner-light-gray/30 rounded-xl transition-colors">
                        <div class="w-16 h-16 bg-decisioner-light-orange rounded-full flex items-center justify-center mb-4">
                            <!-- LineChart SVG Icon -->
                            <svg class="w-8 h-8 text-decisioner-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 20l4-4 3 3 5-5 4 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Data Visualization</h3>
                        <p class="text-decisioner-gray">Interactive charts and graphs that make complex data easy to understand.</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-6 hover:bg-decisioner-light-gray/30 rounded-xl transition-colors">
                        <div class="w-16 h-16 bg-decisioner-light-orange rounded-full flex items-center justify-center mb-4">
                            <!-- LineChart SVG Icon -->
                            <svg class="w-8 h-8 text-decisioner-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 20l4-4 3 3 5-5 4 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Smart Recommendations</h3>
                        <p class="text-decisioner-gray">Actionable recommendations that help you make better decisions.</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Feature Sections -->
        <section class="py-8 bg-white">
            <div class="container mx-auto px-4">
                @foreach ($featureSections as $index => $section)
                    <div class="py-16 border-b border-gray-100">
                        <div class="flex flex-col {{ $section['isReversed'] ? 'lg:flex-row-reverse' : 'lg:flex-row' }} gap-12 items-center">
                            <div class="lg:w-1/2 space-y-6">
                                <h2 class="text-3xl font-bold">{{ $section['title'] }}</h2>
                                <p class="text-decisioner-gray text-lg">{{ $section['description'] }}</p>
                                
                                <ul class="space-y-3 mt-6">
                                    @foreach ($section['features'] as $feature)
                                        <li class="flex items-start">
                                            <span class="h-5 w-5 text-decisioner-orange shrink-0 mr-2 mt-0.5">✔</span>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="lg:w-1/2 bg-gray-200 rounded-xl p-8 h-72 flex items-center justify-center">
                                <span class="text-4xl font-bold text-gray-600 opacity-70">{{ $section['title'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-decisioner-light-gray/50 py-16">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-6">Ready to Transform Your Decision Making?</h2>
                <p class="text-decisioner-gray mb-8 max-w-2xl mx-auto">
                    Join thousands of businesses that are making smarter, data-driven decisions with Decisioner.
                </p>
                <a href="{{ route('register') }}" class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                    Start Your Free Trial
                </a>
            </div>
        </section>
    </main>
</div>
