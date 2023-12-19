<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    public $title;
    public $body;
    public $recipient;
    public $send_date;

    public $submitting = false;

    public function submit()
    {
        $validated = $this->validate([
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:3|max:255',
            'recipient' => 'required|email',
            'send_date' => 'required|date',
        ]);
        $this->submitting = true;
        auth()
            ->user()
            ->notes()
            ->create($validated);
        $this->reset();
        $this->submitting = false;
        $this->redirect(route('notes.index'));
    }
}; ?>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <form wire:submit='submit' class="space-y-4 ">
                <x-input wire:model='title' label="Title" />
                <x-textarea wire:model='body' label="Body" placeholder="Type your note" />
                <x-input icon="mail" wire:model='recipient' label="Recipient" type="email"
                    placeholder="yourfriend@email.com" />
                <x-input icon="calendar" wire:model='send_date' type='date' label="Send Date" />
                <div class="flex justify-between">
                    <x-button :href="route('notes.index')" flat slate icon="arrow-left" wire:navigate>Back</x-button>
                    <x-button primary right-icon="calendar" spinner type='submit'>
                        <span wire:loading wire:target="submit">Submitting...</span>
                        <span wire:loading.remove wire:target="submit">Schedule Note</span>
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</div>
