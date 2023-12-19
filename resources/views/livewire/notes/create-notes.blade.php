<?php

use Livewire\Volt\Component;

new class extends Component {
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
        return $this->redirect(route('notes.index'), navigate: true);
    }
}; ?>

<div>
    <x-card>
        <form wire:submit='submit' class="space-y-4 ">
            <x-input wire:model='title' label="Title" />
            <x-textarea wire:model='body' label="Body" placeholder="Type your note" />
            <x-input icon="mail" wire:model='recipient' label="Recipient" type="email"
                placeholder="yourfriend@email.com" />
            <x-input icon="calendar" wire:model='send_date' type='date' label="Send Date" />
            <x-button primary right-icon="calendar" spinner wire:click='submit'>
                <span wire:loading wire:target="submit">Submitting...</span>
                <span wire:loading.remove wire:target="submit">Schedule Note</span>
            </x-button>
        </form>
    </x-card>
</div>
