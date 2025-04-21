@props([
    'category',
    'route' => route('categories.update', ['category' => $category->id]),
    'show' => false,
])

<div x-data="{ open: {{ $show ? 'true' : 'false' }} }">
    {{-- <a href="#"  class="text-blue-600 hover:underline text-sm">
        Edit
    </a> --}}
    <a href="#" @click.prevent="open = true" class="text-blue-600 hover:underline text-sm ">
        <x-secondary-button> Edit </x-secondary-button>
    </a>

    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50 mx-2 bg-opacity-20 backdrop-blur-sm">
        <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Edit Category</h2>
                <button @click="open = false" class="text-gray-600 hover:text-gray-900 text-2xl leading-none">&times;</button>
            </div>

            <form method="POST" action="{{ $route }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <x-input-label for="category_name" :value="__('Category Name')" />
                    <x-text-input id="category_name" name="category_name" type="text" class="mt-1 block w-full"
                        :value="old('category_name', $category->category_name)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('category_name')" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea-input id="description" name="description" class="mt-1 block w-full">{{ old('description', $category->description) }}</x-textarea-input>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div class="flex justify-end">
                    <x-secondary-button @click="open = false">Cancel</x-secondary-button>
                    <x-primary-button class="ml-2">{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
