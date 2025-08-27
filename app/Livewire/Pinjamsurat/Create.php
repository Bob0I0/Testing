<?php

namespace App\Livewire\Pinjamsurat;

use App\Livewire\Forms\FormPinjamSurat;
use Livewire\Component;

class Create extends Component
{
    public FormPinjamSurat $form;
    
    public function simpan(){

        $this->form->create();
        return redirect()->to('/surat');
        session()->flash('berhasil', 'Data berhasil ditambahkan.');
        $this->form->reset();
        $this->resetValidation();
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
