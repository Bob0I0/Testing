<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'livewire.komponen.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('/suratmasuk', 'livewire.surat-masuk.filter')
    ->middleware(['auth', 'verified'])
    ->name('suratmasuk');
Route::view('/suratkeluar', 'livewire.surat-keluar.filter')
    ->middleware(['auth', 'verified'])
    ->name('suratkeluar');

Route::view('/peminjaman', 'surat.peminjaman')
    ->middleware(['auth', 'verified'])
    ->name('peminjaman');
Route::view('/pengembalian', 'surat.pengembalian')
    ->middleware(['auth', 'verified'])
    ->name('pengembalian');

Route::view('/kelola', 'kelolauser')
    ->middleware(['auth', 'verified'])
    ->name('kelolauser');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
