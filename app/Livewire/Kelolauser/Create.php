<?php

namespace App\Livewire\Kelolauser;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use App\Helpers\Flash;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $allroles;
    public $name;
    public $username;
    public $password;
    public $password_confirmation;
    public $roles = [];

    public function mount()
    {
        $this->allroles = Role::all();
    }

    public function createuser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'roles' => 'required',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'name' => $this->name,
            'username' => $this->name,
            'password' => Hash::make($this->password)
        ]);
        
        $user->syncRoles($this->roles);
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
