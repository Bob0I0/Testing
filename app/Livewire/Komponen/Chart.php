<?php

namespace App\Livewire\Komponen;

use Livewire\Component;

class Chart extends Component
{

    public $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sep', 'Okt', 'Nov', 'Des'];
    public $name1 = 'Surat Masuk';
    public $dataPoint1 = [120, 150, 130, 160, 140, 180, 170, 190, 200, 210, 220, 230]; // Example data
    public $name2 = 'Surat Keluar';
    public $dataPoint2 = [80, 70, 90, 85, 95, 100, 110, 105, 115, 120, 130, 125]; // Example data

    public $label1 = 'Pemasukan';
    public $label2 = 'Pengeluaran';
    public $dataPointp1 = 5000000; // Contoh: Pemasukan untuk periode tertentu
    public $dataPointp2 = 2000000; // Contoh: Pengeluaran untuk periode tertentu
    public $chartTitle = 'Proporsi Keuangan Bulan Juni 2025'; // Judul chart

    public function render()
    {
        return view('livewire.komponen.chart');
    }
}
