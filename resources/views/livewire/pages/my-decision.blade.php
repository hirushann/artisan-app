<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="space-y-6 max-w-6xl mx-auto">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold">My Decision Reports</h2>
            <a href="" class="inline-flex items-center px-4 py-2 bg-[#F97316] hover:bg-[#ea6a0c] text-white text-sm font-medium rounded-md">
                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Decision
            </a>
        </div>
    
        <div class="rounded-md border">
            <div class="bg-gray-100 p-4 grid grid-cols-6 font-medium">
                <div class="col-span-2">Decision Title</div>
                <div class="hidden md:block">Category</div>
                <div class="hidden md:block">Date</div>
                <div class="hidden md:block">Recommendation</div>
                <div class="text-right">Actions</div>
            </div>
    
            <div class="divide-y">
                @foreach ([
                    ['id' => 1, 'title' => 'Buy a new car', 'date' => '2023-10-15', 'category' => 'Personal', 'recommendation' => 'Toyota Camry'],
                    ['id' => 2, 'title' => 'Choose vacation destination', 'date' => '2023-09-22', 'category' => 'Family', 'recommendation' => 'Bali, Indonesia'],
                    ['id' => 3, 'title' => 'Select new office space', 'date' => '2023-11-05', 'category' => 'Business', 'recommendation' => 'Downtown location'],
                ] as $report)
                    <div class="p-4 grid grid-cols-6 items-center">
                        <div class="col-span-2 font-medium">{{ $report['title'] }}</div>
                        <div class="hidden md:block text-gray-500">{{ $report['category'] }}</div>
                        <div class="hidden md:block text-gray-500">{{ \Carbon\Carbon::parse($report['date'])->format('F j, Y') }}</div>
                        <div class="hidden md:block text-gray-500">{{ $report['recommendation'] }}</div>
                        <div class="flex justify-end gap-2">
                            <a href="{{ url('/reports/' . $report['id']) }}" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">View</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>
