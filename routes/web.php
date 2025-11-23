<?php

use App\Livewire\Dashboard;
use App\Livewire\Izin\Index as IzinIndex;
use App\Livewire\Kelolauser\Show;
use App\Livewire\Pinjamsurat\Index as PinjamSuratIndex;
use App\Livewire\SuratKeluar\Show as SuratKeluarIndex;
use App\Livewire\SuratMasuk\Index as SuratMasukIndex;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function () {
    Route::get("dashboard",Dashboard::class)->name("dashboard");
    
    Route::get("suratmasuk",SuratMasukIndex::class)->name("suratmasuk")->middleware("permission:suratmasuk.create|suratmasuk.edit|suratmasuk.delete");

    Route::get("suratkeluar",SuratKeluarIndex::class)->name("suratkeluar")->middleware("permission:suratkeluar.create|suratkeluar.edit|suratkeluar.delete");

    Route::get('surat',PinjamSuratIndex::class)->name("pinjamsurat")->middleware("permission:pinjamsurat.create|pinjamsurat.edit|pinjamsurat.delete");

    Route::get("izin",IzinIndex::class)->name("izin")->middleware("permission:izin.create|izin.edit|izin.delete");

    Route::get("kelolauser",Show::class)->name("kelola")->middleware("permission:kelolauser.create|kelolauser.edit|kelolauser.delete");
});

require __DIR__.'/auth.php';
