<?php

namespace App\Livewire\SuratKeluar;

use App\Models\SuratKeluar;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    public $search = '';
    public $tanggalAwal = '';
    public $tanggalAkhir = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTanggalAwal()
    {
        $this->resetPage();
    }

    public function updatingTanggalAkhir()
    {
        $this->resetPage();
    }
    public function resetFilter()
    {
        $this->tanggalAwal = '';
        $this->tanggalAkhir = '';
        $this->resetPage();
    }

    #[Computed]
    public function datakeluar()
    {
        $query = SuratKeluar::query();
        
        $query->when($this->search, function ($query) {
            $query->where('nomor_surat', 'like', "%{$this->search}%");
        });

        $query->when($this->tanggalAwal, function ($query) {
            $tanggalAwal = Carbon::createFromFormat('d-m-Y', $this->tanggalAwal)->startOfDay();
            $query->whereDate('tanggal_surat', '>=', $tanggalAwal);
        });

        $query->when($this->tanggalAkhir, function ($query) {
            $tanggalAkhir = Carbon::createFromFormat('d-m-Y', $this->tanggalAkhir)->endOfDay();
            $query->whereDate('tanggal_surat', '<=', $tanggalAkhir);
        });

        return $query->latest()->paginate(5);
    }

    #[On('suratUpdated')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.surat-keluar.show');
    }
}
