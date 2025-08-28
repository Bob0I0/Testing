<?php

namespace App\Livewire\Izin;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    
    #[On('izinUpdated')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    public function render()
    {
        $roles = Role::paginate(5);
        return view('livewire.izin.index',compact("roles"));
    }
}
