<?php

namespace App\Livewire\SuratKeluar;

use Livewire\Component;
use Livewire\Attributes\On;

class Filter extends Component
{
    // Properti untuk menyimpan nilai filter
    public $searchKeyword = '';
    public $startDate = '';
    public $endDate = '';

    // Listener untuk event 'searchUpdated' dari SearchBar (anak)
    #[On('searchUpdated')]
    public function updateSearchKeyword($keyword)
    {
        $this->searchKeyword = $keyword;
        // Setelah keyword pencarian diperbarui, dispatch event ke komponen Show (induk)
        $this->dispatchFiltersUpdated();
    }

    // Metode yang dipanggil saat startDate berubah
    public function updatedStartDate($value)
    {
        // Pastikan format tanggal sesuai dengan yang Anda inginkan untuk dikirim ke DB
        // Jika input 'dd/mm/yyyy', konversi dulu ke 'YYYY-MM-DD'
        $this->startDate = $value ? date("Y-m-d", strtotime($value)) : '';
        $this->dispatchFiltersUpdated();
    }

    // Metode yang dipanggil saat endDate berubah
    public function updatedEndDate($value)
    {
        // Pastikan format tanggal sesuai dengan yang Anda inginkan untuk dikirim ke DB
        $this->endDate = $value ? date("Y-m-d", strtotime($value)) :'';
        $this->dispatchFiltersUpdated();
    }

    // Metode untuk mereset semua filter
    public function resetFilters()
    {
        $this->searchKeyword = '';
        $this->startDate = '';
        $this->endDate = '';
        // Dispatch event untuk mengupdate komponen Show setelah reset
        $this->dispatchFiltersUpdated();
    }

    // Metode untuk mengirimkan semua nilai filter ke komponen Show (induk)
    private function dispatchFiltersUpdated()
    {
        $this->dispatch('filtersUpdated', [
            'search' => $this->searchKeyword,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ])->to(\App\Livewire\SuratKeluar\Show::class); // Targetkan komponen Show
    }

    public function render()
    {
        dd('Komponen Filter sedang dirender!');
        return view('livewire.surat-keluar.filter');
    }
}
