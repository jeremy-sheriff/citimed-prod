<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Patients extends Component
{
    public $user;
    public $roles = [];
    public $permissions = [];

    public function mount()
    {
        $this->user = Auth::user();

        $this->roles = $this->user->getRoleNames();
        $this->permissions = $this->user->getAllPermissions()->pluck('name');
    }

    public function render()
    {
        return view('livewire.patients');
    }
}
