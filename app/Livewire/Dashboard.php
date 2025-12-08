<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $greeting;
    public $formattedDate;
    public $jumlahPenggunaAktif;
    public $totalSuratMasuk;
    public $totalSuratKeluar;

    public function mount()
    {
        Carbon::setLocale('id');

        $now = Carbon::now();
        $hour = $now->hour;
        $this->greeting = ''; 

        if ($hour >= 3 && $hour < 10) {
            $this->greeting = 'Selamat Pagi';
        } elseif ($hour >= 10 && $hour < 15) {
            $this->greeting = 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $this->greeting = 'Selamat Sore';
        } else {
            $this->greeting = 'Selamat Malam';
        }

        $this->formattedDate = $now->isoFormat('dddd, DD MMMM YYYY');

        $activeSince = Carbon::now()->subMinutes(10)->timestamp;

        $this->jumlahPenggunaAktif = DB::table('sessions')
                                    ->whereNotNull('user_id')
                                    ->where('last_activity', '>', $activeSince)
                                    ->distinct()
                                    ->count('user_id');
        
        $this->totalSuratMasuk = DB::table('surat_masuks')->count();
        $this->totalSuratKeluar = DB::table('surat_keluars')->count();

    }
    
    public function render()
    {
        return view('livewire.dashboard');
    }
}
