<?php

namespace App\Livewire\Visits;

use App\Models\Balance;
use App\Models\Payment;
use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Carbon\Carbon;

/**
 * Add Visit Livewire Component
 *
 * This component handles the functionality for adding new patient visits in the medical system.
 * It provides features for:
 * - Searching and selecting patients
 * - Recording medical information for the visit
 * - Handling financial transactions related to the visit
 * - Displaying a paginated list of patients
 */
class Add extends Component
{
    use WithPagination;

    /**
     * Patient Information Properties
     */
    public $patient_id = '';
    public Patient|null $patient = null;
    public $selected_patient = null;

    /**
     * Visit Medical Information Properties
     */
    #[Validate('required|string|max:1000')]
    public string $complaints = '';

    #[Validate('nullable|string|max:2000')]
    public string $history_of_presenting_illness = '';

    #[Validate('nullable|string|max:500')]
    public string $allergies = '';

    #[Validate('nullable|string|max:2000')]
    public $physical_examination = '';

    #[Validate('nullable|string|max:1000')]
    public string $lab_test = '';

    #[Validate('nullable|string|max:1000')]
    public $imaging = '';

    #[Validate('required|string|max:1000')]
    public $diagnosis = '';

    #[Validate('required|in:chronic,infection,short_term')]
    public $type_of_diagnosis = 'infection'; // Set default value

    #[Validate('nullable|string|max:2000')]
    public $prescriptions = '';

    /**
     * Financial Information Properties
     */
    #[Validate('required|numeric|min:0')]
    public $amount_charged = 0;

    #[Validate('required|numeric|min:0')]
    public $amount_paid = 0;

    #[Validate('required|in:cash,mpesa,bank_transfer,insurance')]
    public $mode_of_payment = 'cash';

    public $previous_balance = 0;
    public $previous_balance_id = null;
    public $calculated_balance = 0;

    /**
     * Patient Search Properties
     */
    // Table search
    public $search_number = '';
    public $search_name = '';

    // Dropdown search
    public $search = '';
    public $results = [];
    public $selectedPatientId = null;
    public $selectedPatientName = '';
    public $selectedPatient = null;
    public $showDropdown = false;

    /**
     * VALIDATION RULES METHOD
     */
    protected function rules()
    {
        return [
            'selectedPatientId' => 'required|exists:patients,id',
            'complaints' => 'required|string|max:1000',
            'history_of_presenting_illness' => 'nullable|string|max:2000',
            'allergies' => 'nullable|string|max:500',
            'physical_examination' => 'nullable|string|max:2000',
            'lab_test' => 'nullable|string|max:1000',
            'imaging' => 'nullable|string|max:1000',
            'diagnosis' => 'required|string|max:1000',
            'type_of_diagnosis' => 'required|in:chronic,infection,short_term',
            'prescriptions' => 'nullable|string|max:2000',
            'amount_charged' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'mode_of_payment' => 'required|in:cash,mpesa,bank_transfer,insurance',
        ];
    }

    /**
     * VALIDATION MESSAGES
     */
    protected function messages()
    {
        return [
            'selectedPatientId.required' => 'Please select a patient.',
            'selectedPatientId.exists' => 'The selected patient is invalid.',
            'complaints.required' => 'Please enter the patient complaints.',
            'diagnosis.required' => 'Please enter the diagnosis.',
            'type_of_diagnosis.required' => 'Please select the type of diagnosis.',
            'amount_charged.required' => 'Please enter the amount charged.',
            'amount_paid.required' => 'Please enter the amount paid.',
        ];
    }

    /**
     * PATIENT SEARCH AND SELECTION METHODS
     */

