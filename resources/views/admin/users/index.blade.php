<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Users
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Phone</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-left">Balance</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm divide-y divide-gray-200">
                @foreach ($users as $index => $user)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->phone }}</td>
                        <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                        <td class="px-6 py-4">Ksh {{ number_format($user->balance ?? 0, 2) }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('users.show', $user->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                                View
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600">
                                Edit
                            </a>
                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($users->isEmpty())
            <div class="text-center text-gray-500 py-6">
                No users found.
            </div>
        @endif
    </div>
</x-admin-layout>


{{-- 542542 --}}
{{-- 23752 --}}