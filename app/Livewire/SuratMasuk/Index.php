<?php

namespace App\Livewire\SuratMasuk;

use App\Models\SuratMasuk;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    
    #[Computed]
    public function SuratMasukIndex(){
        $query = SuratMasuk::query();
        return $query
            ->when($this->search, function($query){
                $query->where('nomor_surat', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(5);
    }
    public function render()
    {
        return view('livewire.surat-masuk.index');
    }
}