    /**
     * Handles live search as user types in the patient search field
     * Updates search results and manages the dropdown visibility
     */
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
            $this->selectedPatient = null;
            $this->previous_balance = 0;
            $this->calculateBalance();
        }
    }

    /**
     * Selects a patient from the search results
     *
     * @param int $patientId The ID of the selected patient
     * @param string $patientName The name of the selected patient
     */
    public function selectPatient($patientId, $patientName)
    {
        $this->selectedPatientId = $patientId;
        $this->selectedPatientName = $patientName;
        $this->selectedPatient = Patient::find($patientId);
        $this->search = $patientName;
        $this->showDropdown = false;
        $this->results = [];

        // Update previous balance when patient is selected
//        $this->previous_balance = $this->getPreviousBalance($patientId);
        $this->calculateBalance();

        // Emit event for parent components
        $this->dispatch('patientSelected', [
            'id' => $patientId,
            'name' => $patientName,
            'patient' => $this->selectedPatient
        ]);
    }

    /**
     * Clears the currently selected patient
     */
    public function clearSelection()
    {
        $this->selectedPatientId = null;
        $this->selectedPatientName = '';
        $this->selectedPatient = null;
        $this->search = '';
        $this->showDropdown = false;
        $this->results = [];
        $this->previous_balance = 0;
        $this->calculateBalance();

        $this->dispatch('patientCleared');
    }

    /**
     * Hides the search dropdown when clicking outside
     */
    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    /**
     * COMPONENT LIFECYCLE METHODS
     */

    /**
     * Initialize the component
     *
     * @param int|null $patientId Optional patient ID to pre-select
     */
    public function mount($patientId = null)
    {
        if ($patientId) {
            $patient = Patient::find($patientId);
            if ($patient) {
                $this->selectPatient($patient->id, $patient->name);
            }
        }
    }

    /**
     * Set the patient for the modal
     *
     * @param Patient $patient The patient to set
     */
    public function setModal(Patient $patient)
    {
        $this->patient = $patient;
        $this->selectPatient($patient->id, $patient->name);
    }

    /**
     * TABLE SEARCH AND PAGINATION METHODS
     */

    /**
     * Search patients by number and reset pagination
     */
    public function searchByNumber()
    {
        $this->resetPage();
    }

    /**
     * Search patients by name and reset pagination
     */
    public function searchByName()
    {
        $this->resetPage();
    }

    /**
     * Clear all search fields and reset pagination
     */
    public function clearSearch()
    {
        $this->search_number = '';
        $this->search_name = '';
        $this->resetPage();
    }

    /**
     * Reset pagination when search number is updated
     */
    public function updatedSearchNumber()
    {
        $this->resetPage();
    }

    /**
     * Reset pagination when search name is updated
     */
    public function updatedSearchName()
    {
        $this->resetPage();
    }

    /**
     * PATIENT AND FINANCIAL DATA METHODS
     */

    /**
     * Handle changes to the patient ID
     * Updates selected patient and calculates previous balance
     *
     * @param mixed $value The new patient ID value
     */
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

    /**
     * Recalculate balance when amount charged is updated
     */
    public function updatedAmountCharged()
    {
        $this->calculateBalance();
    }

    /**
     * Recalculate balance when amount paid is updated
     */
    public function updatedAmountPaid()
    {
        $this->calculateBalance();
    }

    /**
     * Calculate the balance based on previous balance, amount charged, and amount paid
     */
    public function calculateBalance()
    {
        $total_due = $this->previous_balance + $this->amount_charged;
        $this->calculated_balance = $total_due - $this->amount_paid;
    }

    /**
     * Get the previous balance for a patient
     *
     * @param int $patient_id The patient ID to check for previous balance
     * @return float The previous balance amount
     */
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

    /**
     * DATA SAVING METHODS
     */

    /**
     * Save a new visit with all related data
     *
     * Creates a visit record, payment record, and handles balance calculations
     *
     * @return \Illuminate\Http\RedirectResponse|void Redirects to visits index on success
     */
    public function saveVisit()
    {
        // Validate the form data
        $this->validate();

        // Check if patient is selected
        if (!$this->selectedPatientId) {
            $this->addError('selectedPatientId', 'Please select a patient.');
            return;
        }




        try {
            // Create the visit
            $visit = Visit::create([
                'patient_id' => $this->selectedPatientId,
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

            dd($visit);

            // Create the payment
            $payment = Payment::create([
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
            $this->resetForm();

            session()->flash('success', 'Visit created successfully!');

            // Close modal and redirect
            $this->dispatch('close-modal', 'add-visit');
            return redirect()->route('visits.index');

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while creating the visit. Please try again.');
            Log::error('Visit creation error: ' . $e->getMessage(), [
                'patient_id' => $this->selectedPatientId,
                'exception' => $e
            ]);
        }
    }

    /**
     * Reset all form fields
     */
    private function resetForm()
    {
        $this->reset([
            'complaints', 'history_of_presenting_illness', 'allergies',
            'physical_examination', 'lab_test', 'imaging', 'diagnosis',
            'prescriptions', 'amount_charged', 'amount_paid'
        ]);

        // Reset patient selection
        $this->clearSelection();

        // Reset other properties
        $this->previous_balance = 0;
        $this->calculated_balance = 0;
        $this->selected_patient = null;
        $this->type_of_diagnosis = 'infection';
        $this->mode_of_payment = 'cash';
    }

    /**
     * RENDERING METHODS
     */

    /**
     * Render the component
     *
     * Handles patient filtering based on search criteria and returns the view
     *
     * @return \Illuminate\View\View The component view
     */
    public function render()
    {
        // Build query with filters
        $query = Patient::query();

        if ($this->search_number) {
            $query->where('number', 'like', '%' . $this->search_number . '%');
        }

        if ($this->search_name) {
            $query->where('name', 'like', '%' . $this->search_name . '%');
        }

        // Get paginated results
        $patients = $query->orderBy('name')->paginate(15, ['*'], 'patient_page', $this->patient_page ?? 1);

        // Return view with data
        return view('livewire.visits.add', compact('patients'));
    }
}
