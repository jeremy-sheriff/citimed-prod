<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Collection;

class History extends Component
{
    public Patient $patient;


    protected $listeners = [
        'open-patient-history' => 'loadPatientHistory',
    ];


    public function loadPatientHistory(Patient $patient): void
    {
        $this->patient = $patient;
    }

    public function render()
    {
        return view('livewire.patients.history');
    }
}
