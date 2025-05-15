<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-gray-500 text-sm">Total Users</div>
                    <div class="text-2xl font-bold">{{ $totalUsers }}</div>
                </div>
        
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-gray-500 text-sm">Total Categories</div>
                    <div class="text-2xl font-bold">{{ $totalCategories }}</div>
                </div>
        
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-gray-500 text-sm">Total Materials</div>
                    <div class="text-2xl font-bold">{{ $totalMartials }}</div>
                </div>
        
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-gray-500 text-sm">Total Revenue</div>
                    <div class="text-2xl font-bold">KSh {{ number_format($totalRevenue, 2) }}</div>
                </div>
        
            </div>
        </div>
    </div>
</x-admin-layout>
