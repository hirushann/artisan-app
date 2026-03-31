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

        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-3xl font-bold mb-6 text-center">Our Story</h2>
                    <p class="text-decisioner-gray mb-6">
                        Decisioner was born out of frustration with traditional decision-making processes that were slow, biased, and often ignored valuable data. 
                        Our founders, Emma Thompson and Michael Chen, met while working on AI research at a leading tech company, where they discovered a shared vision for transforming how organizations make decisions.
                    </p>
                    <p class="text-decisioner-gray mb-6">
                        In 2018, they left their jobs to build a system that would combine the analytical power of AI with human intuition and expertise. 
                        The goal was simple: create a platform that could process vast amounts of data, identify patterns humans might miss, and present insights in a way that empowers rather than replaces human decision-makers.
                    </p>
                    <p class="text-decisioner-gray mb-6">
                        Today, Decisioner helps thousands of organizations across the globe make better, faster, and more confident decisions. 
                        But our journey is just beginning. We continue to push the boundaries of what's possible with AI and decision intelligence.
                    </p>
                </div>
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
                                {!! $value['icon'] !!}
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
                            <div class="h-48 bg-decisioner-light-orange/50 rounded-[8px] mb-4 flex items-center justify-center">
                                <span class="text-decisioner-orange font-semibold">Photo</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-1">{{ $member['name'] }}</h3>
                            <p class="text-decisioner-orange font-medium mb-3">{{ $member['role'] }}</p>
                            <p class="text-decisioner-gray">{{ $member['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-6">Join Us on Our Mission</h2>
                <p class="text-decisioner-gray mb-8 max-w-2xl mx-auto">
                    We're always looking for talented people who share our passion for improving decision-making through technology.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="" class="bg-decisioner-orange hover:bg-orange-600 text-white px-6 py-3 rounded-lg flex items-center gap-2">
                        View Open Positions
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="" class="border-decisioner-orange text-decisioner-orange hover:bg-decisioner-light-orange/50 border-2 px-6 py-3 rounded-lg flex items-center">
                        Contact Us
                    </a>
                </div>
            </div>
        </section>
    </main>

    
</div>