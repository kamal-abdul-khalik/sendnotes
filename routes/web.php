<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
    // Route::view('notes', 'notes.index')->name('notes.index');
    Volt::route('notes', 'notes.show-notes')->name('notes.index');
    // Route::view('notes/create', 'notes.create')->name('notes.create');
    Volt::route('notes/create', 'notes.create-notes')->name('notes.create');
    Volt::route('notes/{note}/edit', 'notes.edit-notes')->name('notes.edit');
});

require __DIR__ . '/auth.php';
