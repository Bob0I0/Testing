<?php

namespace App\Livewire\SuratKeluar;

// use App\Livewire\Forms\FormSuratKeluar; // Hapus atau komentari jika ini komponen daftar
use App\Models\SuratKeluar;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; // Import Livewire Attributes untuk listener
use Illuminate\Support\Facades\Storage; // <--- TAMBAHKAN INI UNTUK MENGGUNAKAN STORAGE

class Show extends Component
{
    use WithPagination;

    // Metode ini akan dipanggil ketika event 'suratUpdated' diterima
    #[On('suratUpdated')]
    public function refreshTable()
    {
        $this->resetPage(); // Reset halaman paginasi ke 1 setelah refresh
    }

    // --- Bagian ini kemungkinan tidak diperlukan untuk komponen daftar (list) ---
    // public FormSuratKeluar $form;
    // public $suratKeluarId;

    // public function mount($suratId) // Menerima ID dari view Show
    // {
    //     $this->suratKeluarId = $suratId;
    //     $surat = SuratKeluar::findOrFail($suratId);
    //     $this->form->setSuratKeluar($surat);
    // }
    // --- Akhir bagian yang kemungkinan tidak diperlukan ---

    // Metode untuk mengunduh file
    public function download($suratKeluarId) // <--- Menerima ID SuratKeluar yang akan diunduh
    {
        try {
            $suratKeluar = SuratKeluar::findOrFail($suratKeluarId); // Temukan SuratKeluar berdasarkan ID

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
            $fileName = $suratKeluar->original_file_name ?? basename($suratKeluar->file);

            // Mengembalikan file sebagai response download
            return Storage::download($filePathInDb, $fileName);

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengunduh file: ' . $e->getMessage());
            // Opsional: log error untuk debugging lebih lanjut
            // \Log::error('Download error for SuratKeluar ID ' . $suratKeluarId . ': ' . $e->getMessage());
        }
    }

    public function render()
    {
        $data = SuratKeluar::query()->latest()->paginate(5);
        return view('livewire.surat-keluar.show', ['datakeluar' => $data]);
    }
}