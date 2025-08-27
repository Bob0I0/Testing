<?php

namespace App\Livewire\Pinjamsurat;

use App\Livewire\Forms\FormPinjamSurat;
use App\Models\PinjamSurat;
use Livewire\Component;

class Status extends Component
{
    public $status = 'Pinjam'; 
    public FormPinjamSurat $form;

    public $pinjamSuratId;

    public function setStatusSelesai()
    {
        $this->status = 'Selesai';

    }

    // public function mount($suratId) 
    // {
    //     $this->pinjamSuratId = $suratId;
        
    //     PinjamSurat::findOrFail($suratId); 
    // }
    public function updatekembali()
    {
        $this->validate([
            'tanggal_kembali' => 'required|after_or_equal:tanggal_pinjam',
        ]);

        $surat = PinjamSurat::findOrFail($this->pinjamSuratId);

        $dateFromInput2 = trim($this->tanggal_kembali);
        $formattedDate2 =  date("Y-m-d", strtotime($dateFromInput2));
        
        $surat->form->update([
            'tanggal_kembali' => $this->$formattedDate2,
        ]);
        
        $this->dispatch('suratUpdated')->to(\App\Livewire\Pinjamsurat\Index::class);

        session()->flash('message', 'Pengembalian berhasil dicatat.');
        $this->form->reset();
        $this->resetValidation();
        return redirect()->to('/surat');
    }
    
    public function resetForm()
    {
        $this->reset();

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.pinjamsurat.status');
    }
}
