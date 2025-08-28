<?php

namespace App\Livewire\Kelolauser;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use App\Helpers\Flash;

class Create extends Component
{
    public string $name = '';
    public string $username = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function createacc(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        Flash::success("User Berhasil Ditambahkan");
        $this->dispatch('userUpdated')->to(\App\Livewire\Kelolauser\Show::class);
        
    }

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
