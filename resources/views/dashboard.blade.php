<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-full">
        <div class="mx-auto">
            <div class="overflow-hidden sm:rounded-lg">
                {{-- <x-welcome /> --}}

                <div class="flex justify-between p-6 gap-5 h-full">
                    <div class="w-1/2 border rounded-lg px-4  py-12 flex flex-col justify-center items-center">
                        <h1 class="text-2xl font-semibold text-gray-800">Welcome to your dashboard</h1>
                        <p class="text-gray-500">This is your dashboard, you can manage your account here.</p>
                    </div>
                    <div class="w-1/2 border rounded-lg px-4 py-12 flex flex-col justify-center items-center">
                        <a href="{{ route('logout') }}" class="text-red-500">Logout</a>
                    </div>
                </div>


                <div>
                    <section class="bg-white">
                        <livewire:decision-form />
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
