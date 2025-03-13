<footer class="bg-white border-t border-gray-200">
    <div class="container px-4 sm:px-6 py-12 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and Description -->
            <div class="col-span-1 md:col-span-1">
                <a href="" class="inline-block">
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-decisioner-orange to-orange-500">
                        Decisioner
                    </span>
                </a>
                <p class="mt-4 text-decisioner-gray text-sm">
                    AI-powered decision support system helping businesses make better decisions with confidence.
                </p>
                <div class="flex mt-6 space-x-4">
                    <a href="#" class="text-decisioner-gray hover:text-decisioner-orange transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M22 4.01a8.8 8.8 0 0 1 -2.5 .68a4.4 4.4 0 0 0 1.94 -2.43a8.79 8.79 0 0 1 -2.8 1.07a4.39 4.39 0 0 0 -7.5 4a12.46 12.46 0 0 1 -9.06 -4.6a4.39 4.39 0 0 0 1.36 5.87a4.3 4.3 0 0 1 -1.98 -.55v.06a4.39 4.39 0 0 0 3.52 4.31a4.39 4.39 0 0 1 -1.97 .07a4.39 4.39 0 0 0 4.1 3.06a8.79 8.79 0 0 1 -5.44 1.88a9.11 9.11 0 0 1 -1.05 -.06a12.45 12.45 0 0 0 6.76 1.98c8.13 0 12.58 -6.73 12.58 -12.58c0 -.19 0 -.38 -.01 -.57a9 9 0 0 0 2.21 -2.28z" />
                        </svg>
                    </a>
                    <a href="#" class="text-decisioner-gray hover:text-decisioner-orange transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <rect x="4" y="4" width="16" height="16" rx="2" />
                            <line x1="8" y1="11" x2="8" y2="16" />
                            <line x1="8" y1="8" x2="8" y2="8.01" />
                            <line x1="12" y1="16" x2="12" y2="11" />
                            <path d="M16 16v-3a2 2 0 0 0 -4 0" />
                        </svg>
                    </a>
                    <a href="#" class="text-decisioner-gray hover:text-decisioner-orange transition-colors">
                        {{-- <x-lucide-github size="20" /> --}}
                    </a>
                    <a href="#" class="text-decisioner-gray hover:text-decisioner-orange transition-colors">
                        {{-- <x-lucide-mail size="20" /> --}}
                    </a>
                </div>
            </div>

            <!-- Footer Links -->
            @foreach ($links as $section => $items)
                <div>
                    <h3 class="text-sm font-semibold text-decisioner-charcoal uppercase tracking-wider">
                        {{ $section }}
                    </h3>
                    <ul class="mt-4 space-y-2">
                        @foreach ($items as $item)
                            <li>
                                <a href="{{ url($item['url']) }}" class="text-decisioner-gray hover:text-decisioner-orange transition-colors text-sm">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200">
            <p class="text-center text-decisioner-gray text-sm">
                &copy; {{ now()->year }} Decisioner. All rights reserved.
            </p>
        </div>
    </div>
</footer>