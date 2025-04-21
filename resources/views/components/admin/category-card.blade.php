@props(['category'])

<div class="bg-white ml-4 mr-4 w-50 col-6 rounded-lg shadow-md p-4 mb-4 border border-gray-200">
    <div class="">
        <div class="flex gap-4 justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">{{ $category->category_name }}</h3>
            <p class="text-sm text-gray-600 mt-1">Updated at: {{ $category->updated_at }}</p>
        </div>
        <p class="text-sm text-gray-600 mt-1">{{ $category->description ?? 'No description' }}</p>

        <div class="flex gap-2 justify-between mt-2">
            <!-- Edit (link to edit route, if implemented) -->
            <x-admin.edit-category-modal :category="$category" />

            <a href="{{ route('martials.index', $category->id) }}" class="text-blue-600 hover:underline text-sm">
                <x-primary-button> Details </x-primary-button>
            </a>            

            <!-- Delete (form to delete category) -->
            <form class="" action="{{ route('categories.destroy', $category->id) }}" method="POST" 
                onsubmit="return confirm('Are you sure you want to delete the categories?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline text-sm">
                    <x-danger-button> Delete </x-danger-button>
                </button>
            </form>
        </div>
    </div>
</div>
