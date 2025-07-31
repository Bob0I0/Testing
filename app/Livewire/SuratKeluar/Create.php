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
        session()->flash('berhasil', 'Data berhasil ditambahkan.');
        $this->form->reset();
        $this->resetValidation();
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratKeluar\Show::class);
       

        // $this->validate();
        // $dateFromInput = trim($this->form->tanggal_surat);
        // $formattedDate =  date("Y-m-d", strtotime($dateFromInput));
        // SuratKeluar::create([
        //     "nomor_surat" => $this->form->nomor_surat,
        //     "tujuan_surat" => $this->form->tujuan_surat, 
        //     "perihal" => $this->form->perihal, 
        //     "tanggal_surat" => $formattedDate,
        //     "jenis_surat" => $this->form->jenis_surat,
        //     "file" => $this->form->file->store(path:'public/file_SKeluar')
        // ]);
        // $this->showModal = false;
        // $this->resetForm();
        // // $this->redirect('/suratkeluar');
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
