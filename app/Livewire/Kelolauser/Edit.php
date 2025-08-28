<?php

namespace App\Livewire\Kelolauser;

use App\Helpers\Flash;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $userId, $user, $name, $username, $password, $password_confirmation;
    // public $allroles = [];

    public function mount($userId) 
    {
        $this->userId = $userId;
        
        $user = User::findOrFail($this->userId);
        // $this->allroles=Role::findOrFail($userId);
        $this->name = $user->name;
        $this->username = $user->username;
    }
    

    public function updateacc(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'unique:users,username,' .  $this->userId],
            'password' => ['nullable', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); 
        }
        $user = User::findOrFail($this->userId);
        $user->update($validated);
        Flash::success("User Berhasil diedit");
        $this->dispatch('userUpdated')->to(\App\Livewire\Kelolauser\Show::class);
    }

    public function resetForm()
    {
        $this->reset();

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.kelolauser.edit');
    }
}