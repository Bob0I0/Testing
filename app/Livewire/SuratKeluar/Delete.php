<?php

namespace App\Livewire\SuratKeluar;

use Livewire\Component;
use App\Models\SuratKeluar; // <--- PASTIKAN MENGGUNAKAN MODEL YANG BENAR
use Illuminate\Support\Facades\Storage; // <--- TAMBAHKAN INI

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
        return view('livewire.surat-keluar.delete');
    }

    // Metode yang akan dipanggil saat tombol 'Hapus' di modal konfirmasi diklik
    public function delete()
    {
        try {
            // Cari surat berdasarkan ID yang diterima - PASTIKAN MENGGUNAKAN MODEL SuratKeluar
            $surat = SuratKeluar::findOrFail($this->suratId); 

            // Opsional: Hapus juga file terkait dari storage jika ada
            if ($surat->file) {
                // Asumsi path file disimpan di DB adalah 'public/file_SKeluar/namafile.pdf'
                // Untuk menghapus, kita perlu path relatif terhadap disk 'public'
                // atau hapus prefiks 'public/' jika menggunakan Storage::delete() tanpa disk()
                $filePathOnDisk = str_replace('public/', '', $surat->file); 
                
                // Pastikan file benar-benar ada di disk sebelum mencoba menghapusnya
                if (Storage::disk('public')->exists($filePathOnDisk)) {
                    Storage::disk('public')->delete($filePathOnDisk);
                }
            }

            $surat->delete(); // Hapus record dari database

            // Berikan pesan sukses ke sesi flash - PASTIKAN PESAN SESUAI DENGAN SuratKeluar
            session()->flash('message', 'Surat Keluar dengan nomor ' . $this->nomorSurat . ' berhasil dihapus.');

            // Kirim event ke komponen induk (misalnya komponen 'Show' yang menampilkan daftar)
            // agar memperbarui daftar datanya setelah item dihapus.
            // Gunakan event yang sama dengan yang didispatch dari komponen Edit untuk me-refresh tabel Show.
            $this->dispatch('suratUpdated')->to(\App\Livewire\SuratKeluar\Show::class); 

            // Tutup modal konfirmasi setelah berhasil dihapus
            // Pastikan ID modal sesuai dengan cara Anda membukanya (misalnya: delete-123)
            $this->dispatch('close-modal', 'delete-' . $this->suratId);

        } catch (\Exception $e) {
            // Tangani jika ada error (misal: data tidak ditemukan, masalah database)
            session()->flash('error', 'Gagal menghapus surat: ' . $e->getMessage());
            // Tutup modal juga saat ada error, agar pengguna bisa mencoba lagi atau melihat pesan error.
            $this->dispatch('close-modal', 'delete-' . $this->suratId);
        }
    }
}