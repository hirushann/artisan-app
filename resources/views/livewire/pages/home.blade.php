<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="h-full">
    <div class="flex items-center justify-between max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h2 class="text-3xl font-bold tracking-tight text-gray-800">
            Dashboard
        </h2>
        <a href="{{ route('new-decision') }}" class="inline-flex items-center px-4 py-2 bg-[#F97316] hover:bg-[#ea6a0c] text-white text-sm font-medium rounded-md">
            <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            New Decision
        </a>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="border rounded-lg p-4 bg-white shadow">
                    <h3 class="text-lg font-semibold">Total Decisions</h3>
                    <p class="text-sm text-gray-500">Your decision-making activity</p>
                    <div class="mt-2 text-2xl font-bold">12</div>
                    <p class="text-xs text-gray-400 mt-1">+2 from last month</p>
                </div>

                <div class="border rounded-lg p-4 bg-white shadow">
                    <h3 class="text-lg font-semibold">Recent Decisions</h3>
                    <p class="text-sm text-gray-500">Last 7 days</p>
                    <div class="mt-2 text-2xl font-bold">3</div>
                </div>

                <div class="border rounded-lg p-4 bg-white shadow">
                    <h3 class="text-lg font-semibold">Decision Types</h3>
                    <p class="text-sm text-gray-500">By category</p>
                    <div class="mt-3 space-y-1 text-sm">
                        <div class="flex justify-between">
                            <span>Personal</span>
                            <span class="font-medium">7</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Business</span>
                            <span class="font-medium">3</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Family</span>
                            <span class="font-medium">2</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border rounded-lg p-4 bg-white shadow">
                <h3 class="text-lg font-semibold">Recent Decision Reports</h3>
                <p class="text-sm text-gray-500">Your latest decision analysis reports</p>
                <div class="mt-4 space-y-2">
                    @foreach([1, 2, 3] as $i)
                        <div class="flex justify-between items-center p-3 border rounded-md">
                            <div>
                                <h4 class="font-medium">Buy a new car</h4>
                                <p class="text-sm text-gray-500">Created 2 days ago</p>
                            </div>
                            <a href="{{ url('/reports/' . $i) }}" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">View</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
