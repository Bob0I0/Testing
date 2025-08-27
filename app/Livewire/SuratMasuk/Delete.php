<?php

namespace App\Livewire\SuratMasuk;

use App\Helpers\Flash;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

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
        return view('livewire.surat-masuk.delete');
    }

    public function delete()
    {
        $surat = SuratMasuk::findOrFail($this->suratId); 

        if ($surat->file) {
            $filePathOnDisk = str_replace('public/', '', $surat->file); 
            if (Storage::disk('public')->exists($filePathOnDisk)) {
                Storage::disk('public')->delete($filePathOnDisk);
            }
        }

        $surat->delete();

        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratMasuk\Index::class); 

    }
}
