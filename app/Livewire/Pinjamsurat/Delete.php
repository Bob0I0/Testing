<?php

namespace App\Livewire\Pinjamsurat;

use App\Models\PinjamSurat;
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

    public function delete()
    {
        $surat = PinjamSurat::findOrFail($this->suratId); 
        $surat->delete(); 

        // Berikan pesan sukses ke sesi flash - PASTIKAN PESAN SESUAI DENGAN SuratKeluar
        session()->flash('message', 'Surat Keluar dengan nomor ' . $this->nomorSurat . ' berhasil dihapus.');

        // Kirim event ke komponen induk (misalnya komponen 'Show' yang menampilkan daftar)
        // agar memperbarui daftar datanya setelah item dihapus.
        // Gunakan event yang sama dengan yang didispatch dari komponen Edit untuk me-refresh tabel Show.
        $this->dispatch('suratUpdated')->to(\App\Livewire\Pinjamsurat\Index::class);

    }

    public function render()
    {
        return view('livewire.pinjamsurat.delete');
    }
}
