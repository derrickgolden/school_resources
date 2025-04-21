@props(['category'])

<div class="bg-white rounded-lg shadow-md p-4 border border-gray-200 ">
    <div class="">
        <div class="flex gap-4 justify-between items-center">
            <div>
                <p class="text-sm text-gray-600 mt-1">Category: </p>
                <h3 class="text-lg font-semibold text-gray-800">{{ $category->category_name }}</h3>
            </div>
            <div>
                <p class="text-sm text-gray-600 mt-1">Updated at: </p>
                <p class="text-medium text-gray-900">{{ $category->updated_at }}</p>
            </div>
        </div>
        <div>
            <p class="text-sm text-gray-600 mt-1">Description: </p>
            <p class="text-sm text-yellow-600 mt-1">{{ $category->description ?? 'No description' }}</p>
        </div>
        <div class="flex gap-2 justify-center mt-2">
            <a href="{{ route('public.martials.index', $category->id) }}" 
                class="text-blue-600 hover:underline text-sm">
                <x-primary-button> Open {{ $category->category_name }} </x-primary-button>
            </a>            
        </div>

    </div>
</div>
