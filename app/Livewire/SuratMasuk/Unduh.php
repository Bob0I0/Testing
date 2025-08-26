<?php

namespace App\Livewire\SuratMasuk;

use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Unduh extends Component
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
        return view('livewire.surat-masuk.unduh');
    }
    
    public function download($suratMasukId)
    {
        $suratKeluar = SuratMasuk::findOrFail($suratMasukId);

        if (empty($suratKeluar->file)) { 
            session()->flash('error', 'File tidak ditemukan untuk surat ini.');
            return;
        }

        $filePathInDb = $suratKeluar->file;

        if (!Storage::exists($filePathInDb)) {
            $filePathInDb = 'public/' . $filePathInDb;
            if (!Storage::exists($filePathInDb)) {
                session()->flash('error', 'File fisik tidak ditemukan di server.');
                return;
            }
        }
        $fileName = $suratKeluar->nama_asli_file ?? basename($suratKeluar->file);

        return Storage::download($filePathInDb, $fileName);

        
    }
}
