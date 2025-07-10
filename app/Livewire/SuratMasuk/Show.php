<?php

namespace App\Livewire\SuratMasuk;

use Livewire\Component;
use App\Models\SuratMasuk;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    // Properti untuk melacak ID surat yang sedang diedit.
    // Ini akan digunakan untuk meng conditionally render komponen Edit.
    public $editingSuratId = null;

    // Event listeners yang akan didengarkan oleh komponen Show ini.
    protected $listeners = [
        'surat-masuk-deleted' => '$refresh', // Dari komponen delete Anda
        'surat-masuk-updated' => '$refresh', // Event yang akan dikirim oleh komponen Edit setelah berhasil update
        'openEditModal' => 'openEditModal', // Event yang akan memicu pembukaan modal edit
        'closeEditModal' => 'closeEditModal', // Event untuk menutup modal edit dari Livewire
    ];

    public function render()
    {
        $query = SuratMasuk::query();
        $suratMasuks = $query->paginate(10);
        
        return view('livewire.surat-masuk.show', [
            'suratMasuks' => $suratMasuks,
        ]);
    }

    // Metode ini akan dipanggil ketika event 'openEditModal' diterima.
    public function openEditModal($suratId)
    {
        $this->editingSuratId = $suratId; // Set ID surat yang akan diedit
        // Dispatch event untuk membuka modal edit di sisi frontend.
        // Nama modal ini harus cocok dengan nama di edit.blade.php
        $this->dispatch('open-modal', 'edit-file-' . $suratId);
    }

    // Metode ini akan dipanggil ketika modal edit ditutup atau dibatalkan.
    public function closeEditModal()
    {
        $this->editingSuratId = null; // Reset ID surat yang diedit
    }
}