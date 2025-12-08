<?php

namespace App\Livewire\Komponen;

use Livewire\Component;

class Searchbar extends Component
{
    public $search;

    public function updatedSearch()
    {
        // Mengirimkan event 'searchUpdated' ke komponen induknya (Filter)
        $this->dispatch('searchUpdated', $this->search);
    }

    public function render()
    {
        return view('livewire.komponen.searchbar');
    }
}
