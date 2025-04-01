<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="space-y-6 max-w-6xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <a href="" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded text-sm hover:bg-gray-100 w-fit">
                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Reports
            </a>
    
            <div class="flex gap-2">
                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded text-sm hover:bg-gray-100">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16M4 8h16M4 16h16" /></svg>
                    Share
                </button>
                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded text-sm hover:bg-gray-100">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" /></svg>
                    Download PDF
                </button>
            </div>
        </div>
    
        <div class="space-y-2">
            <h1 class="text-3xl font-bold">Buy a new car</h1>
            <div class="flex flex-wrap gap-3 text-sm">
                <div class="bg-gray-100 px-2.5 py-1 rounded-md">
                    Category: <span class="font-medium">Personal</span>
                </div>
                <div class="bg-gray-100 px-2.5 py-1 rounded-md">
                    Date: <span class="font-medium">October 15, 2023</span>
                </div>
            </div>
        </div>
    
        <div class="border rounded-lg bg-white shadow p-6">
            <h3 class="text-xl font-semibold mb-2">Decision Summary</h3>
            <p class="text-gray-600">Making a decision on which car to purchase based on needs, budget, and preferences.</p>
    
            <div class="mt-6">
                <h3 class="font-semibold text-lg mb-2">Recommendation</h3>
                <div class="bg-green-50 border border-green-200 rounded-md p-4">
                    <p class="font-medium text-green-800">Toyota Camry</p>
                    <p class="text-green-700 mt-2">
                        Based on the analysis of your needs and preferences, the Toyota Camry provides the best balance of reliability, cost-effectiveness, and features. While it may not be the most exciting option, it offers the lowest total cost of ownership and aligns well with your primary criteria of a dependable vehicle for daily commuting and occasional family trips.
                    </p>
                </div>
            </div>
        </div>
    
        <h2 class="text-2xl font-bold mt-6">Options Analysis</h2>
    
        <div class="grid gap-6 md:grid-cols-3">
            @foreach ([
                [
                    'name' => 'Toyota Camry',
                    'pros' => ['Reliable', 'Good fuel economy', 'Low maintenance costs'],
                    'cons' => ['Less exciting to drive', 'Basic interior', 'Higher upfront cost'],
                ],
                [
                    'name' => 'Honda Accord',
                    'pros' => ['Stylish design', 'Advanced safety features', 'Comfortable ride'],
                    'cons' => ['Slightly higher price', 'Less cargo space', 'Higher insurance costs'],
                ],
                [
                    'name' => 'Mazda 6',
                    'pros' => ['Fun to drive', 'Premium interior', 'Attractive exterior design'],
                    'cons' => ['Less fuel efficient', 'Smaller dealer network', 'Higher maintenance costs'],
                ],
            ] as $option)
                <div class="border rounded-lg p-4 shadow {{ $option['name'] === 'Toyota Camry' ? 'border-green-300 bg-green-50' : 'bg-white' }}">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold">{{ $option['name'] }}</h3>
                        @if ($option['name'] === 'Toyota Camry')
                            <span class="text-xs bg-green-500 text-white px-2 py-1 rounded">Recommended</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <h4 class="font-medium text-green-700 mb-2">Pros</h4>
                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            @foreach ($option['pros'] as $pro)
                                <li>{{ $pro }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-medium text-red-700 mb-2">Cons</h4>
                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            @foreach ($option['cons'] as $con)
                                <li>{{ $con }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
</div>
