<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 px-3 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($categories as $category)
                <x-user-category-card :category='$category' />
            @endforeach
        </div>
    </div>
</x-app-layout>
