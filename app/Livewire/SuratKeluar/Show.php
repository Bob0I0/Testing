<?php

namespace App\Livewire\SuratKeluar;

use App\Models\SuratKeluar;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; // Import Livewire Attributes untuk listener

class Show extends Component
{
    use WithPagination;

    // Properti untuk menyimpan nilai filter yang diterima dari komponen Filter
    public $search;
    
    // Metode ini akan dipanggil ketika event 'suratUpdated' diterima
    #[On('suratUpdated')]
    public function refreshTable()
    {
        $this->resetPage(); // Reset halaman paginasi ke 1 setelah refresh
    }

    #[Computed]
    public function datakeluar(){
        $query = SuratKeluar::query();
        return $query
            ->when($this->search, function($query){
                $query->where('nomor_surat', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        // $query = SuratKeluar::query();

        // // Hanya tambahkan klausa 'where' jika $this->search tidak kosong
        // if (!empty($this->search)) {
        //     $query->where('nomor_surat', 'like', "%{$this->search}%");
        // }
        // $data = $query->latest()->paginate(5);

        return view('livewire.surat-keluar.show');
        // // Terapkan filter pencarian
        // if (!empty($this->search)) {
        //     $query->where(function($q) {
        //         $q->where('nomor_surat', 'like', '%' . $this->search . '%');
        //         //   ->orWhere('tujuan_surat', 'like', '%' . $this->search . '%')
        //         //   ->orWhere('perihal', 'like', '%' . $this->search . '%')
        //         //   ->orWhere('jenis_surat', 'like', '%' . $this->search . '%');
        //     });
    }
}