<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <div class="bg-white shadow-md rounded p-6">
            @if (session('success'))
                <div class="text-green-600 mb-4">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        value="{{ old('name', $user->name) }}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="mb-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                        value="{{ old('phone', $user->phone) }}" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                </div>

                <div class="mb-4">
                    <x-input-label for="balance" :value="__('Balance')" />
                    <x-text-input id="balance" name="balance" type="number" step="0.01" class="mt-1 block w-full"
                        value="{{ old('balance', $user->balance) }}" />
                    <x-input-error :messages="$errors->get('balance')" class="mt-1" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="ml-4">
                        {{ __('Update User') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
