<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Category Details
            </h2>
            <a href="{{ route('martials.create', $category->id) }}" class="text-blue-600 hover:underline text-sm">
                <x-primary-button> Add Material </x-primary-button>
            </a> 
        </div>
    </x-slot>    

    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900">{{ $category->category_name }}</h3>
        <p class="mt-2 text-gray-700">{{ $category->description }}</p>
    </div>

    <div class="px-6 flex row gap-3 flex-wrap pb-5">
        @foreach ($martials as $martial)
            <div class="bg-white p-3 rounded shadow flex-1 min-w-[250px] flex flex-col justify-center items-center">
                <div class="">
                    <h3 class="text-lg font-medium text-gray-900">Title: {{ $martial->title }}</h3>
                    <h6>Grade: {{ $martial->grade->name }}</h6>
                    <div class="flex gap-3">
                        <h6>Term: {{ $martial->term_no }}</h6>
                        <h6>Price: {{ $martial->price }}</h6>
                    </div>
                </div>
                <div class="flex gap-3 mt-2">
                    <a href="{{ asset('storage/' . $martial->file_path) }}" 
                        target="_blank" class="text-blue-600 hover:underline">
                        <x-secondary-button>View PDF</x-secondary-button> 
                    </a>

                    <form class="" action="{{ route('martials.destroy', $martial->id) }}" method="POST" 
                        onsubmit="return confirm('Are you sure you want to delete the material?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">
                            <x-danger-button> Delete </x-danger-button>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-admin-layout>

{{-- 542542 --}}
{{-- 23752 --}}