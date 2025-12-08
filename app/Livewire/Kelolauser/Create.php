<?php

namespace App\Livewire\Kelolauser;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Helpers\Flash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $allroles;

    #[Validate('required', message: 'Wajib Di Isi')]
    public $name;
    
    #[Validate('required', message: 'Wajib Di Isi')]
    #[Validate('unique:users,username', message: 'Username Sudah Dipakai')]
    public $username;

    public $password;
    public $password_confirmation;
    
    #[Validate('required', message: 'Wajib Memiliki Level')]
    public $roles = [];

    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required'   => 'Password wajib diisi',
            'password.confirmed'  => 'Konfirmasi password tidak cocok',
            'password.min:8'      => 'Password minimal harus 8 karakter',
            'password.letters'    => 'Password harus mengandung huruf',
            'password.mixed'      => 'Password harus mengandung huruf besar dan kecil',
            'password.numbers'    => 'Password harus mengandung angka',
            'password.symbols'    => 'Password harus mengandung simbol',
        ];
    }

    public function mount()
    {
        $this->allroles = Role::all();
    }

    public function createuser()
    {
        // $this->validate([
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|string|max:255|unique:users,username',
        //     'roles' => 'required',
        //     'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        // ]);
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
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
