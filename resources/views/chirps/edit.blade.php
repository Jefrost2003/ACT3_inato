<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form hx-post="{{ route('chirps.update', $chirp) }}" hx-target="body" hx-swap="outerHTML" hx-push-url="{{ route('chirps.index') }}" class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
            @csrf
            @method('patch')
            <textarea
                name="message"
                placeholder="{{ __('What\'s happening?') }}"
                class="block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-lg shadow-sm p-4 text-lg font-medium text-gray-800"
            >{{ old('message', $chirp->message) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2 text-sm text-red-600" />
            
            <div class="mt-6 space-x-4">
                <x-primary-button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full focus:outline-none">
                    {{ __('Save') }}
                </x-primary-button>
                <a href="{{ route('chirps.index') }}" hx-boost="true" hx-push-url="{{ route('chirps.index') }}" class="text-blue-500 hover:text-blue-600 font-semibold">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
