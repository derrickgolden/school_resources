
<x-admin-layout >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-6  justify-between">
                    <div class=" text-gray-900">
                        {{ __("Categories") }}
                    </div>
                    <x-admin.add-category-modal />                   
                </div>
                <div class="px-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($categories as $category)
                        <x-admin.category-card :category="$category" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout >