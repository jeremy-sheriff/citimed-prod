<?php

namespace App\Livewire\Visits;

use App\Models\Balance;
use App\Models\Payment;
use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination; // Add this trait
use Carbon\Carbon;

class Add extends Component
{
    use WithPagination; // Add this trait

    #[Validate('required|exists:patients,id')]
    public $patient_id = '';

    public Patient|null $patient = null;

    #[Validate('required|string|max:1000')]
    public string $complaints = 'Complaints:';

    #[Validate('nullable|string|max:2000')]
    public string $history_of_presenting_illness = 'History of presenting illness:';

    #[Validate('nullable|string|max:500')]
    public string $allergies = 'Allergies';

    #[Validate('nullable|string|max:2000')]
    public $physical_examination = 'Physical examination results';

    #[Validate('nullable|string|max:1000')]
    public string $lab_test = 'Lab test results';

    #[Validate('nullable|string|max:1000')]
    public $imaging = 'Imaging data';

    #[Validate('required|string|max:1000')]
    public $diagnosis = 'Homa';

    #[Validate('required|in:chronic,infection,short_term')]
    public $type_of_diagnosis = '';

    #[Validate('nullable|string|max:2000')]
    public $prescriptions = 'Kulala';

    #[Validate('required|numeric|min:0')]
    public $amount_charged = 0;

    #[Validate('required|numeric|min:0')]
    public $amount_paid = 0;

    #[Validate('required|in:cash,mpesa,bank_transfer,insurance')]
    public $mode_of_payment = 'cash';

    public $previous_balance = 0;
    public $previous_balance_id = null;
    public $calculated_balance = 0;
    public $selected_patient = null;

    // Search properties
    public $search_number = '';
    public $search_name = '';

