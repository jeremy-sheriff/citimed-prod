<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class Patients extends Component
{
    use WithPagination;

    public $user;
    public $roles = [];
    public $permissions = [];

    protected $listeners = [
        'patient-created' => '$refresh',
        'patient-updated' => '$refresh',
    ];

    // Search and filtering
    #[Url(as: 'q')]
    public $search = '';

    public int $perPage = 15;

    #[Url]
    public $sortField = 'created_at';

    #[Url]
    public $sortDirection = 'desc';

    #[Url]
    public $residenceFilter = '';

    #[Url]
    public $ageRange = '';

    // Selection
    public $selectedPatients = [];
    public $selectAll = false;

    // Modal states
    public $showDeleteModal = false;
    public $patientToDelete = null;
    public $showBulkDeleteModal = false;

    // Export
    public $isExporting = false;

    public function mount()
    {
        $this->user = Auth::user();
        $this->roles = $this->user->getRoleNames();
        $this->permissions = $this->user->getAllPermissions()->pluck('name');
    }

    public function openPatientHistory($patient){
        $this->dispatch('open-patient-history', ['patient' => $patient]);
    }

    public function updatePatient($patient){
        $this->dispatch('update-patient', ['patient' => $patient]);
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedResidenceFilter()
    {
        $this->resetPage();
    }

    public function updatedAgeRange()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedPatients = $this->getPatients()->pluck('id')->toArray();
        } else {
            $this->selectedPatients = [];
        }
    }

    public function getPatients()
    {
        $query = Patient::query();

        // Search functionality
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('patient_no', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }

        // Residence filter
        if ($this->residenceFilter) {
            $query->where('residence', $this->residenceFilter);
        }

        // Age range filter
        if ($this->ageRange) {
            switch ($this->ageRange) {
                case '18-30':
                    $query->whereBetween('age', [18, 30]);
                    break;
                case '31-50':
                    $query->whereBetween('age', [31, 50]);
                    break;
                case '51-70':
                    $query->whereBetween('age', [51, 70]);
                    break;
                case '70+':
                    $query->where('age', '>', 70);
                    break;
            }
        }

        // Sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate($this->perPage);
    }

    public function confirmDelete($patientId)
    {
        $this->patientToDelete = $patientId;
        $this->showDeleteModal = true;
    }

    public function deletePatient()
    {
        if ($this->patientToDelete && $this->user->can('delete patients')) {
            Patient::find($this->patientToDelete)->delete();

            $this->dispatch('patient-deleted', [
                'message' => 'Patient deleted successfully!'
            ]);

            $this->selectedPatients = array_diff($this->selectedPatients, [$this->patientToDelete]);
        }

        $this->showDeleteModal = false;
        $this->patientToDelete = null;
    }

    public function confirmBulkDelete()
    {
        if (count($this->selectedPatients) > 0) {
            $this->showBulkDeleteModal = true;
        }
    }

    public function bulkDelete()
    {
        if ($this->user->can('delete patients')) {
            Patient::whereIn('id', $this->selectedPatients)->delete();

            $count = count($this->selectedPatients);
            $this->selectedPatients = [];
            $this->selectAll = false;

            $this->dispatch('patients-deleted', [
                'message' => "{$count} patients deleted successfully!"
            ]);
        }

        $this->showBulkDeleteModal = false;
    }

    public function exportToExcel()
    {
        if ($this->user->can('export patients')) {
            $this->isExporting = true;

            // Dispatch browser event to trigger export
            $this->dispatch('export-patients');

            // Reset after a delay
            $this->dispatch('reset-export-state')->delay(3000);
        }
    }

    #[On('reset-export-state')]
    public function resetExportState()
    {
        $this->isExporting = false;
    }

    public function getResidenceOptions()
    {
        return Patient::distinct()->pluck('residence')->filter()->sort()->values();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'residenceFilter', 'ageRange']);
    }

    public function render()
    {
        return view('livewire.patients.patients', [
            'patients' => $this->getPatients(),
            'residenceOptions' => $this->getResidenceOptions(),
        ]);
    }
}
