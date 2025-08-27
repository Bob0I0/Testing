<?php

namespace App\Livewire\Pinjamsurat;

use App\Models\PinjamSurat;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    #[On('suratUpdated')]
    public function refreshTable()
    {
        $this->resetPage();
    }
    
    #[Computed]
    public function PinjamSurat(){
        $query = PinjamSurat::query();
        return $query
            ->when($this->search, function($query){
                $query->where('nomor_surat', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.pinjamsurat.index');
    }
}
