<?php

namespace App\Livewire\SuratKeluar;

use App\Models\SuratKeluar;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Livewire\Forms\FormSuratKeluar; // Import Form Object Anda

class Edit extends Component
{
    use WithFileUploads;

    // Deklarasikan Form Object sebagai properti publik
    public FormSuratKeluar $form;

    // Properti untuk menyimpan ID dari surat yang akan diedit
    public $suratKeluarId;

    // Metode mount akan dipanggil setiap kali komponen di-render atau key-nya berubah
    public function mount($suratId) // Menerima ID dari view Show
    {
        $this->suratKeluarId = $suratId;
        
        // Temukan data SuratKeluar berdasarkan ID
        $surat = SuratKeluar::findOrFail($suratId); 

        // Isi form object dengan data dari model
        $this->form->setSuratKeluar($surat);
    }

    public function render()
    {
        return view('livewire.surat-keluar.edit');
    }

    // Metode untuk memperbarui record SuratKeluar
    public function update()
    {
        // Panggil metode update() dari Form Object
        // Kita perlu meneruskan instance model SuratKeluar ke metode update di Form Object
        $surat = SuratKeluar::findOrFail($this->suratKeluarId);
        $this->form->update($surat); 

        session()->flash('message', 'Data berhasil diperbarui.');

        // Dispatch event untuk menutup modal Flux
        $this->dispatch('close-modal', 'edit-'.$this->suratKeluarId);

        // Dispatch event ke komponen Show untuk me-refresh tabel
        $this->dispatch('suratUpdated')->to(\App\Livewire\SuratKeluar\Show::class);

        // Reset form setelah update
        $this->form->reset(); // Reset semua properti di Form Object
        $this->resetValidation(); // Hapus pesan validasi dari komponen utama
    }
}