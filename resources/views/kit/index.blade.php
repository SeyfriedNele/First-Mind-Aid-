<x-app-layout>
    <x-backdrop>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kits') }}
            </h2>
        </x-slot>

        <ul class="list-disc pl-6 text-gray-900 dark:text-gray-100">
            @forelse($kits as $kit)
                <li>
                    <a href="{{ route('kit.show', $kit) }}" class="text-blue-600 hover:underline">
                        {{ $kit->title }}
                    </a>

                </li>

            @empty
                <li class="text-gray-500 dark:text-gray-400">Keine Einträge vorhanden.</li>
            @endforelse
        </ul>

        <x-slot name="footer">
            <div class="flex justify-end">
        <x-primary-button
            onclick="window.location='{{ route('kit.create') }}'"
            class="bg-yellow-200 text-black hover:bg-yellow-300">
            Create Kit
        </x-primary-button>
            </div>
        </x-slot>
    </x-backdrop>
</x-app-layout>
