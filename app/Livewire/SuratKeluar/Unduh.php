<?php

namespace App\Livewire\SuratKeluar;

use App\Models\SuratKeluar;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Unduh extends Component
{
    public $suratId;    // Properti publik untuk menerima ID surat
    public $nomorSurat; // Properti publik untuk menerima nomor surat (untuk konfirmasi)
    

    // Metode mount() akan dipanggil saat komponen diinisialisasi,
    // menerima properti yang dilewatkan dari komponen induk.
    public function mount($suratId, $nomorSurat)
    {
        $this->suratId = $suratId;
        $this->nomorSurat = $nomorSurat;
    }

    public function render()
    {
        return view('livewire.surat-keluar.unduh');
    }
    
    public function download($suratKeluarId)
    {
        try {
            $suratKeluar = SuratKeluar::findOrFail($suratKeluarId);

            // Pastikan path file ada di database
            if (empty($suratKeluar->file)) { // Asumsi kolom di DB adalah 'file' untuk path
                session()->flash('error', 'File tidak ditemukan untuk surat ini.');
                return;
            }

            // Path yang disimpan di database (contoh: 'public/file_SKeluar/nama_unik.pdf')
            $filePathInDb = $suratKeluar->file;

            // Pastikan file fisik benar-benar ada di storage
            // Jika path di DB sudah mengandung 'public/', maka Storage::exists() akan langsung mencarinya
            // Jika path di DB hanya 'file_SKeluar/nama_unik.pdf', maka perlu ditambahkan 'public/'
            if (!Storage::exists($filePathInDb)) {
                 // Coba dengan menambahkan 'public/' jika tidak ditemukan
                $filePathInDb = 'public/' . $filePathInDb;
                if (!Storage::exists($filePathInDb)) {
                    session()->flash('error', 'File fisik tidak ditemukan di server.');
                    return;
                }
            }

            // Tentukan nama file yang akan ditampilkan saat diunduh
            // Jika Anda menyimpan nama asli di kolom lain (misal: 'original_file_name'), gunakan itu
            // Jika tidak, ambil nama dari path file
            $fileName = $suratKeluar->nama_asli_file ?? basename($suratKeluar->file);

            // Mengembalikan file sebagai response download
            return Storage::download($filePathInDb, $fileName);

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengunduh file: ' . $e->getMessage());
            // Opsional: log error untuk debugging lebih lanjut
            // \Log::error('Download error for SuratKeluar ID ' . $suratKeluarId . ': ' . $e->getMessage());
        }
    }
}
