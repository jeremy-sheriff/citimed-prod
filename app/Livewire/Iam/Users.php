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
    public $user = '';
    public $users = '';

    public function mount()
    {
        $this->user = auth()->user();

        if(!$this->user->hasRole('super-admin-role')){
            abort(403, 'Unauthorized');
        }

        $this->roles = Role::pluck('name')->toArray(); // Fetch available roles
        $this->users = User::all();
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
