<?php

namespace App\Livewire\SuratKeluar;

use App\Livewire\Forms\FormSuratKeluar;
use App\Models\SuratKeluar;
use DateTime;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    
    public $showModal = false;

    public FormSuratKeluar $form;
    
    public function simpan(){
        
        $this->validate();
        $dateFromInput = trim($this->form->tanggal_surat);
        $formattedDate =  date("Y-m-d", strtotime($dateFromInput));
        SuratKeluar::create([
            "nomor_surat" => $this->form->nomor_surat,
            "tujuan_surat" => $this->form->tujuan_surat, 
            "perihal" => $this->form->perihal, 
            "tanggal_surat" => $formattedDate,
            "jenis_surat" => $this->form->jenis_surat,
            "file" => $this->form->file->store(path:'public/file_SKeluar')
        ]);
        $this->showModal = false;
        $this->resetForm();
        // $dateFromInput = trim($this->form->tanggal_surat);
        // // $newDate = date("d-m-Y", strtotime($dateFromInput));
        // // dd($dateFromInput);
        // // dd($this->form->tanggal_surat);
        // // // Coba konversi dari dd/mm/YYYY
        // // // DateTime::createFromFormat('d-m-y', $dateFromInput);
        // // dd($this->form->all());
    
        // // 1. Validasi Data
        // // Ini akan memicu aturan validasi di protected function rules()
        // $this->validate();

        // // 2. Mengkonversi Tanggal ke Format Database (Y-m-d)
        // // Jika input Anda formatnya 'd-m-Y' (e.g., 24-07-2025),
        // // Anda perlu mengkonversinya ke 'Y-m-d' (e.g., 2025-07-24) untuk database.
        // $formattedDate =  date("Y-m-d", strtotime($dateFromInput));
        // // try {
        // //     // $formattedDate = Carbon::createFromFormat('d-m-Y', $this->form['tanggal_surat'])->format('Y-m-d');
        // //     $formattedDate =  date("Y-m-d", strtotime($dateFromInput));
        // // } catch (\Exception $e) {
        // //     // Tangani error jika format tanggal tidak sesuai saat parsing
        // //     // Ini bisa terjadi jika validasi 'date_format' tidak cukup ketat atau input kosong
        // //     $this->addError('form.tanggal_surat', 'Format tanggal tidak valid.');
        // //     return; // Hentikan eksekusi jika format salah
        // // }
        // dd($formattedDate);
        // // 3. Siapkan Data untuk Disimpan
        // $dataToSave = $this->form;
        // $dataToSave['tanggal_surat'] = $formattedDate;
        // // 4. Simpan ke Database
        // // Contoh:
        // // Surat::create($dataToSave); // Jika semua field form sesuai dengan fillable model

        // // Atau secara manual:
        // // $surat = new Surat();
        // // $surat->tanggal_surat = $dataToSave['tanggal_surat'];
        // // $surat->kolom_lain = $dataToSave['kolom_lain'];
        // // $surat->save();

        // // 5. Beri Feedback atau Redirect
        // // session()->flash('message', 'Data surat berhasil disimpan!');

        // // Reset form setelah simpan (opsional)
        // // $this->form = [
        // //     'tanggal_surat' => null,
        // //     // ... reset properti lainnya
        // // ];
    
        
        // // // Lakukan logika penyimpanan data
        
        // SuratKeluar::create($this->form->all());
        // // dd($this->form->all());
        // $this->form->file->store(path:'public/file_SKeluar');
        // // // Jika berhasil, tutup modal
        // $this->showModal = false;
        // $this->resetForm();
        // // // Kirim notifikasi sukses (opsional)
        // // session()->flash('message', 'Data surat keluar berhasil disimpan.');

        // // } catch (\Illuminate\Validation\ValidationException $e) {
        // //     // Jika validasi gagal, modal akan tetap terbuka
        // //     // Karena properti $showModal tidak diubah menjadi false.
        // //     // Livewire akan secara otomatis mengirim error validasi ke view.
        // //     throw $e; // Melempar exception kembali agar Livewire menangani errornya
        // // }
        // // SuratKeluar::create(
        // //     $this->form->all() 
        // // );

        // // $this->form->file->store(path:'public/file_SKeluar');
        
        // // $this->redirect('/suratkeluar');
    }
    public function resetForm()
    {
        $this->form->reset();

        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.surat-keluar.create');
    }
}
