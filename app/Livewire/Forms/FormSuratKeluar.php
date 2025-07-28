<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\SuratKeluar; // Import model SuratKeluar
use Illuminate\Support\Facades\Storage; // Import Storage untuk file
use DateTime; // Import DateTime untuk konversi tanggal

class FormSuratKeluar extends Form
{

    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:100', message: 'Tulisan melebihi batas')]
    public $nomor_surat; 
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:200', message: 'Tulisan melebihi batas')]
    public $tujuan_surat;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    public $perihal;
    
    // #[Validate('required|date')]
    #[Validate('required', message: 'Wajib Di Isi')]
    public $tanggal_surat;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:70', message: 'Tulisan melebihi batas')]
    public $jenis_surat;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('mimes:pdf', message: 'File wajib PDF')]
    #[Validate('max:2048', message: 'Besar file melebihi batas')]
    public $file; 

    // Properti untuk menyimpan path file yang sudah ada (bukan bagian dari form submission, tapi untuk logika update)
    public $existing_file = null; 

    // Metode untuk mengisi form dari model SuratKeluar
    public function setSuratKeluar(SuratKeluar $surat)
    {
        $this->nomor_surat = $surat->nomor_surat;
        $this->tujuan_surat = $surat->tujuan_surat;
        $this->perihal = $surat->perihal;

        // Pastikan tanggal diformat ke dd/mm/yyyy untuk ditampilkan di input datepicker
        if ($surat->tanggal_surat) {
            $this->tanggal_surat = $surat->tanggal_surat->format('d/m/Y');
        } else {
            $this->tanggal_surat = null;
        }
        
        $this->jenis_surat = $surat->jenis_surat;
        $this->existing_file = $surat->file; // Simpan path file yang sudah ada
        $this->file = null; // Pastikan properti file upload direset saat mengisi form
    }

    // Metode untuk menyimpan atau memperbarui data ke database
    public function update(SuratKeluar $surat) // Menerima instance model yang akan diupdate
    {
        $this->validate(); // Lakukan validasi menggunakan aturan Validate di atas

        // Konversi tanggal dari format input (dd/mm/yyyy) ke YYYY-MM-DD untuk database
        $convertedDate = null;
        $dateFromInput = trim($this->tanggal_surat);
        $dateObj = DateTime::createFromFormat('d/m/Y', $dateFromInput);
        
        if ($dateObj) {
            $convertedDate = $dateObj->format('Y-m-d');
        } else {
            // Ini seharusnya tidak tercapai jika validasi date_format:d/m/Y sudah benar
            // Tapi sebagai fallback, tambahkan error jika format masih salah
            $this->addError('tanggal_surat', 'Format tanggal tidak valid setelah konversi.');
            return;
        }

        // Handle upload file baru
        $filePath = $this->existing_file; // Default: gunakan file yang sudah ada
        if ($this->file) {
            // Hapus file lama jika ada dan berbeda dengan yang baru
            if ($this->existing_file && Storage::disk('public')->exists(str_replace('public/', '', $this->existing_file))) {
                Storage::disk('public')->delete(str_replace('public/', '', $this->existing_file));
            }
            $filePath = $this->file->store('public/file_SKeluar');
        } 
        // Jika $this->file adalah null (tidak ada upload baru) dan $this->existing_file ada,
        // maka $filePath akan tetap $this->existing_file, yang merupakan perilaku yang diinginkan.
        // Jika Anda ingin fitur hapus file tanpa upload baru, Anda perlu checkbox terpisah di UI.

        // Update data model
        $surat->update([
            "nomor_surat" => $this->nomor_surat,
            "tujuan_surat" => $this->tujuan_surat,
            "perihal" => $this->perihal,
            "tanggal_surat" => $convertedDate,
            "jenis_surat" => $this->jenis_surat,
            "file" => $filePath
        ]);
    }
}