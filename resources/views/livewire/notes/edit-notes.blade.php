<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $title;
    public $body;
    public $recipient;
    public $send_date;
    public $is_published;

    public function saveNote()
    {
        $validated = $this->validate([
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:3|max:255',
            'recipient' => 'required|email',
            'send_date' => 'required|date',
            'is_published' => 'boolean',
        ]);
        $this->submitting = true;
        $this->note->update($validated);
        $this->submitting = false;
        $this->dispatch('note-saved');
    }

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->title = $note->title;
        $this->body = $note->body;
        $this->recipient = $note->recipient;
        $this->send_date = $note->send_date;
        $this->is_published = $note->is_published;
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Edit Note : ' . $note->title) }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <form wire:submit='saveNote' class="space-y-4 ">
                <x-action-message on="note-saved" />
                <x-input wire:model='title' label="Title" />
                <x-textarea wire:model='body' label="Body" placeholder="Type your note" />
                <x-input icon="mail" wire:model='recipient' label="Recipient" type="email"
                    placeholder="yourfriend@email.com" />
                <x-input icon="calendar" wire:model='send_date' type='date' label="Send Date" />
                <x-toggle label="Published" wire:model="is_published" />
                <div class="flex justify-between">
                    <x-button :href="route('notes.index')" flat slate icon="arrow-left" wire:navigate>Back</x-button>
                    <x-button primary right-icon="paper-airplane" spinner type='saveNote'>
                        <span wire:loading wire:target="saveNote">Saving Note...</span>
                        <span wire:loading.remove wire:target="saveNote">Save Note</span>
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</div>
