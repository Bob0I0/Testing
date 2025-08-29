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
    
    Route::get("suratmasuk",SuratMasukIndex::class)->name("suratmasuk")->middleware("permission:suratmasuk.create|suratmasuk.edit|suratmasuk.delete");

    Route::get("suratkeluar",SuratKeluarIndex::class)->name("suratkeluar")->middleware("permission:suratkeluar.create|suratkeluar.edit|suratkeluar.delete");

    Route::get('surat',PinjamSuratIndex::class)->name("pinjamsurat")->middleware("permission:pinjamsurat.create|pinjamsurat.edit|pinjamsurat.delete");

    Route::get("izin",IzinIndex::class)->name("izin")->middleware("permission:izin.create|izin.edit|izin.delete");

    Route::get("kelolauser",Show::class)->name("kelola")->middleware("permission:kelolauser.create|kelolauser.edit|kelolauser.delete");

    Route::get("testing",TestingPage::class)->name("testing");
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
