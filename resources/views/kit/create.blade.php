<x-app-layout>
    <x-slot:heading>
        you can add to the Kit
</x-slot:heading>

    <x-backdrop title="You can add to your collection of Kits.">
        <form method="POST" action="{{ route('kit.store') }}">
            @csrf

            <div class="space-y-12">
                <div class="border-b border-white/10 pb-12">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm/6 font-medium text-white">Title</label>
                            <div class="mt-2">
                                <div class="flex w-60 items-center rounded-md bg-zinc-800 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                    <x-text-input
                                        id="title"
                                        name="title"
                                        type="text"
                                        value="{{ old('title') }}"
                                        placeholder="Your kit title"
                                        class="block min-w-0 grow bg-zinc-700 py-1.5 pr-3 pl-1 text-base text-black placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        required
                                    />
                                </div>
                                @error('title')
                                    <p class="text-xs text-yellow-200 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="post" class="block text-sm/6 font-medium text-white">Post</label>
                            <div class="mt-2">
                                <x-text-input
                                    id="post"
                                    name="post"
                                    rows="6"
                                    class="block w-full rounded-md bg-zinc-700 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10"
                                    value="{{ old('post') }}"
                                    placeholder="Describe your kit (optional)"
                                >{{ old('post') }}</x-text-input>
                            </div>
                            @error('post')
                                <p class="text-xs text-yellow-200 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-x-6">
                <a href="{{ route('kit.index') }}" class="text-sm/6 font-semibold text-yellow-200">Back</a>
                <button
                    type="submit"
                    class="rounded-md bg-zinc-800 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Save
                </button>
            </div>

        </form>
    </x-backdrop>
</x-app-layout>
