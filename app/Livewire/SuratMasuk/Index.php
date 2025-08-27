<?php

namespace App\Livewire\SuratMasuk;

use App\Models\SuratMasuk;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    public $searchInput = '';
    public $search = '';
    public $tanggalAwal = '';
    public $tanggalAkhir = '';

    #[On('suratUpdated')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    public function cariSurat()
    {
        if (!$this->tanggalAwal) {
            $this->addError('tanggalAwal', 'Tanggal awal wajib diisi!');
            return;
        }

        if (!$this->tanggalAkhir) {
            $this->addError('tanggalAkhir', 'Tanggal akhir wajib diisi!');
            return;
        }

        try {
            $awal = Carbon::createFromFormat('d-m-Y', $this->tanggalAwal);
            $akhir = Carbon::createFromFormat('d-m-Y', $this->tanggalAkhir);
        } catch (\Exception $e) {
            $this->addError('tanggalAwal', 'Format tanggal salah!');
            return;
        }
        if ($akhir->lt($awal)) {
            $this->addError('tanggalAkhir', 'Tanggal akhir harus lebih besar atau sama dengan tanggal awal!');
            return;
        }
        $this->search = '';
        $this->resetPage();
    }

    public function resetfilter()
    {
        $this->tanggalAwal = '';
        $this->tanggalAkhir = '';
        $this->resetValidation();
        $this->resetPage();
    }

    #[Computed]
    public function SuratMasukIndex()
    {
        $query = SuratMasuk::query();

        $query->when($this->search, function($query){
            $query->where('nomor_surat', 'like', "%{$this->search}%");
        });

        $query->when($this->filterTanggal && $this->tanggalAwal && $this->tanggalAkhir, function($query){
            try {
                $awal = Carbon::createFromFormat('d-m-Y', $this->tanggalAwal)->startOfDay();
                $akhir = Carbon::createFromFormat('d-m-Y', $this->tanggalAkhir)->endOfDay();
                $query->whereBetween('tanggal_surat', [$awal, $akhir]);
            } catch (\Exception $e) {
                // Format salah, abaikan filter tanggal
            }
        });

        return $query->latest()->paginate(5);
    }

    public function render()
    {
        return view('livewire.surat-masuk.index');
    }

    public function updatedTanggalAwal()
    {
        $this->validateTanggal();
    }

    public function updatedTanggalAkhir()
    {
        $this->validateTanggal();
    }

    protected function validateTanggal()
    {
        $this->resetErrorBag(['tanggalAwal', 'tanggalAkhir']);

        if ($this->tanggalAwal && !$this->tanggalAkhir) {
            $this->addError('tanggalAkhir', 'Tanggal akhir wajib diisi!');
            return;
        }
        if ($this->tanggalAkhir && !$this->tanggalAwal) {
            $this->addError('tanggalAwal', 'Tanggal awal wajib diisi!');
            return;
        }
        if ($this->tanggalAwal && $this->tanggalAkhir) {
            try {
                $awal = Carbon::createFromFormat('d-m-Y', $this->tanggalAwal);
                $akhir = Carbon::createFromFormat('d-m-Y', $this->tanggalAkhir);
            } catch (\Exception $e) {
                $this->addError('tanggalAwal', 'Format tanggal salah!');
                return;
            }
            if ($akhir->lt($awal)) {
                $this->addError('tanggalAkhir', 'Tanggal akhir harus lebih besar atau sama dengan tanggal awal!');
            }
        }
    }
}
