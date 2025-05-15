<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Upload Material for "{{ $category->category_name }}"
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('martials.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="category_id" value="{{ $category->id }}">

                <div class="mb-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" required autofocus />
                    @error('title')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <x-input-label for="grade_id">Grade</x-input-label>
                    <select name="grade_id" id="grade_id" class="mt-1 block w-full" required>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-input-label for="term_no">Term</x-input-label>
                    <select name="term_no" id="term_no" class="mt-1 block w-full" required>
                        <option value="1">Term one</option>
                        <option value="2">Term two</option>
                        <option value="3">Term three</option>
                    </select>
                    @error('term_no')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-input-label for="price" :value="__('Price(Ksh)')" />
                    <x-text-input id="price" name="price" type="number" class="block mt-1 w-full" required />
                    @error('price')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-input-label for="file" :value="__('Upload PDF')" />
                    <input id="file" name="file" type="file" accept="application/pdf" class="mt-1 block w-full">
                    @error('file')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <x-primary-button>Upload</x-primary-button>
            </form>
        </div>
    </div>
</x-admin-layout>
