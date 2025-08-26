<?php

namespace App\Livewire\SuratKeluar;

use Livewire\Component;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public $suratId;
    public $nomorSurat; 

    public function mount($suratId, $nomorSurat)
    {
        $this->suratId = $suratId;
        $this->nomorSurat = $nomorSurat;
    }

    public function render()
    {
        return view('livewire.surat-keluar.delete');
    }

    public function delete()
    {
        $surat = SuratKeluar::findOrFail($this->suratId); 

        if ($surat->file) {
            $filePathOnDisk = str_replace('public/', '', $surat->file); 
    
            if (Storage::disk('public')->exists($filePathOnDisk)) {
                Storage::disk('public')->delete($filePathOnDisk);
            }
        }

        $surat->delete(); // Hapus record dari database

        // Berikan pesan sukses ke sesi flash - PASTIKAN PESAN SESUAI DENGAN SuratKeluar
        session()->flash('message', 'Surat Keluar dengan nomor ' . $this->nomorSurat . ' berhasil dihapus.');

        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratKeluar\Show::class); 

    }
}