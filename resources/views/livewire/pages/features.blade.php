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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brain h-8 w-8 text-decisioner-orange"><path d="M12 5a3 3 0 1 0-5.997.125 4 4 0 0 0-2.526 5.77 4 4 0 0 0 .556 6.588A4 4 0 1 0 12 18Z"></path><path d="M12 5a3 3 0 1 1 5.997.125 4 4 0 0 1 2.526 5.77 4 4 0 0 1-.556 6.588A4 4 0 1 1 12 18Z"></path><path d="M15 13a4.5 4.5 0 0 1-3-4 4.5 4.5 0 0 1-3 4"></path><path d="M17.599 6.5a3 3 0 0 0 .399-1.375"></path><path d="M6.003 5.125A3 3 0 0 0 6.401 6.5"></path><path d="M3.477 10.896a4 4 0 0 1 .585-.396"></path><path d="M19.938 10.5a4 4 0 0 1 .585.396"></path><path d="M6 18a4 4 0 0 1-1.967-.516"></path><path d="M19.967 17.484A4 4 0 0 1 18 18"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">AI Analysis</h3>
                        <p class="text-decisioner-gray">Advanced algorithms that analyze complex data to extract meaningful insights.</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-6 hover:bg-decisioner-light-gray/30 rounded-xl transition-colors">
                        <div class="w-16 h-16 bg-decisioner-light-orange rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-line h-8 w-8 text-decisioner-orange"><path d="M3 3v16a2 2 0 0 0 2 2h16"></path><path d="m19 9-5 5-4-4-3 3"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Data Visualization</h3>
                        <p class="text-decisioner-gray">Interactive charts and graphs that make complex data easy to understand.</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-6 hover:bg-decisioner-light-gray/30 rounded-xl transition-colors">
                        <div class="w-16 h-16 bg-decisioner-light-orange rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lightbulb h-8 w-8 text-decisioner-orange"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"></path><path d="M9 18h6"></path><path d="M10 22h4"></path></svg>
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
                            <div class="lg:w-1/2 bg-decisioner-light-orange/70 rounded-xl p-8 h-72 flex items-center justify-center">
                                <span class="text-4xl font-bold text-decisioner-orange opacity-70">{{ $section['title'] }}</span>
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
