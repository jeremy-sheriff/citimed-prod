<?php

namespace App\Livewire\Iam;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $role = '';
    public $roles = [];

    public function mount()
    {
        if (!$this->user || !$this->user->can('view payments')) {
            abort(403, 'Unauthorized');
        }
        $this->roles = Role::pluck('name')->toArray(); // Fetch available roles
    }

    public function registerUser()
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->role);

        session()->flash('success', 'User registered successfully and role assigned.');

        $this->reset(['name', 'email', 'password', 'role']);
    }

    public function render()
    {
        return view('livewire.iam.users');
    }
}
