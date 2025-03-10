<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Chirp Form -->
        <form method="POST" action="{{ route('chirps.store') }}" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200" hx-post="{{ route('chirps.store') }}" hx-target="#chirps-list" hx-swap="beforeend">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('What\'s happening?') }}"
                class="block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-lg shadow-sm p-4 text-lg font-medium text-gray-800"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2 text-sm text-red-600" />
            <x-primary-button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full focus:outline-none">
                {{ __('Tweet🐦') }}
            </x-primary-button>
        </form>

        <!-- Chirps List -->
        <div id="chirps-list" class="mt-8 bg-white shadow-lg rounded-2xl divide-y divide-gray-200">
            @foreach ($chirps as $chirp)
                <div id="chirp-{{ $chirp->id }}" class="p-6 flex space-x-4 items-start">
                    <!-- Twitter Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-blue-700 font-semibold text-lg">{{ $chirp->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-500">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($chirp->created_at->eq($chirp->updated_at))
                                    <small class="text-sm text-gray-500"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                            @if ($chirp->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button class="text-gray-400 hover:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)" class="text-blue-600 hover:bg-blue-100">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}" hx-delete="{{ route('chirps.destroy', $chirp) }}" hx-target="#chirp-{{ $chirp->id }}" hx-swap="outerHTML">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-100">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-800 leading-relaxed">{{ $chirp->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
