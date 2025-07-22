<?php

namespace App\Livewire\Iam;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public \Illuminate\Database\Eloquent\Collection $roles;
    public $user;
    public array $permissions = [];

    public function mount(): void
    {
        $this->user = Auth::user();

        // Get all roles with their associated permissions, keeping them as Eloquent objects
        $this->roles = Role::with('permissions')->get();

        // Optional: You can prepare permissions list if needed
        // $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.iam.roles');
    }
}
