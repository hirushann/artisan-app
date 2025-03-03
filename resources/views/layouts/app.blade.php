<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        @fluxAppearance
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">


            <!-- Page Content -->
            {{-- <main> --}}
            <div class="flex gap-0">
                <div class="w-[15%]">
                        <livewire:side-bar />
                </div>

                <!-- Page Content -->
                <div class="overflow-auto w-[85%] mx-auto">
                    @livewire('navigation-menu')

                    <!-- Page Heading -->
                    {{-- @if (isset($header))
                        <header class="bg-white dark:bg-gray-800 shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif --}}

                    <div class="p-4 bg-white h-full">
                        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                           <div class="grid grid-cols-1 gap-4 mb-4">
                                {{ $slot }}
                           </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        @fluxScripts
    </body>
</html>
