<?php

namespace App\Livewire\SuratMasuk;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\SuratMasuk; 
use DateTime;

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

                // --- LOGIKA KONVERSI TANGGAL DI SINI ---
        $convertedDate = null;
        $dateFromInput = trim($this->tanggal_surat);

        // Coba konversi dari dd/mm/YYYY
        $dateObj = DateTime::createFromFormat('d/m/Y', $dateFromInput);

        // Jika tidak berhasil, coba dari YYYY-MM-DD (misal jika data lama atau dari sumber lain)
        if (!$dateObj) {
            $dateObj = DateTime::createFromFormat('Y-m-d', $dateFromInput);
        }

        if ($dateObj) {
            $convertedDate = $dateObj->format('Y-m-d');
        } else {
            // Jika konversi gagal, Anda bisa menambahkan error validasi manual
            $this->addError('tanggal_surat', 'Format tanggal tidak valid. Gunakan DD/MM/YYYY.');
            return; // Hentikan proses jika tanggal tidak valid
        }
        // --- AKHIR LOGIKA KONVERSI ---

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
