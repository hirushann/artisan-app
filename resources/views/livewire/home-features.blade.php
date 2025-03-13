<section class="py-20 bg-white">
    <div class="container px-4 sm:px-6 mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">Powerful Features</h2>
            <p class="text-decisioner-gray max-w-2xl mx-auto">
                Decisioner combines cutting-edge AI with intuitive design to transform your decision-making process.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($features as $feature)
                <div class="feature-card-gradient p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                    <div class="w-12 h-12 rounded-full bg-decisioner-light-orange flex items-center justify-center mb-4">
                        <x-lucide-{{ $feature['icon'] }} class="w-6 h-6 text-decisioner-orange" />
                    </div>
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-decisioner-orange transition-colors">
                        {{ $feature['title'] }}
                    </h3>
                    <p class="text-decisioner-gray mb-4">
                        {{ $feature['description'] }}
                    </p>
                    <div class="flex items-center text-decisioner-orange font-medium">
                        <span>Learn more</span>
                        {{-- <x-lucide-arrow-up-right class="w-4 h-4 ml-1 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" /> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M7 7h10v10m0-10l-10 10" />
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>