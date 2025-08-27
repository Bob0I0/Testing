<?php

namespace App\Livewire\Kelolauser;

use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    public $userId;  
    public $name; 

    public function mount($userId, $name)
    {
        $this->userId = $userId;
        $this->name = $name;
    }

    public function delete()
    {
        $surat = User::findOrFail($this->userId); 
        $surat->delete(); 

        // Berikan pesan sukses ke sesi flash - PASTIKAN PESAN SESUAI DENGAN SuratKeluar
        // session()->flash('message', 'Surat Keluar dengan nomor ' . $this->nomorSurat . ' berhasil dihapus.');

        $this->dispatch('userUpdated')->to(\App\Livewire\Kelolauser\Show::class);

    }
    public function render()
    {
        return view('livewire.kelolauser.delete');
    }
}
