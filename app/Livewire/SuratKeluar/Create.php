<?php

namespace App\Livewire\SuratKeluar;

use App\Livewire\Forms\FormSuratKeluar;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    
    public $showModal = false;

    public FormSuratKeluar $form;
    
    public function simpan(){

        $this->form->create();
        return redirect()->to('/suratkeluar');
        $this->form->reset();
        $this->resetValidation();
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
