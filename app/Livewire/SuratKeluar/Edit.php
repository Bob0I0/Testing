<?php

namespace App\Livewire\SuratKeluar;

use App\Models\SuratKeluar;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\FormSuratKeluar; // Import Form Object Anda

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

        session()->flash('message', 'Data berhasil diperbarui.');

        // // Dispatch event untuk menutup modal Flux
        // $this->dispatch('close-modal', 'edit-'.$this->suratKeluarId);

        // Dispatch event ke komponen Show untuk me-refresh tabel
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratKeluar\Show::class);
        return redirect()->to('/suratkeluar');
        $this->form->reset();
        $this->resetValidation(); 
    }
}