<?php

namespace App\Livewire\Kelolauser;

use App\Helpers\Flash;
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
        Flash::success("User Berhasil dihapus");
        $this->dispatch('userUpdated')->to(\App\Livewire\Kelolauser\Show::class);

    }
    public function render()
    {
        return view('livewire.kelolauser.delete');
    }
}
