<?php

namespace App\Livewire\Iam;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public array $roles = [];

    public $user;

    public array $permissions = [];

    public function mount(): void
    {
        $this->user = Auth::user();

//        dd();
        $roles = Role::all()->toArray();

        foreach ($roles as $role) {
            $this->roles[] = $role['name'];
        }

    }

    public function render()
    {
        return view('livewire.iam.roles');
    }
}
