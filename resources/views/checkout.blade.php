<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Download Page</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-4 rounded shadow">
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left">Title</th>
                        <th class="border px-4 py-2 text-left">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item['title'] }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('martial.download', $id) }}" class="text-blue-600 underline">Download</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
