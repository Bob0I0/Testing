<?php

namespace App\Livewire\SuratMasuk;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\SuratMasuk; 

class Create extends Component
{
    use WithFileUploads;

    public $nomor_surat;
    public $asal_surat;
    public $perihal;
    public $tanggal_surat;
    public $jenis_surat;
    public $file;

    public function render()
    {
        return view('livewire.surat-masuk.create');
    }

    public function save()
    {
        $this->validate([
            'nomor_surat' => 'required|string|max:255',
            'asal_surat' => 'required|string|max:255',
            'perihal' => 'string',
            'tanggal_surat' => 'required|date',
            'jenis_surat' => 'required|string|max:255', 
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', 
        ]);
        $filePath = null; 
        if ($this->file) {
            $filePath = $this->file->store('public/surat_files');
        }
        SuratMasuk::create([
            "nomor_surat" => $this->nomor_surat,
            "asal_surat" => $this->asal_surat,
            "perihal" => $this->perihal,
            "tanggal_surat" => $this->tanggal_surat,
            "jenis_surat" => $this->jenis_surat,
            "file" => $filePath
        ]);
        session()->flash('message', 'Data berhasil disimpan.');
    }

}
