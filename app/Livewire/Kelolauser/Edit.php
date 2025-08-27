<?php

namespace App\Livewire\Kelolauser;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;

class Edit extends Component
{
    public $user, $name, $username, $password, $password_confirmation;

    public function mount($userId) 
    {
        $this->user = User::findOrFail($userId);
        $this->name = $this->user->name;
        $this->username = $this->user->username;
    }

    public function updateacc(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'unique:username,' . $this->user->id],
            'password' => ['nullable', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); 
        }

        $this->user->update($validated);

        $this->redirect(route('kelola'));
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