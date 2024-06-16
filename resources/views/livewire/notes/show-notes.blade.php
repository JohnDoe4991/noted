<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="font-bold text-x1">No notes yet</p>
                <p class="text-sm">Lets' create your first note to send.</p>
                <button class="px-4 py-2 mt-6 text-white rounded bg-rose-500 hover:bg-rose-600"
                    href="{{ route('notes.create') }}"wire:navigate>Create Note</button>
            </div>
        @else
            <div class="grid-cols-2 gap-4 mt-12">
                @foreach ($notes as $note)
                    <x-card wire:key='{{ $note->id }}'>
                        <div class="flex justify-between">
                            <a href='#'
                                class="text-xl font-bold hover:underline hover:text-blue-500">{{ $note->title }}</a>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs"> Recipient: <span class="font-semibold">{{ $note->recipient }}</span>
                            </p>
                            <div>
                                <button icon="eye" href="{{ route('notes.view', $note) }}"></button>
                                <button icon="trash" wire:click="delete('{{ $note->id }}')"></button>
                            </div>

                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
