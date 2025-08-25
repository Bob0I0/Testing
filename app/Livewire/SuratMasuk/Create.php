<?php

namespace App\Livewire\SuratMasuk;

use App\Livewire\Forms\FormSuratMasuk;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    
    public FormSuratMasuk $form;
    
    public function simpan(){

        $this->form->create();
        return redirect()->to('/suratmasuk');
        session()->flash('berhasil', 'Data berhasil ditambahkan.');
        $this->form->reset();
        $this->resetValidation();
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratMasuk\Index::class);
    }
    
    public function resetForm()
    {
        $this->form->reset();

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.surat-masuk.create');
    }
}
