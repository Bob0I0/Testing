<?php

namespace App\Livewire\Pinjamsurat;

use App\Helpers\Flash;
use App\Livewire\Forms\FormPinjamSurat;
use App\Models\PinjamSurat;
use Livewire\Component;

class Edit extends Component
{

    public FormPinjamSurat $form;

    public $pinjamSuratId;

    public function mount($suratId) 
    {
        $this->pinjamSuratId = $suratId;
        
        $surat = PinjamSurat::findOrFail($suratId); 

        $this->form->setPinjamSurat($surat);
    }

    public function update()
    {
        $surat = PinjamSurat::findOrFail($this->pinjamSuratId);
        $this->form->update($surat); 
        $this->form->reset();
        $this->resetValidation(); 
        Flash::success("Detail Berhasil diedit");
        $this->dispatch('suratUpdated')->to(\App\Livewire\Pinjamsurat\Index::class);

    }
    public function render()
    {
        return view('livewire.pinjamsurat.edit');
    }
}
