<?php

namespace App\Livewire;

use App\Helpers\Flash;
use Livewire\Component;

class TestingPage extends Component
{
    public function plas()
    {
        // session()->flash("success","ok");
        Flash::success("Berhasil");
    }
    public function render()
    {
        return view('livewire.testing-page');
    }
}
