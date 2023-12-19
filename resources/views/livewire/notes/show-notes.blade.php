<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public function delete(Note $note)
    {
        $this->authorize('delete', $note);
        $note->delete();
    }

    public function with(): array
    {
        return [
            'notes' => auth()
                ->user()
                ->notes()
                ->orderBy('send_date', 'asc')
                // ->published()
                ->get(),
        ];
    }
}; ?>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        @if ($notes->isEmpty())
            <x-card class="space-y-5 text-center">
                <p class="font-bold text-gray-600 ">No notes yet</p>
                <p class="text-gray-600">Let's create your first notes to send.</p>
                <x-button icon="plus" primary label="Create new note." :href="route('notes.create')" wire:navigate />
            </x-card>
        @else
            <x-button class="mb-12" icon="plus" primary label="Create new note." :href="route('notes.create')" wire:navigate />
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($notes as $note)
                    <x-card wire:key='{{ $note->id }}'>
                        <h2 class="mb-2 text-lg font-semibold hover:text-blue-400">
                            <a href="{{ route('notes.edit', $note) }}" wire:navigate>{{ $note->title }}</a>
                        </h2>
                        <p class="mb-4 text-xs">Recipient:
                            <span class="font-semibold text-info-500">{{ $note->recipient }}</span>
                        </p>
                        <div class="flex justify-between mt-4 space-x-1 item-end">
                            <p class="text-sm text-gray-400">
                                {{ \Carbon\Carbon::parse($note->send_date)->diffForhumans() }}
                            </p>
                            <div class="space-x-1">
                                <x-button.circle xs info icon="eye" />
                                <x-button.circle xs negative icon="trash"
                                    wire:click="delete('{{ $note->id }}')" />
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