    public $search = '';
    public $results = [];
    public $selectedPatientId = null;
    public $selectedPatientName = '';
    public $showDropdown = false;

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->results = Patient::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('number', 'like', '%' . $this->search . '%')
                ->limit(10)
                ->get();
            $this->showDropdown = true;
        } else {
            $this->results = [];
            $this->showDropdown = false;
        }

        // Clear selection if search changes
        if ($this->search !== $this->selectedPatientName) {
            $this->selectedPatientId = null;
            $this->selectedPatientName = '';
        }
    }

    public function selectPatient($patientId, $patientName)
    {
        $this->selectedPatientId = $patientId;
        $this->selectedPatientName = $patientName;
        $this->search = $patientName;
        $this->showDropdown = false;
        $this->results = [];

        // Emit event for parent components
        $this->dispatch('patientSelected', [
            'id' => $patientId,
            'name' => $patientName
        ]);
    }

    public function clearSelection()
    {
        $this->selectedPatientId = null;
        $this->selectedPatientName = '';
        $this->search = '';
        $this->showDropdown = false;
        $this->results = [];

        $this->dispatch('patientCleared');
    }

    // Hide dropdown when clicking outside
    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    // Remove the $patients property since we'll use render() method
    // public $patients = [];

    public function mount($patientId = null)
    {
        $this->patient_id = $patientId;
    }

    public function setModal(Patient $patient)
    {
        $this->patient = $patient;
        $this->patient_id = $patient->id;
    }

    public function createVisit(){

    }

    // Remove the loadPatients method since we'll handle this in render()
    /*
    public function loadPatients()
    {
        $query = Patient::query();

        if ($this->search_number) {
            $query->where('number', 'like', '%' . $this->search_number . '%');
        }

        if ($this->search_name) {
            $query->where('name', 'like', '%' . $this->search_name . '%');
        }

        $this->patients = $query->orderBy('name')->get();
    }
    */

    public function searchByNumber()
    {
        $this->resetPage(); // Reset pagination when searching
    }

    public function searchByName()
    {
        $this->resetPage(); // Reset pagination when searching
    }

    public function clearSearch()
    {
        $this->search_number = '';
        $this->search_name = '';
        $this->resetPage(); // Reset pagination when clearing search
    }

    public function updatedPatientId($value)
    {
        if ($value) {
            $this->selected_patient = Patient::find($value);
            $this->previous_balance = $this->getPreviousBalance($value);
            $this->calculateBalance();
        } else {
            $this->selected_patient = null;
            $this->previous_balance = 0;
            $this->calculateBalance();
        }
    }

    // Add updatedSearchNumber and updatedSearchName to reset pagination when typing
    public function updatedSearchNumber()
    {
        $this->resetPage();
    }

    public function updatedSearchName()
    {
        $this->resetPage();
    }

    public function updatedAmountCharged()
    {
        $this->calculateBalance();
    }

    public function updatedAmountPaid()
    {
        $this->calculateBalance();
    }

    public function calculateBalance()
    {
        $total_due = $this->previous_balance + $this->amount_charged;
        $this->calculated_balance = $total_due - $this->amount_paid;
    }

    public function getPreviousBalance($patient_id)
    {
        $visit = Visit::where('patient_id', $patient_id);

        if (!$visit->exists()) {
            return 0;
        }

        $last_visit = Visit::where('patient_id', $patient_id)
            ->with(['payment.balances'])
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$last_visit || !$last_visit->payment) {
            return 0;
        }

        $last_visit_balances = $last_visit->payment->balances;

        if ($last_visit_balances->isEmpty()) {
            return 0;
        }

        $latest_balance = $last_visit_balances->where('status', '!=', 'carried_foward')->first();

        if ($latest_balance) {
            $this->previous_balance_id = $latest_balance->id;
            return $latest_balance->amount;
        }

        return 0;
    }

    public function saveVisit()
    {


        $this->validate();

        $patient_id = $this->selectedPatientId;

        try {
            // Create the visit
            $visit = Visit::query()->create([
                'patient_id' => $patient_id,
                'complaints' => $this->complaints,
                'history_of_presenting_illness' => $this->history_of_presenting_illness,
                'allergies' => $this->allergies,
                'physical_examination' => $this->physical_examination,
                'lab_test' => $this->lab_test,
                'imaging' => $this->imaging,
                'diagnosis' => $this->diagnosis,
                'type_of_diagnosis' => $this->type_of_diagnosis,
                'prescriptions' => $this->prescriptions,
            ]);

            // Create the payment
            $payment = Payment::query()->create([
                'visit_id' => $visit->id,
                'amount_charged' => $this->amount_charged,
                'amount_paid' => $this->amount_paid,
                'mode_of_payment' => $this->mode_of_payment,
                'balance' => $this->calculated_balance,
            ]);

            // Handle balance logic
            $next_balance = abs($this->amount_paid - ($this->previous_balance + $this->amount_charged));

            if ($next_balance >= 0) {
                // Mark the previous balance as carried forward if exists
                if ($this->previous_balance > 0 && $this->previous_balance_id) {
                    Balance::find($this->previous_balance_id)->update([
                        'status' => 'carried_foward'
                    ]);
                }

                // Create a new balance record
                Balance::create([
                    'payment_id' => $payment->id,
                    'amount' => $next_balance,
                    'status' => ($next_balance === 0) ? 'cleared' : 'not_cleared',
                ]);
            }

            // Reset form
            $this->reset([
                'complaints', 'history_of_presenting_illness', 'allergies',
                'physical_examination', 'lab_test', 'imaging', 'diagnosis',
                'type_of_diagnosis', 'prescriptions', 'amount_charged',
                'amount_paid', 'mode_of_payment'
            ]);

            $this->previous_balance = 0;
            $this->calculated_balance = 0;
            $this->selected_patient = null;

            session()->flash('success', 'Visit created successfully!');

            // Optionally redirect to visits index or show page
            return redirect()->route('visits.index');

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while creating the visit. Please try again.');
            Log::error('Visit creation error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Patient::query();

        if ($this->search_number) {
            $query->where('number', 'like', '%' . $this->search_number . '%');
        }

        if ($this->search_name) {
            $query->where('name', 'like', '%' . $this->search_name . '%');
        }

        $patients = $query->orderBy('name')->paginate(15, ['*'], 'patient_page', $this->patient_page ?? 1);


        return view('livewire.visits.add', compact('patients'));
    }
}
