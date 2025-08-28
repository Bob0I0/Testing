<?php

namespace App\Livewire\Komponen;

use Livewire\Component;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Chart extends Component
{
    public $labels = [];
    public $name1 = 'Surat Masuk';
    public $dataPoint1 = [];
    public $name2 = 'Surat Keluar';
    public $dataPoint2 = [];
    public $tahun; // bisa dipilih user kalau mau

    public function mount($tahun = null)
    {
        $this->tahun = $tahun ?? now()->year;

        // label bulan (Jan - Des)
        $this->labels = [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Ags','Sep','Okt','Nov','Des'
        ];

        // hitung surat masuk per bulan
        $this->dataPoint1 = SuratMasuk::selectRaw('MONTH(tanggal_surat) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_surat', $this->tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->all();

        // isi array 12 bulan, kalau ga ada = 0
        $this->dataPoint1 = $this->mapTo12Months($this->dataPoint1);

        // hitung surat keluar per bulan
        $this->dataPoint2 = SuratKeluar::selectRaw('MONTH(tanggal_surat) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_surat', $this->tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->all();

        $this->dataPoint2 = $this->mapTo12Months($this->dataPoint2);
    }

    private function mapTo12Months($data)
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[] = $data[$i] ?? 0;
        }
        return $result;
    }

    public function render()
    {
        return view('livewire.komponen.chart');
    }
}
