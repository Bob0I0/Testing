<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class FormSuratKeluar extends Form
{
    use WithFileUploads;

    #[validate]
    public $nomor_surat; 
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('max:200', message: 'Tulisan melebihi batas')]
    public $tujuan_surat;
    
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
    public $suratKeluarIdToIgnore = null;

    public function rules(): array
    {
        return [
            'nomor_surat'   => [
                'required',
                'max:100',
                Rule::unique('surat_keluars', 'nomor_surat')->ignore($this->suratKeluarIdToIgnore),
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

    /**
     * Metode untuk membuat record SuratKeluar baru.
     * Ini akan dipanggil dari komponen Livewire Create.
     *
     * @return \App\Models\SuratKeluar
     */
    public function create(): SuratKeluar
    {
        $this->validate();
        $this->suratKeluarIdToIgnore = null;
        
        $dateFromInput = trim($this->tanggal_surat);
        $formattedDate =  date("Y-m-d", strtotime($dateFromInput));

        $filePath = null;
        $originalFileName = null;

        // Karena ini mode create, file pasti ada jika validasi 'required' lolos
        if ($this->file) {
            $extension = $this->file->getClientOriginalExtension();
            $originalFileName = $this->file->getClientOriginalName();
            $uniqueFileName = \Illuminate\Support\Str::uuid() . '.' . $extension;
            $filePath = $this->file->storeAs('public/file_SKeluar', $uniqueFileName);
        }

        return SuratKeluar::create([
            "nomor_surat" => $this->nomor_surat,
            "tujuan_surat" => $this->tujuan_surat, 
            "perihal" => $this->perihal, 
            "tanggal_surat" => $formattedDate,
            "jenis_surat" => $this->jenis_surat,
            "file" => $filePath,
            "nama_asli_file" => $originalFileName,
        ]);
    }

    // Metode setSuratKeluar tetap sama untuk edit
    public function setSuratKeluar($suratKeluar)
    {
        $this->isEditMode = true; // Set mode ke edit saat mengisi form
        $this->suratKeluarIdToIgnore = $suratKeluar->id; 
        $this->nomor_surat = $suratKeluar->nomor_surat;
        $this->tujuan_surat = $suratKeluar->tujuan_surat;
        $this->perihal = $suratKeluar->perihal;
        $this->tanggal_surat = $suratKeluar->tanggal_surat->format('d-m-Y');
        $this->jenis_surat = $suratKeluar->jenis_surat;
        $this->existing_file_path = $suratKeluar->file;
        $this->original_file_name = $suratKeluar->nama_asli_file;
        $this->file = null;
    }



    // Metode untuk menyimpan atau memperbarui data ke database
    public function update(SuratKeluar $surat) // Menerima instance model yang akan diupdate
    {
        $this->isEditMode = true;
        $this->suratKeluarIdToIgnore = $surat->id;
        $this->validate(); // Lakukan validasi menggunakan aturan Validate di atas
        
        $dateFromInput = trim($this->tanggal_surat);
        $formattedDate =  date("Y-m-d", strtotime($dateFromInput));

        $filePathToSave = $this->existing_file_path; // Path unik file yang sudah ada
        $originalFileNameToSave = $this->original_file_name; 
        // Handle upload file baru
        if ($this->file) {
            if (!empty($surat->file) && Storage::disk('public')->exists(str_replace('public/', '', $surat->file))) {
                Storage::disk('public')->delete(str_replace('public/', '', $surat->file));
            }

            $extension = $this->file->getClientOriginalExtension(); // Dapatkan ekstensi file baru
            $originalFileNameToSave = $this->file->getClientOriginalName(); // Dapatkan nama asli file baru
            $uniqueFileName = \Illuminate\Support\Str::uuid() . '.' . $extension; // Buat nama unik untuk file baru
            $filePathToSave = $this->file->storeAs('public/file_SKeluar', $uniqueFileName); // Simpan file ke storage
        }
        // dd([
        //     'filePathToSave' => $filePathToSave,
        //     'originalFileNameToSave' => $originalFileNameToSave,
        //     'isNewFileUploaded' => (bool) $this->file, // Untuk memastikan kondisi if($this->file) terpenuhi
        //     'formOriginalFileName' => $this->original_file_name, // Nilai properti form sebelum update
        //     'formExistingFilePath' => $this->existing_file_path, // Nilai properti form sebelum update
        // ]);
        // Update data model
        $surat->update([
            "nomor_surat" => $this->nomor_surat,
            "tujuan_surat" => $this->tujuan_surat,
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