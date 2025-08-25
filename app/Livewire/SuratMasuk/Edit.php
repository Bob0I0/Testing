<?php

namespace App\Livewire\SuratMasuk;

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

        session()->flash('message', 'Data berhasil diperbarui.');

        // Dispatch event ke komponen Show untuk me-refresh tabel
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratMasuk\Index::class);
        return redirect()->to('/suratmasuk');
        $this->form->reset();
        $this->resetValidation(); 
    }
}
