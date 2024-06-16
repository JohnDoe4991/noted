<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }
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
                <p class="text-xl font-bold">No notes yet</p>
                <p class="text-sm">Let's create your first note to send.</p>
                <button class="px-4 py-2 mt-6 text-white rounded bg-rose-500 hover:bg-rose-600"
                    href="{{ route('notes.create') }}" wire:navigate>Create Note</button>
            </div>
        @else
            <div class="text-center">
                <button class="px-4 py-2 mt-6 mb-8 text-white rounded bg-rose-500 hover:bg-rose-600"
                    href="{{ route('notes.create') }}" wire:navigate>Create Note</button>
            </div>
            <div class="grid grid-cols-1 gap-4 mt-12 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($notes as $note)
                    <x-card wire:key='{{ $note->id }}'>
                        <div class="flex justify-between">
                            <div>
                                <a href='{{ route('notes.edit', $note) }}' wire:navigate
                                    class="text-xl font-bold hover:underline hover:text-blue-500">{{ $note->title }}</a>
                                <p class="mt-2 text-xs">{{ Str::limit($note->body, 50) }}</p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span>
                            </p>
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
                                <button class="btn btn-circle btn-danger" wire:click="delete('{{ $note->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
