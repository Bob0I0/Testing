<?php

namespace App\Livewire\SuratKeluar;

use App\Models\SuratKeluar;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; // Import Livewire Attributes untuk listener

class Show extends Component
{
    use WithPagination;

    public $search = '';
    
    #[On('suratUpdated')]
    public function refreshTable()
    {
        $this->resetPage();
    }

    #[Computed]
    public function datakeluar(){
        $query = SuratKeluar::query();
        return $query
            ->when($this->search, function($query){
                $query->where('nomor_surat', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.surat-keluar.show');
    }
}