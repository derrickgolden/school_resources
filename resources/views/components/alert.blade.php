@props([
    'message',
    'bg' => 'bg-green-500'
])
<div 
x-data="{ show: false }"
x-init="setTimeout(() => show = true, 100); setTimeout(() => show = false, 3100)" 
x-show="show"
x-cloak
x-transition:enter="transition ease-out duration-500"
x-transition:enter-start="opacity-0 -translate-y-10"
x-transition:enter-end="opacity-100 translate-y-0"
x-transition:leave="transition ease-in duration-500"
x-transition:leave-start="opacity-100 translate-y-0"
x-transition:leave-end="opacity-0 -translate-y-10"
class="fixed top-6 left-1/2 transform -translate-x-1/2 {{ $bg }} text-white px-6 py-3 rounded shadow-lg z-50 text-sm sm:text-base"
>
{{ $message }}
</div>
