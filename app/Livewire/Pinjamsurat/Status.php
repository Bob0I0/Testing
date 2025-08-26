<?php

namespace App\Livewire\Pinjamsurat;

use Livewire\Component;

class Status extends Component
{
    public $status = 'Pinjam'; 

    public function setStatusSelesai()
    {
        $this->status = 'Selesai';

    }
    public function render()
    {
        return view('livewire.pinjamsurat.status');
    }
}
