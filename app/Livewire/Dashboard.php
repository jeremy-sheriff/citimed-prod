<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $user;
    public array $roles = [];
    public array $permissions = [];

    public function mount(): void
    {
        $this->user = Auth::user();

        if (!$this->user || !$this->user->can('view payments')) {
            abort(403, 'Unauthorized');
        }

        $this->roles = $this->user->getRoleNames()->toArray();

        foreach (
            $this->user->getAllPermissions() as $permission
        ){
            $this->permissions[] = $permission->name;
        }
//        dd($this->user->getAllPermissions());
//        $this->permissions = $this->user->getAllPermissions()->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
