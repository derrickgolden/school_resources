
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Category Details
            </h2>
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm">
                <x-primary-button> Go Back </x-primary-button>
            </a> 
        </div>
    </x-slot>    

    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900">{{ $category->category_name }}</h3>
        <p class="mt-2 text-gray-700">{{ $category->description }}</p>
    </div>

    <div class="px-6 flex gap-3 flex-wrap">
        @foreach ($martials as $martial)
            <div class="bg-white p-3 rounded shadow min-w-[250px] max-w-[400px] flex-1">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Title: 
                        <span class="text-yellow-900 capitalize">{{ $martial->title }}</span>
                    </h3>
                    <div class="flex gap-3 ">
                        <h6>Grade: <span class="text-red-800">{{ $martial->grade->name }}</span></h6>
                        <h6>|</h6>
                        <h6>Term: <span class="text-red-800">{{ $martial->term_no }}</span></h6>
                    </div>
                    <div class="flex justify-between">
                        <h6>
                            <p class="text-sm text-gray-600">Last Update:</p> 
                            <p class="text-green-800">{{ $martial->updated_at }}</p> 
                        </h6>
                        <h6>
                            <p class="text-sm text-gray-600">Price:</p> 
                            <p class="text-blue-950 font-bold">Ksh.{{ $martial->price }}</p> 
                        </h6>
                    </div>
                </div>
                <div class="flex gap-3 justify-center pt-3">
                    @auth
                        @if(in_array($martial->id, $paidMartialIds))
                            {{-- Show View and Download if paid --}}
                            <a href="{{ asset('storage/' . $martial->file_path) }}" 
                                target="_blank" class="text-blue-600 hover:underline">
                                <x-secondary-button>View PDF</x-secondary-button> 
                            </a>

                            <a href="{{ route('martial.download', $martial->id) }}">
                                <x-primary-button>Download</x-primary-button>
                            </a>
                        @else
                            {{-- Show Add to Cart if not paid --}}
                            <form action="{{ route('cart.add', $martial->id) }}" method="POST">
                                @csrf
                                <x-primary-button>Add To Cart</x-primary-button>
                            </form>
                        @endif
                    @else
                        {{-- Guest view: show Add to Cart --}}
                        <form action="{{ route('cart.add', $martial->id) }}" method="POST">
                            @csrf
                            <x-primary-button>Add To Cart</x-primary-button>
                        </form>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
