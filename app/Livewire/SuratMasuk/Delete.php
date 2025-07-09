<?php

namespace App\Livewire\SuratMasuk;

use Livewire\Component;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Storage; // Penting jika Anda menghapus file fisik

class Delete extends Component
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
        // Komponen ini tidak merender data tabel, hanya modal konfirmasi.
        // View-nya berisi HTML modal.
        return view('livewire.surat-masuk.delete');
    }

    // Metode yang akan dipanggil saat tombol 'Hapus' di modal konfirmasi diklik
    public function delete()
    {
        try {
            $surat = SuratMasuk::findOrFail($this->suratId); // Cari surat berdasarkan ID yang diterima

            // Opsional: Hapus juga file terkait dari storage jika ada
            if ($surat->file) {
                if (Storage::exists($surat->file)) {
                    Storage::delete($surat->file);
                }
            }

            $surat->delete(); // Hapus record dari database

            // Berikan pesan sukses ke sesi flash
            session()->flash('message', 'Surat Masuk dengan nomor ' . $this->nomorSurat . ' berhasil dihapus.');

            // Kirim event ke komponen induk (misalnya komponen 'Show' yang menampilkan daftar)
            // agar memperbarui daftar datanya setelah item dihapus.
            $this->dispatch('surat-masuk-deleted'); // Nama event bebas, tapi harus unik dan deskriptif

            // Tutup modal konfirmasi setelah berhasil dihapus
            $this->dispatch('close-modal', 'delete' . $this->suratId);

        } catch (\Exception $e) {
            // Tangani jika ada error (misal: data tidak ditemukan, masalah database)
            session()->flash('error', 'Gagal menghapus surat: ' . $e->getMessage());
            // Tutup modal juga saat ada error, agar pengguna bisa mencoba lagi atau melihat pesan error.
            $this->dispatch('close-modal', 'delete' . $this->suratId);
        }
    }
}