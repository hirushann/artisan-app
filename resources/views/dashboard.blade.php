<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-full">
        <div class="mx-auto">
            <div class="overflow-hidden sm:rounded-lg">
                <div>
                    <section class="bg-white dark:bg-slate-700">
                        <livewire:pages.decision-form />
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>