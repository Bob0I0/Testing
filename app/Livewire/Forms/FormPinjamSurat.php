<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class FormPinjamSurat extends Form
{
    #[validate]
    public $nomor_surat; 
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:200', message: 'Tulisan melebihi batas')]
    public $nama_peminjam;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    public $perihal;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    public $tanggal_pinjam;

    public $tanggal_kembali;

    public $status;
}
