<div class="min-h-screen">
    

    <main>
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-decisioner-light-orange to-white py-20 px-4">
            <div class="container mx-auto text-center max-w-4xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Our Mission is to Simplify Complex Decisions</h1>
                <p class="text-decisioner-gray text-lg mb-10 max-w-3xl mx-auto">
                    We're a team of AI researchers, data scientists, and product designers passionate about helping organizations make better decisions through data and artificial intelligence.
                </p>
            </div>
        </section>

        <!-- Company Timeline -->
        <section class="py-16 bg-decisioner-light-gray/30">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center">Our Journey</h2>
                <div class="max-w-3xl mx-auto">
                    @foreach ($timeline as $item)
                        <div class="flex gap-6">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-decisioner-orange rounded-full flex items-center justify-center text-white font-semibold z-10">
                                    {{ $item['year'] }}
                                </div>
                                <div class="w-0.5 h-full bg-decisioner-light-orange"></div>
                            </div>
                            <div class="pb-12">
                                <h3 class="text-xl font-semibold mb-2">{{ $item['title'] }}</h3>
                                <p class="text-decisioner-gray">{{ $item['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center">Our Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($values as $value)
                        <div class="bg-white p-6 rounded-xl border border-gray-100 hover:border-decisioner-orange/30 transition-colors">
                            <div class="w-12 h-12 bg-decisioner-light-orange rounded-full flex items-center justify-center mb-4">
                                <!-- Placeholder SVG -->
                                <svg class="w-6 h-6 text-decisioner-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 16l4-4-4-4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $value['title'] }}</h3>
                            <p class="text-decisioner-gray">{{ $value['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-16 bg-decisioner-light-gray/30">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center">Leadership Team</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($teamMembers as $member)
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <h3 class="text-xl font-semibold mb-1">{{ $member['name'] }}</h3>
                            <p class="text-decisioner-orange font-medium mb-3">{{ $member['role'] }}</p>
                            <p class="text-decisioner-gray">{{ $member['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    
</div>