<?php

namespace App\Livewire\Pinjamsurat;

use App\Helpers\Flash;
use App\Models\PinjamSurat;
use Livewire\Component;

class Delete extends Component
{
    public $suratId;  
    public $nomorSurat; 

    public function mount($suratId, $nomorSurat)
    {
        $this->suratId = $suratId;
        $this->nomorSurat = $nomorSurat;
    }

    public function delete()
    {
        $surat = PinjamSurat::findOrFail($this->suratId); 
        $surat->delete(); 

        Flash::success("Surat Berhasil dihapus");
        $this->dispatch('suratUpdated')->to(\App\Livewire\Pinjamsurat\Index::class);

    }

    public function render()
    {
        return view('livewire.pinjamsurat.delete');
    }
}
