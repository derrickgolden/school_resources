
@php
    $cart = session('cart', []);
    $total = collect($cart)->sum('price');
@endphp

<!-- Checkout Trigger Button -->
@if (count($cart))
    <div x-cloak x-data="{ open: false }" class="">
        <button @click="open = true" class="flex items-center gap-2 bg-blue-600 text-white px-3 py-1 rounded-full hover:bg-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden sm:block" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6h12.4M7 13L5.4 5M16 16a1 1 0 100 2 1 1 0 000-2zm-8 0a1 1 0 100 2 1 1 0 000-2z" />
            </svg>
            <span>Checkout</span>
            <span class="bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">{{ count($cart) }}</span>
        </button>

        <!-- Modal -->
        <div x-show="open" class="fixed inset-0 flex items-center justify-center p-2 bg-black bg-opacity-40 z-50">
    <div class="bg-white w-full max-w-2xl p-6 rounded shadow-lg relative" @click.away="open = false">
        <h2 class="text-xl font-bold mb-4">Your Cart</h2>

        <table class="w-full text-sm mb-4">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Title</th>
                    <th class="text-left py-2">Price</th>
                    <th class="text-left py-2">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $index => $item)
                    <tr class="border-b">
                        <td class="py-2">{{ $item['title'] }}</td>
                        <td class="py-2">Ksh {{ number_format($item['price']) }}</td>
                        <td class="py-2">
                            <form method="POST" action="{{ route('cart.remove', $index) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between items-center mt-4">
            <div class="text-lg font-semibold">Total: Ksh {{ number_format($total) }}</div>
            <div class="flex gap-2">
                <button @click="open = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Close</button>
                <a href="{{ route('checkout.page') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Proceed</a>
            </div>
        </div>
    </div>
</div>

    </div>
@endif
