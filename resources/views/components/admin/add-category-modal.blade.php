{{-- resources/views/components/category-modal.blade.php --}}
@props([
    'show' => false,
    'route' => route('categories.store'),
])

<div x-data="{ open: {{ $show ? 'true' : 'false' }} }">
    <a href="#" @click.prevent="open = true">
        <x-primary-button>Add Category</x-primary-button>
    </a>

    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50 mx-2 bg-opacity-40 backdrop-blur-sm">
        <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Add Category</h2>
                <button @click="open = false" class="text-gray-600 hover:text-gray-900 text-2xl leading-none">&times;</button>
            </div>

            <form method="POST" action="{{ $route }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="category_name" :value="__('Category Name')" />
                    <x-text-input id="category_name" name="category_name" type="text" class="mt-1 block w-full" :value="old('category_name')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('category_name')" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea-input id="description" name="description" class="mt-1 block w-full">{{ old('description') }}</x-textarea-input>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div class="flex justify-end">
                    <x-secondary-button @click="open = false">Cancel</x-secondary-button>
                    <x-primary-button class="ml-2">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
