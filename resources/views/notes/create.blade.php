<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <button icon="arrow-left" class="px-4 py-2 mt-6 mb-8 text-white rounded bg-rose-500 hover:bg-rose-600"
                href="{{ route('notes.index') }}" wire:navigate>All Notes</button>
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>
