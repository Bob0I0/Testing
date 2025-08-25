<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $greeting;
    public $formattedDate;
    public $currentTime;

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
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
