<?php

namespace App\Livewire\Izin;

use App\Helpers\Flash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $izinId;
    public $name;
    public $permissions = []; 
    public $allpermissions = [];

    public function mount($izinId)
    {
        $this->izinId = $izinId;

        $role = Role::findOrFail($this->izinId);
        $this->allpermissions = Permission::get();
        $this->name = $role->name;
        $this->permissions = $role->permissions->pluck('name');
        
    }
    
    public function updateizin()
    {    
        $this->validate([
            "name" => "required|unique:roles,name,".$this->izinId,
            "permissions" => "required"
        ]);

        $role = Role::findOrFail($this->izinId);
        $role->name = $this->name;
        $role->save();

        $role->syncPermissions($this->permissions);
        Flash::success("Perizinan Berhasil diedit");
        $this->dispatch('izinUpdated')->to(\App\Livewire\Izin\Index::class);
    }

    public function resetForm()
    {
        $this->reset();

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.izin.edit');
    }
}
