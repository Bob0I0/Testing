<?php

namespace App\Livewire\SuratMasuk;

use App\Helpers\Flash;
use App\Livewire\Forms\FormSuratMasuk;
use App\Models\SuratMasuk;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public FormSuratMasuk $form;

    public $suratMasukId;

    public function mount($suratId) 
    {
        $this->suratMasukId = $suratId;
        
        $surat = SuratMasuk::findOrFail($suratId); 

        $this->form->setSuratMasuk($surat);
    }

    public function render()
    {
        return view('livewire.surat-masuk.edit');
    }

    public function update()
    {
        $surat = SuratMasuk::findOrFail($this->suratMasukId);
        $this->form->update($surat); 
        $this->form->reset();
        $this->resetValidation();
        
        Flash::success("Surat Berhasil Diedit");
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratMasuk\Index::class);
         
    }
}
