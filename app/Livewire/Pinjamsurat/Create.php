<?php

namespace App\Livewire\Pinjamsurat;

use App\Helpers\Flash;
use App\Livewire\Forms\FormPinjamSurat;
use Livewire\Component;

class Create extends Component
{
    public FormPinjamSurat $form;
    
    public function simpan(){

        $this->form->create();
        $this->form->reset();
        $this->resetValidation();
        Flash::success("Surat Berhasil Ditambahkan");
        $this->dispatch('suratUpdated')->to(\App\Livewire\Pinjamsurat\Index::class);

    }
    
    public function resetForm()
    {
        $this->form->reset();

        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.pinjamsurat.create');
    }
}
