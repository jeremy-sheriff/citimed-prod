<?php

namespace App\Livewire\Visits;

use App\Models\Visit;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Lists extends Component
{
    use WithPagination;

    public $visits;

    protected $listeners = [
        'visit-created' => 'refreshVisits',
    ];

    public function mount()
    {
        $this->fetchVisits();
    }

    public function fetchVisits(): void
    {
        $this->visits = Visit::with('patient')->latest()->get();
    }

    public function refreshVisits()
    {
        Log::info("Refreshing visits");
        $this->fetchVisits(); // Re-fetch the data
    }

    public function render()
    {
        return view('livewire.visits.lists', ['visits' => $this->visits]);
    }
}
