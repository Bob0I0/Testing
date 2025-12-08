<?php

namespace App\Livewire\Izin;

use App\Helpers\Flash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name;
    public $permissions = []; 
    public $allpermissions = [];

    public function mount()
    {
        $this->allpermissions = Permission::get();
    }

    public function createizin()
    {    
        $this->validate([
            "name" => "required|unique:roles,name",
            "permissions" => "required"
        ]);
        
        $role = Role::create([
            'name' => $this->name
        ]);

        $role->syncPermissions($this->permissions);
        Flash::success("Perizinan berhasil di buat");
        $this->dispatch('izinUpdated')->to(\App\Livewire\Izin\Index::class);
    }

    public function resetForm()
    {
        $this->reset(['name','permissions']);

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.izin.create');
    }
}
