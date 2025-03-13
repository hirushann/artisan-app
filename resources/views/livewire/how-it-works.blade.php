<section class="py-20 bg-decisioner-light-orange/50">
    <div class="container px-4 sm:px-6 mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">How It Works</h2>
            <p class="text-decisioner-gray max-w-2xl mx-auto">
                A simple four-step process to transform complex data into clear decisions.
            </p>
        </div>

        <div class="relative">
            <!-- Connecting Line -->
            <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-1 bg-decisioner-light-orange -translate-y-1/2 z-0"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($steps as $index => $step)
                    <div class="relative z-10">
                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm h-full flex flex-col items-center text-center">
                            <div class="w-20 h-20 rounded-full bg-decisioner-light-orange/50 flex items-center justify-center mb-4">
                                <x-lucide-{{ $step['icon'] }} class="w-10 h-10 text-decisioner-orange" />
                            </div>
                            <span class="bg-decisioner-orange text-white text-sm font-medium px-3 py-1 rounded-full mb-4">
                                Step {{ $index + 1 }}
                            </span>
                            <h3 class="text-xl font-semibold mb-2">{{ $step['title'] }}</h3>
                            <p class="text-decisioner-gray">{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>