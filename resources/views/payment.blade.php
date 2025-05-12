<!-- resources/views/payment.blade.php -->
@php
    $balance_difference = session('total') - session('userBalance');
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Payment
        </h2>
    </x-slot>

    <div class="p-4">
        <div class="p-4 bg-white rounded shadow text-center">
            <h3 class="text-red-800 text-center text-lg">Your balance is insufficient to complete the purchase.</h3>
            <div class="my-4 text-base">
                <h4>Your wallet balance is: 
                    <span class="text-green-900 text-lg">Ksh. {{ session('userBalance') }}</span>
                </h4>
                
                <h4>Total expect payment:
                    <span class="text-green-900 text-lg">Ksh. {{ session('total') }}</span>
                </h4>
            </div>
            <p>Please add  
                <span class="text-green-900 text-lg">Ksh. {{ $balance_difference }}</span>
                to your wallet to download.
            </p>
        </div>

        <div id="notification" style="margin-top: 30px;" class="m-6">
            @if (session('success'))
                <h5 class="bg-green-500 p-4 rounded text-center " >
                    <span class="bg-green-500 p-2">{{ session('success') }} </span>
                </h5>
            @endif
                
            @if (session('error'))
                <h5 class="bg-red-400 p-4 rounded text-center" >
                    <span class="">{{ session('error') }}</span>
                </h5>
            @endif
        </div>
        
        <div class="p-6 bg-white rounded shadow my-6" style="margin-top: 10px;">
            <form id="mpesa-form" action="{{ route('stk.push') }}" method="POST" 
            class="flex gap-4 align-center justify-center flex-wrap">
                @csrf
                {{-- <label for="phone">Phone: </label> --}}
                <input hidden type="text" name="phone" value={{ session('phone') }} placeholder="Phone number (2547...)" required>
                {{-- <label for="amount">Amount: </label> --}}
                <input hidden type="number" name="amount" value={{ $balance_difference }} placeholder="Amount" required>
                {{-- <button >Pay via M-Pesa</button> --}}

                <div class="text-center">
                    <p>
                        <span class="text-xl">M-Pesa Number:</span>
                        <span class="text-blue-900 text-2xl">{{ session('phone') }}</span>   
                    </p>
                    <p class="mb-4">
                        <span class="text-xl">Amount:</span>
                        <span class="text-blue-900 text-2xl">Ksh. {{ $balance_difference }}</span>   
                    </p>

                    <x-blue-button id="mpesa-button" type="submit">
                        <span id="button-text">Pay via M-Pesa</span>
                        <svg id="loader" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </x-blue-button>
                </div>
            </form>        
        </div>

        <div>
            <p class="text-lg">For help, contact Judy: 
                <h2 class="font-large text-xl text-blue-900">0707716356</h2>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('mpesa-form').addEventListener('submit', function () {
            const button = document.getElementById('mpesa-button');
            const loader = document.getElementById('loader');
            const text = document.getElementById('button-text');
    console.log("Hellow")
            button.disabled = true;
            loader.classList.remove('hidden');
            text.textContent = 'Processing...';
        });
    </script>
    
    @if(session('session-details'))
    <script>
        setInterval(async () => {
            try {
                const res = await fetch('/api/check-payment-status?phone=0714475702&total={{ session('total') }}');
                const data = await res.json();
                if (data.paid) {
                    window.location.href = "{{ route('checkout.page') }}";
                }
            } catch (err) {
                console.error('Payment status check failed:', err);
            }
        }, 3000);
    </script>
    @endif

</x-app-layout>