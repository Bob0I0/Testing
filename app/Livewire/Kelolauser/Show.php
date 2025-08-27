<?php

namespace App\Livewire\Kelolauser;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    
    public $search = '';
    
    #[On('userUpdated')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    #[Computed]
    public function datauser(){
        $query = User::query();
        return $query
            ->when($this->search, function($query){
                $query->where('username', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.kelolauser.show');
    }
}
