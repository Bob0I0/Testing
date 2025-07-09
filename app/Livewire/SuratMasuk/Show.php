<?php

namespace App\Livewire\SuratMasuk;

use Livewire\Component;
use App\Models\SuratMasuk;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {

        $query = SuratMasuk::query();

        $suratMasuks = $query->paginate(10);
        
        return view('livewire.surat-masuk.show', [
            'suratMasuks' => $suratMasuks, 
        ]);
    }

}