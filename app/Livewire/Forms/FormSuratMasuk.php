<?php

namespace App\Livewire\Forms;

use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class FormSuratMasuk extends Form
{
    use WithFileUploads;

    #[validate]
    public $nomor_surat; 
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:200', message: 'Tulisan melebihi batas')]
    public $asal_surat;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    public $perihal;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    public $tanggal_surat;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:70', message: 'Tulisan melebihi batas')]
    public $jenis_surat;

    #[validate]
    public $file; 

    // Properti untuk menyimpan path file yang sudah ada (bukan bagian dari form submission, tapi untuk logika update)
    public $existing_file = null; 

    // Properti baru untuk nama file asli
    public $original_file_name;

    // Properti untuk menyimpan path file yang sudah ada dari database (saat edit)
    public $existing_file_path; // Ini akan digunakan saat edit/update

    // Properti baru untuk menunjukkan mode form (create atau edit)
    public $isEditMode = false; 
    public $suratMasukIdToIgnore = null;
    
    public function rules(): array
    {
        return [
            'nomor_surat'   => [
                'required',
                'max:100',
                Rule::unique('surat_masuks', 'nomor_surat')->ignore($this->suratMasukIdToIgnore),
            ],
            'file'=> $this->isEditMode
                    ? 'nullable|mimes:pdf|max:2048' // edit
                    : 'required|mimes:pdf|max:2048', // create
        ];
    }

    public function messages(): array
    {
        return [
            'nomor_surat.required' => 'Wajib Di Isi ',
            'nomor_surat.max:100'     => 'Tulisan melebihi batas',
            'nomor_surat.unique'     => 'Nomor surat ini sudah ada',
            'file.required' => 'File surat wajib diunggah',
            'file.mimes' => 'File wajib berformat PDF',
            'file.max' => 'Ukuran file melebihi batas (maks 2MB)',
        ];
    }

    public function create(): SuratMasuk
    {
        $this->validate();
        $this->suratMasukIdToIgnore = null;
        
        $dateFromInput = trim($this->tanggal_surat);
        $formattedDate =  date("Y-m-d", strtotime($dateFromInput));

        $filePath = null;
        $originalFileName = null;

        if ($this->file) {
            $extension = $this->file->getClientOriginalExtension();
            $originalFileName = $this->file->getClientOriginalName();
            $uniqueFileName = \Illuminate\Support\Str::uuid() . '.' . $extension;
            $filePath = $this->file->storeAs('public/file_SKeluar', $uniqueFileName);
        }

        return SuratMasuk::create([
            "nomor_surat" => $this->nomor_surat,
            "asal_surat" => $this->asal_surat, 
            "perihal" => $this->perihal, 
            "tanggal_surat" => $formattedDate,
            "jenis_surat" => $this->jenis_surat,
            "file" => $filePath,
            "nama_asli_file" => $originalFileName,
        ]);
    }
    // edit
    public function setSuratMasuk($suratMasuk)
    {
        $this->isEditMode = true; 
        $this->suratMasukIdToIgnore = $suratMasuk->id; 
        $this->nomor_surat = $suratMasuk->nomor_surat;
        $this->asal_surat = $suratMasuk->asal_surat;
        $this->perihal = $suratMasuk->perihal;
        $this->tanggal_surat = $suratMasuk->tanggal_surat->format('d-m-Y');
        $this->jenis_surat = $suratMasuk->jenis_surat;
        $this->existing_file_path = $suratMasuk->file;
        $this->original_file_name = $suratMasuk->nama_asli_file;
        $this->file = null;
    }

    // update database
    public function update(SuratMasuk $surat) 
    {
        $this->isEditMode = true;
        $this->suratMasukIdToIgnore = $surat->id;
        $this->validate(); 
        
        $dateFromInput = trim($this->tanggal_surat);
        $formattedDate =  date("Y-m-d", strtotime($dateFromInput));

        $filePathToSave = $this->existing_file_path; 
        $originalFileNameToSave = $this->original_file_name; 
        
        if ($this->file) {
            if (!empty($surat->file) && Storage::disk('public')->exists(str_replace('public/', '', $surat->file))) {
                Storage::disk('public')->delete(str_replace('public/', '', $surat->file));
            }

            $extension = $this->file->getClientOriginalExtension(); // Dapatkan ekstensi file baru
            $originalFileNameToSave = $this->file->getClientOriginalName(); // Dapatkan nama asli file baru
            $uniqueFileName = \Illuminate\Support\Str::uuid() . '.' . $extension; // Buat nama unik untuk file baru
            $filePathToSave = $this->file->storeAs('public/file_SKeluar', $uniqueFileName); // Simpan file ke storage
        }
        $surat->update([
            "nomor_surat" => $this->nomor_surat,
            "asal_surat" => $this->asal_surat,
            "perihal" => $this->perihal,
            "tanggal_surat" => $formattedDate,
            "jenis_surat" => $this->jenis_surat,
            "file" => $filePathToSave, 
            "nama_asli_file" => $originalFileNameToSave,
        ]);
    }
    public function resetForm()
    {
        $this->reset();

        $this->resetValidation();
    }
}
