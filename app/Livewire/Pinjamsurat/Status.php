<?php

namespace App\Livewire\Pinjamsurat;

use App\Livewire\Forms\FormPinjamSurat;
use App\Models\PinjamSurat;
use Livewire\Component;
use Carbon\Carbon;

class Status extends Component
{
    public FormPinjamSurat $form;
    
    public $pinjamSuratId;
    public $status = 'Pinjam';

    public function mount($suratId)
    {
        $this->pinjamSuratId = $suratId;
        $surat = PinjamSurat::findOrFail($suratId);

        $this->status = $surat->tanggal_kembali ? 'Selesai' : 'Pinjam';
        $this->form->tanggal_kembali = $surat->form?->tanggal_kembali?->format('d-m-Y');
    }

    public function updateKembali()
    {
        $surat = PinjamSurat::findOrFail($this->pinjamSuratId);

        $this->form->tanggal_pinjam = $surat->tanggal_pinjam->format('d-m-Y');

        $this->validateOnly('form.tanggal_kembali');

        $surat->tanggal_kembali = Carbon::createFromFormat('d-m-Y', $this->form->tanggal_kembali)->format('Y-m-d');
        $surat->save();

        $this->status = 'Selesai';
        $this->resetValidation();
        return redirect()->to('/surat');
    }

    public function resetForm()
    {
        $this->form->tanggal_kembali = null;
        $this->resetValidation('form.tanggal_kembali');
    }

    public function render()
    {
        return view('livewire.pinjamsurat.status');
    }
}
