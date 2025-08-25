<?php

namespace App\Livewire;

use Livewire\Component;

class DatePickerInput extends Component
{
    public $model; // Properti untuk mengikat nilai tanggal (misal: form.tanggal_surat)
    public $label = 'Pilih Tanggal'; // Label default
    public $placeholder = 'dd-mm-yyyy'; 

    public function render()
    {
        return view('livewire.date-picker-input');
    }
}