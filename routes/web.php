<?php

use App\Livewire\Kelolauser\Show;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'livewire.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('/suratmasuk', 'livewire.surat-masuk.filter')
    ->middleware(['auth', 'verified'])
    ->name('suratmasuk');
Route::view('/suratkeluar', 'livewire.surat-keluar.filter')
    ->middleware(['auth', 'verified'])
    ->name('suratkeluar');

Route::view('/surat', 'livewire.pinjamsurat')
    ->middleware(['auth', 'verified'])
    ->name('pengembalian');

Route::view('/kelola', 'livewire.kelolauser.show')
    ->middleware(['auth', 'verified'])
    ->name('kelolauser');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get("kelolauser",Show::class)->name("kelola");

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
