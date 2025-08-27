<?php

namespace App\Livewire\SuratKeluar;

use App\Helpers\Flash;
use App\Models\SuratKeluar;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\FormSuratKeluar;

class Edit extends Component
{
    use WithFileUploads;

    public FormSuratKeluar $form;

    public $suratKeluarId;

    public function mount($suratId) 
    {
        $this->suratKeluarId = $suratId;
        
        $surat = SuratKeluar::findOrFail($suratId); 

        $this->form->setSuratKeluar($surat);
    }

    public function render()
    {
        return view('livewire.surat-keluar.edit');
    }

    public function update()
    {
        $surat = SuratKeluar::findOrFail($this->suratKeluarId);
        $this->form->update($surat); 
        $this->form->reset();
        $this->resetValidation();
        Flash::success("Surat Berhasil Diedit");
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratKeluar\Show::class);
    }
}