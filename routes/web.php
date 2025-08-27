<?php

use App\Livewire\Dashboard;
use App\Livewire\Izin\Index as IzinIndex;
use App\Livewire\Kelolauser\Show;
use App\Livewire\Pinjamsurat\Index as PinjamSuratIndex;
use App\Livewire\SuratKeluar\Show as SuratKeluarIndex;
use App\Livewire\SuratMasuk\Index as SuratMasukIndex;
use App\Livewire\TestingPage;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::redirect('/', '/login');

Route::view('dashboard', 'livewire.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('/kelola', 'livewire.kelolauser.show')
    ->middleware(['auth', 'verified'])
    ->name('kelolauser');

Route::middleware(['auth'])->group(function () {
    Route::get("dashboard",Dashboard::class)->name("dashboard");

    Route::redirect('settings', 'settings/profile');

    Route::get("suratmasuk",SuratMasukIndex::class)->name("suratmasuk");

    Route::get("suratkeluar",SuratKeluarIndex::class)->name("suratkeluar");

    Route::get('surat',PinjamSuratIndex::class)->name("pinjamsurat");

    Route::get("izin",IzinIndex::class)->name("izin");

    Route::get("kelolauser",Show::class)->name("kelola");

    Route::get("testing",TestingPage::class)->name("testing");

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
