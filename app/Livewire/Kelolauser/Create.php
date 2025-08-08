<?php

namespace App\Livewire\Kelolauser;

use Livewire\Component;

class Create extends Component
{
    public function resetForm()
    {
        $this->reset();

        $this->resetValidation();
    }
    
    public function render()
    {
        
        return view('livewire.kelolauser.create');
    }
}
