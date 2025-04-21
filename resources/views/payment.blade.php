<!-- resources/views/payment.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Payment
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="p-6 bg-white rounded shadow">
            <h3>Your balance is insufficient to complete the purchase.</h3>
            <h4>Your wallet balance is: {{ session('userBalance') }}</h4>
            <h4>Total expect payment: {{ session('total') }}</h4>
            <p>Please add Ksh. {{ session('total') - session('userBalance') }} 
                to your wallet to continue by sending the cash to Judy:
            </p>
            <h2 class="font-medium text-yellow-90">0707716356</h2>
        </div>

        {{-- <a href="{{ route('add.funds') }}" class="text-blue-600 hover:underline">Add Funds</a> --}}
    </div>
</x-app-layout>
