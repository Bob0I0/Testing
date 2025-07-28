<?php

namespace App\Livewire\SuratMasuk;

use Livewire\Component;
use App\Models\SuratMasuk;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    // PASTIKAN properti ini ada dan diinisialisasi dengan null
    public $editingSuratId = null;

    // PASTIKAN listener ini ada
    protected $listeners = [
        'surat-masuk-deleted' => '$refresh',
        'surat-masuk-updated' => '$refresh',
        'openEditModal' => 'openEditModal', // <-- Ini akan dipanggil dari tombol edit
        'closeEditModal' => 'closeEditModal', // <-- Untuk mereset ID saat modal ditutup
    ];

    public function render()
    {
        $query = SuratMasuk::query();
        $suratMasuks = $query->paginate(1);
        
        return view('livewire.surat-masuk.show', [
            'suratMasuks' => $suratMasuks,
        ]);
    }

    // PASTIKAN metode ini ada dan menerima $suratId
    public function openEditModal($suratId)
    {
        // PENTING: Set properti editingSuratId dengan ID yang diterima
        $this->editingSuratId = $suratId;

        // Dispatch event untuk membuka modal. Nama modal harus cocok dengan di edit.blade.php
        $this->dispatch('open-modal', 'edit-file-' . $suratId);
    }

    // Metode untuk mereset ID saat modal ditutup (dari event di Edit.php)
    public function closeEditModal()
    {
        $this->editingSuratId = null;
    }
}