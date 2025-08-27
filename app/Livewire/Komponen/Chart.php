<?php

namespace App\Livewire\Komponen;

use Livewire\Component;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

class Chart extends Component
{
    public $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sep', 'Okt', 'Nov', 'Des'];
    public $name1 = 'Surat Masuk';
    public $dataPoint1 = [];
    public $name2 = 'Surat Keluar';
    public $dataPoint2 = [];
    public $tahunList = [];
    public $tahunAwal;
    public $tahunAkhir;
    public $tahunRangeList = [];
    public $tahunRange = '';

    public function mount($tahunRange = null)
    {
        $this->tahunRangeList = $this->getAvailableYearRanges();
        $this->tahunRange = $tahunRange ?? ($this->tahunRangeList[0] ?? '');

        [$tahunAwal, $tahunAkhir] = explode('-', $this->tahunRange);

        $this->dataPoint1 = $this->getSuratMasukPerBulan($tahunAwal, $tahunAkhir);
        $this->dataPoint2 = $this->getSuratKeluarPerBulan($tahunAwal, $tahunAkhir);
    }

    public function updatedTahunRange()
    {
        [$tahunAwal, $tahunAkhir] = explode('-', $this->tahunRange);

        $this->dataPoint1 = $this->getSuratMasukPerBulan($tahunAwal, $tahunAkhir);
        $this->dataPoint2 = $this->getSuratKeluarPerBulan($tahunAwal, $tahunAkhir);
    }

    protected function getAvailableYearRanges()
    {
        $tahunMasuk = SuratMasuk::selectRaw('YEAR(tanggal_surat) as tahun')->distinct()->pluck('tahun')->toArray();
        $tahunKeluar = SuratKeluar::selectRaw('YEAR(tanggal_surat) as tahun')->distinct()->pluck('tahun')->toArray();
        $tahunGabung = array_unique(array_merge($tahunMasuk, $tahunKeluar));
        sort($tahunGabung);

        $ranges = [];
        foreach ($tahunGabung as $tahun) {
            $ranges[] = $tahun . '-' . ($tahun + 1);
        }

        rsort($ranges);

        return $ranges;
    }


    protected function getSuratMasukPerBulan($tahunAwal, $tahunAkhir)
    {
        $result = [];
        // Ambil data hanya pada tahunAwal
        for ($i = 1; $i <= 12; $i++) {
            $count = SuratMasuk::whereYear('tanggal_surat', $tahunAwal)
                ->whereMonth('tanggal_surat', $i)
                ->count();
            $result[] = $count;
        }
        return $result;
    }

    protected function getSuratKeluarPerBulan($tahunAwal, $tahunAkhir)
    {
        $result = [];
        // Ambil data hanya pada tahunAwal
        for ($i = 1; $i <= 12; $i++) {
            $count = SuratKeluar::whereYear('tanggal_surat', $tahunAwal)
                ->whereMonth('tanggal_surat', $i)
                ->count();
            $result[] = $count;
        }
        return $result;
    }

    public function render()
    {
        return view('livewire.komponen.chart');
    }
}
