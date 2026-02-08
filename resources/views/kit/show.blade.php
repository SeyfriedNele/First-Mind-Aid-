<x-app-layout>
    <x-backdrop>
        
    <x-slot name="header">
        <h2 class="text-xl font-semibold {{ $textClass ?? '' }}">{{ $kit->title }}</h2>
    </x-slot>

        <div class="mt-4">
            @if($kit->post)
                <p class="text-zinc-300">
                    {{ $kit->post }}
                </p>
            @else
                <p class="text-zinc-500 italic">
                    Keine Beschreibung vorhanden.
                </p>
            @endif
            <p class="text-sm text-zinc-400 mt-2">
                Erstellt am {{ $kit->created_at->format('d.m.Y H:i') }}
            </p>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center gap-x-6">
                <a href="{{ route('kit.index') }}" class="text-sm/6 font-semibold text-yellow-200">Back</a>

                @if (Auth::id() === $kit->created_by)
                <x-button
                    form="edit-form"
                    href="{{ route('kit.edit', $kit) }}"
                    class="rounded-md bg-zinc-800 px-3 py-2 text-sm font-semibold text-white"
                >
                    Edit Kit
                </x-button>
            </div>

            <div>
                <button
                    form="delete-form"
                    class="rounded-md bg-yellow-200 px-3 py-2 text-sm font-bold text-black"
                >
                    Delete
                </button>
            </div>
                @endif
        </div>

        <form
            method="POST"
            action="/kit/{{ $kit->id }}"
            id="delete-form"
            id="edit-form"
            class="hidden"
        >
            @csrf
            @method('DELETE')
        </form>
    </x-backdrop>
</x-app-layout>
``