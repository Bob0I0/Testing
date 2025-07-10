<?php

namespace App\Livewire\SuratMasuk;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SuratMasuk; // Pastikan ini model Anda
use Illuminate\Support\Facades\Storage; // Untuk menghapus file lama

class Edit extends Component // Nama kelas komponen diubah menjadi Edit
{
    use WithFileUploads;

    // Properti untuk menyimpan ID surat yang akan diedit
    public $suratId;
    protected $listeners = [
    'close-modal' => 'resetIdAndEmitClose', // Dengar event close-modal dari JS
    ];
    // Properti publik untuk form (sama seperti sebelumnya)
    public $nomor_surat;
    public $asal_surat;
    public $perihal;
    public $tanggal_surat;
    public $jenis_surat;
    public $file; // Properti untuk file baru yang diupload
    public $existingFile; // Properti untuk menyimpan path file yang sudah ada

    // Metode mount akan dipanggil saat komponen diinisialisasi,
    // terutama saat menerima ID dari komponen induk (misalnya dari tombol edit di tabel)
    public function mount($id)
    {
        $surat = SuratMasuk::findOrFail($id); // Cari data surat berdasarkan ID

        $this->suratId = $surat->id;
        $this->nomor_surat = $surat->nomor_surat;
        $this->asal_surat = $surat->asal_surat;
        $this->perihal = $surat->perihal;
        $this->tanggal_surat = $surat->tanggal_surat; // Accessor di model akan memformatnya
        $this->jenis_surat = $surat->jenis_surat;
        $this->existingFile = $surat->file; // Simpan path file yang sudah ada
    }

    public function render()
    {
        // Pastikan ini me-return view yang benar (edit.blade.php)
        return view('livewire.surat-masuk.edit');
    }

    // Ubah nama metode dari 'save' menjadi 'update'
    public function update()
    {
        // Aturan validasi
        $this->validate([
            // Untuk nomor_surat, tambahkan pengecualian ID saat ini agar tidak bentrok dengan dirinya sendiri
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk,nomor_surat,' . $this->suratId,
            'asal_surat' => 'required|string|max:255',
            'perihal' => 'string',
            'tanggal_surat' => 'required|date', // Mutator di model akan menangani format
            'jenis_surat' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // File baru opsional
        ]);

        $surat = SuratMasuk::findOrFail($this->suratId); // Cari data yang akan diupdate

        $filePath = $this->existingFile; // Defaultnya, gunakan path file yang sudah ada

        // Jika ada file baru diupload
        if ($this->file) {
            // Hapus file lama jika ada
            if ($this->existingFile && Storage::exists($this->existingFile)) {
                Storage::delete($this->existingFile);
            }
            // Simpan file baru
            $filePath = $this->file->store('public/surat_files');
        }

        // Update data surat
        $surat->update([
            "nomor_surat" => $this->nomor_surat,
            "asal_surat" => $this->asal_surat,
            "perihal" => $this->perihal,
            "tanggal_surat" => $this->tanggal_surat,
            "jenis_surat" => $this->jenis_surat,
            "file" => $filePath // Gunakan path file yang sudah diupdate
        ]);

        session()->flash('message', 'Data surat berhasil diperbarui.');

        // Opsional: Tutup modal setelah update
        $this->dispatch('close-modal', 'edit-file-' . $this->suratId); // Asumsi nama modal unik
        $this->dispatch('surat-masuk-updated'); // Event untuk me-refresh daftar di komponen induk
    }

    // Metode untuk menghapus file yang sudah ada (jika Anda ingin tombol "Hapus File")
    public function removeExistingFile()
    {
        if ($this->existingFile && Storage::exists($this->existingFile)) {
            Storage::delete($this->existingFile);
            $this->existingFile = null; // Hapus dari properti Livewire
            $surat = SuratMasuk::findOrFail($this->suratId);
            $surat->update(['file' => null]); // Update di database
            session()->flash('message', 'File berhasil dihapus.');
        }
    }
    public function resetIdAndEmitClose($modalName)
    {
        // Jika modal yang ditutup adalah modal edit ini, beritahu komponen Show
        if (str_starts_with($modalName, 'edit-file-')) {
            $this->dispatch('closeEditModal');
        }
    }
}
