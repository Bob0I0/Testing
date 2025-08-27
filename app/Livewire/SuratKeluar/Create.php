<?php

namespace App\Livewire\SuratKeluar;

use App\Helpers\Flash;
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
        $this->form->reset();
        $this->resetValidation();
        Flash::success("Surat Berhasil Ditambah");
        return redirect()->to('/suratkeluar');

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
