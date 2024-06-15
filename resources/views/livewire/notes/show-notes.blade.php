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
        <div class="grid-cols-2 gap-4 mt-12">
            @foreach ($notes as $note)
                <x-card wire:key='{{ $note->id }}'>
                    <div class="flex justify-between">
                        <a href='#'
                            class="text-xl font-bold hover:underline hover:text-blue-500">{{ $note->title }}</a>
                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs"> Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                        <div>
                            <button class="btn btn-circle btn-primary" onclick="viewNote()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 8v8a2 2 0 01-2 2H7a2 2 0 01-2-2V8m3-5h8m-4 5v3" />
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-danger" onclick="deleteNote()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                </x-card>
            @endforeach
        </div>
    </div>
</div>
