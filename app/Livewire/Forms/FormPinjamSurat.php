<?php

namespace App\Livewire\Forms;

use App\Models\PinjamSurat;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormPinjamSurat extends Form
{
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:60', message: 'Tulisan melebihi batas')]
    public $nomor_surat; 
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:200', message: 'Tulisan melebihi batas')]
    public $nama_peminjam;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    public $perihal;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    public $tanggal_pinjam;

    #[Validate('nullable')]
    #[Validate('after_or_equal:tanggal_pinjam', message: 'Wajib hari pinjam atau sesudahnya')]
    public $tanggal_kembali;

    public $status;

    public function create(): PinjamSurat
    {
        $this->validate();

        $dateFromInput1 = trim($this->tanggal_pinjam);
        $formattedDate1 =  date("Y-m-d", strtotime($dateFromInput1));

        return PinjamSurat::create([
            "nomor_surat" => $this->nomor_surat,
            "nama_peminjam" => $this->nama_peminjam, 
            "perihal" => $this->perihal, 
            "tanggal_pinjam" => $formattedDate1,
        ]);
    }

    public function setPinjamSurat($pinjamsurat)
    {
        $this->nomor_surat = $pinjamsurat->nomor_surat;
        $this->nama_peminjam = $pinjamsurat->nama_peminjam;
        $this->perihal = $pinjamsurat->perihal;
        $this->tanggal_pinjam = $pinjamsurat->tanggal_pinjam->format('d-m-Y');
        $this->tanggal_kembali = $pinjamsurat->tanggal_kembali?->format('d-m-Y');
    }
    // Metode untuk menyimpan atau memperbarui data ke database
    public function update(PinjamSurat $surat) 
    {
        $this->validate(); 
        
        $dateFromInput1 = trim($this->tanggal_pinjam);
        $formattedDate1 =  date("Y-m-d", strtotime($dateFromInput1));

        $formattedDate2 = null;
        if ($this->tanggal_kembali) {
            $dateFromInput2 = trim($this->tanggal_kembali);
            $formattedDate2 = date("Y-m-d", strtotime($dateFromInput2));
        }

        $surat->update([
            "nomor_surat" => $this->nomor_surat,
            "nama_peminjam" => $this->nama_peminjam, 
            "perihal" => $this->perihal, 
            "tanggal_pinjam" => $formattedDate1,
            "tanggal_kembali" => $formattedDate2,
        ]);
    }
    
    public function resetForm()
    {
        $this->reset();

        $this->resetValidation();
    }
}
