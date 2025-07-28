<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class FormSuratMasuk extends Form
{
    #[Validate('required|string|max:255')]
    public $nomor_surat;
    
    #[Validate('required|string|max:255')]
    public $tujuan_surat;
    
    #[Validate('required|string')]
    public $perihal;
    
    #[Validate('required|date')]
    public $tanggal_surat;
    
    #[Validate('required|string|max:255')]
    public $jenis_surat;
    
    #[Validate('nullable|file|mimes:pdf|max:2048')]
    public $file;
}
