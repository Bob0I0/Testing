<?php

namespace App\Livewire\Izin;

use App\Helpers\Flash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Delete extends Component
{  
    public $izinId;  
    public $name; 

    public function mount($izinId, $name)
    {
        $this->izinId = $izinId;
        $this->name = $name;
    }

    public function delete()
    {
        $izin = Role::findOrFail($this->izinId); 
        $izin->delete(); 
        Flash::success("Perizinan Berhasil dihapus");
        $this->dispatch('izinUpdated')->to(\App\Livewire\Izin\Index::class);
    }

    public function render()
    {
        return view('livewire.izin.delete', [
            'name' => $this->name,
        ]);
    }
}
