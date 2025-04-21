<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                User Details
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-x-auto">
        <div class="container mx-auto p-4">        
            <div class="bg-white shadow-md rounded p-4 mb-6">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
                <p><strong>Joined:</strong> {{ $user->created_at->format('F d, Y') }}</p>
            </div>
        
            <h3 class="text-xl font-semibold mb-2">Materials Bought</h3>
        
            @if($user->materials && $user->materials->count())
                <ul class="bg-white shadow rounded p-4 space-y-2">
                    @foreach($user->materials as $material)
                        <li class="border-b pb-2">
                            <strong>{{ $material->title }}</strong> <br>
                            <span class="text-sm text-gray-600">Bought on {{ $material->pivot->created_at->format('F d, Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">This user hasn't bought any materials yet.</p>
            @endif
        </div>
    </div>
</x-admin-layout>
