<?php

namespace App\Livewire\SuratKeluar;

use App\Models\SuratKeluar;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; // Import Livewire Attributes untuk listener

class Show extends Component
{
    use WithPagination;

    // Properti untuk menyimpan nilai filter yang diterima dari komponen Filter
    public $search;
    public $startDate;
    public $endDate;

    // Listener untuk event 'filtersUpdated' dari komponen Filter
    // #[On('filtersUpdated')]
    // public function applyFilters($filters)
    // {
    //     $this->search = $filters['search'];
    //     dd($this->search = $filters['search']);
    //     $this->startDate = $filters['start_date'];
    //     $this->endDate = $filters['end_date'];
    //     $this->resetPage(); // Reset paginasi ke halaman 1 setiap kali filter berubah
    // }

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

    public function render()
    {
        $query = SuratKeluar::query();

        // Hanya tambahkan klausa 'where' jika $this->search tidak kosong
        if (!empty($this->search)) {
            $query->where('nomor_surat', 'like', '%{$this->search}%');
        }
        $data = $query->latest()->paginate(5);

        return view('livewire.surat-keluar.show', ['datakeluar' => $data]);
        // Terapkan filter pencarian
        // if (!empty($this->search)) {
        //     $query->where(function($q) {
        //         $q->where('nomor_surat', 'like', '%' . $this->search . '%');
        //         //   ->orWhere('tujuan_surat', 'like', '%' . $this->search . '%')
        //         //   ->orWhere('perihal', 'like', '%' . $this->search . '%')
        //         //   ->orWhere('jenis_surat', 'like', '%' . $this->search . '%');
        //     });
            
        // }

        // // Terapkan filter tanggal
        // if (!empty($this->startDate)) {
        //     $query->whereDate('tanggal_surat', '>=', $this->startDate);
        // }
        // if (!empty($this->endDate)) {
        //     $query->whereDate('tanggal_surat', '<=', $this->endDate);
        // }


    }
}