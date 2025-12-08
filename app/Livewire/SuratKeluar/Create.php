<?php

namespace App\Livewire\SuratKeluar;

use App\Helpers\Flash;
use App\Livewire\Forms\FormSuratKeluar;
use Livewire\Component;
use Livewire\WithFileUploads;
use Flux\Flux;

class Create extends Component
{
    use WithFileUploads;

    public FormSuratKeluar $form;
    
    public function simpan(){

        $this->form->create();
        $this->form->reset();
        $this->resetValidation();
        Flash::success("Surat Berhasil Ditambah");
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratKeluar\Show::class);

    }
    public function resetForm()
    {
        $this->form->reset();

        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.surat-keluar.create');
    }
}
