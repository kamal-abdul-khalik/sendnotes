<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create a note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-button class="mb-12" slate icon="arrow-left" wire:navigate :href="route('notes.index')">All note</x-button>
            <livewire:notes.create-notes>
        </div>
    </div>
</x-app-layout>
