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
    public $amount_charged = null;

    #[Validate('required|numeric|min:0')]
    public $amount_paid = null;

    #[Validate('required|in:cash,mpesa,bank_transfer,insurance')]
    public $mode_of_payment = 'cash';

    public $previous_balance = 0;
    public $previous_balance_id = null;
    public $calculated_balance = 0;

    /**
     * Patient Search Properties
     */
    public $search = '';
    public $results = [];
    public $selectedPatientId = null;
    public $selectedPatientName = '';
    public $selectedPatient = null;
    public $showDropdown = false;

    /**
     * Define validation rules for the visit form
     *
     * @return array Array of validation rules for each form field
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
            'amount_charged' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'amount_paid' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'mode_of_payment' => 'required|in:cash,mpesa,bank_transfer,insurance',
        ];
    }

    /**
     * Define custom validation error messages
     *
     * @return array Array of custom error messages for validation rules
     */
    protected function messages()
    {
        return [
            // Patient validation messages
            'selectedPatientId.required' => 'Please select a patient.',
            'selectedPatientId.exists' => 'The selected patient is invalid.',

            // Medical information validation messages
            'complaints.required' => 'Please enter the patient complaints.',
            'complaints.string' => 'Complaints must be text.',
            'complaints.max' => 'Complaints cannot exceed 1000 characters.',

            'history_of_presenting_illness.string' => 'History of presenting illness must be text.',
            'history_of_presenting_illness.max' => 'History of presenting illness cannot exceed 2000 characters.',

            'allergies.string' => 'Allergies must be text.',
            'allergies.max' => 'Allergies cannot exceed 500 characters.',

            'physical_examination.string' => 'Physical examination must be text.',
            'physical_examination.max' => 'Physical examination cannot exceed 2000 characters.',

            'lab_test.string' => 'Lab test must be text.',
            'lab_test.max' => 'Lab test cannot exceed 1000 characters.',

            'imaging.string' => 'Imaging must be text.',
            'imaging.max' => 'Imaging cannot exceed 1000 characters.',

            'diagnosis.required' => 'Please enter the diagnosis.',
            'diagnosis.string' => 'Diagnosis must be text.',
            'diagnosis.max' => 'Diagnosis cannot exceed 1000 characters.',

            'type_of_diagnosis.required' => 'Please select the type of diagnosis.',
            'type_of_diagnosis.in' => 'Type of diagnosis must be chronic, infection, or short-term.',

            'prescriptions.string' => 'Prescriptions must be text.',
            'prescriptions.max' => 'Prescriptions cannot exceed 2000 characters.',

            // Financial information validation messages
            'amount_charged.required' => 'Please enter the amount charged.',
            'amount_charged.numeric' => 'Amount charged must be a number.',
            'amount_charged.min' => 'Amount charged cannot be negative.',
            'amount_charged.regex' => 'Amount charged must have at most 2 decimal places.',

            'amount_paid.required' => 'Please enter the amount paid.',
            'amount_paid.numeric' => 'Amount paid must be a number.',
            'amount_paid.min' => 'Amount paid cannot be negative.',
            'amount_paid.regex' => 'Amount paid must have at most 2 decimal places.',

            'mode_of_payment.required' => 'Please select the mode of payment.',
            'mode_of_payment.in' => 'Mode of payment must be cash, mpesa, bank transfer, or insurance.',
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
            $this->previous_balance_id = null;
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

        // Get and set the previous balance for this patient
        $this->previous_balance = $this->getPreviousBalance($patientId);

        // Update calculated balance
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
        $this->previous_balance_id = null;
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
        $this->selectPatient($patient->id, $patient->name);
    }


    /**
     * PATIENT AND FINANCIAL DATA METHODS
     */


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
        // Convert empty strings, null values, or non-numeric values to 0
        $previous_balance = is_numeric($this->previous_balance) ? (float)$this->previous_balance : 0;
        $amount_charged = is_numeric($this->amount_charged) ? (float)$this->amount_charged : 0;
        $amount_paid = is_numeric($this->amount_paid) ? (float)$this->amount_paid : 0;

        $total_due = $previous_balance + $amount_charged;
        $calculated_balance = $total_due - $amount_paid;

        // If amount paid is greater than total due, set balance to zero (no excess payments)
        $this->calculated_balance = max(0, $calculated_balance);
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

        $latest_balance = $last_visit_balances->where('status', '!=', 'carried_forward')->first();

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
     * Orchestrates the process of creating a visit record, payment record, and handling balance calculations
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
            // Create the visit record
            $visit = $this->createVisitRecord();

            // Create the payment record
            $payment = $this->createPaymentRecord($visit->id);

            // Handle balance calculations and updates
            $this->handleBalanceLogic($payment->id);

            // Complete the process
            $this->finalizeVisitCreation();

            // Close modal and redirect
            $this->dispatch('close-modal', 'add-visit');
//            return redirect()->route('visits.index');

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database-related errors
            $errorMessage = 'Database error occurred while saving the visit.';
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $errorMessage = 'This visit record already exists in the database.';
            } elseif (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
                $errorMessage = 'Invalid reference to a related record. Please check your data.';
            }
            session()->flash('error', $errorMessage);
            Log::error('Visit creation database error: ' . $e->getMessage(), [
                'patient_id' => $this->selectedPatientId,
                'exception' => $e
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            session()->flash('error', 'Please correct the validation errors and try again.');
            Log::error('Visit creation validation error: ' . $e->getMessage(), [
                'patient_id' => $this->selectedPatientId,
                'exception' => $e
            ]);
        } catch (\Exception $e) {
            // Handle all other exceptions
            $errorMessage = 'An error occurred while creating the visit. Please try again.';
            session()->flash('error', $errorMessage);
            Log::error('Visit creation error: ' . $e->getMessage(), [
                'patient_id' => $this->selectedPatientId,
                'exception' => $e
            ]);
        }
    }

    /**
     * Creates a new visit record with the current form data
     *
     * @return \App\Models\Visit The newly created visit record
     */
    private function createVisitRecord()
    {
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

        $this->dispatch('visit-created');

        return $visit;
    }

    /**
     * Creates a new payment record for the given visit
     *
     * @param int $visitId The ID of the visit to associate with the payment
     * @return \App\Models\Payment The newly created payment record
     */
    private function createPaymentRecord($visitId)
    {
        return Payment::create([
            'visit_id' => $visitId,
            'amount_charged' => $this->amount_charged,
            'amount_paid' => $this->amount_paid,
            'mode_of_payment' => $this->mode_of_payment,
            'balance' => $this->calculated_balance,
        ]);
    }

    /**
     * Handles balance calculations and updates
     *
     * Updates previous balance status and creates a new balance record
     *
     * @param int $paymentId The ID of the payment to associate with the balance
     */
    private function handleBalanceLogic($paymentId)
    {
        // Calculate total due and next balance
        $total_due = $this->previous_balance + $this->amount_charged;
        $next_balance = max(0, $total_due - $this->amount_paid); // Ensure balance never goes below 0

        // Mark the previous balance as carried forward if exists
        if ($this->previous_balance > 0 && $this->previous_balance_id) {
            Balance::find($this->previous_balance_id)->update([
                'status' => 'carried_forward'
            ]);
        }

        // Create a new balance record
        Balance::create([
            'payment_id' => $paymentId,
            'amount' => $next_balance,
            'status' => ($next_balance === 0) ? 'cleared' : 'not_cleared',
        ]);
    }

    /**
     * Finalizes the visit creation process
     *
     * Resets the form and shows a success message
     */
    private function finalizeVisitCreation()
    {
        // Reset form
        $this->resetForm();

        // Show success message
        session()->flash('success', 'Visit created successfully!');
    }

    /**
     * Reset all form fields to their default values
     *
     * Clears all form inputs, patient selection, and resets financial calculations.
     * Sets default values for type_of_diagnosis and mode_of_payment.
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
        $this->previous_balance_id = null;
        $this->calculated_balance = 0;
        $this->selected_patient = null;
        $this->type_of_diagnosis = 'infection';
        $this->mode_of_payment = 'cash';

        // Set financial fields to null for clean inputs
        $this->amount_charged = null;
        $this->amount_paid = null;
    }

    /**
     * RENDERING METHODS
     */

    /**
     * Render the component
     *
     * @return \Illuminate\View\View The component view
     */
    public function render()
    {
        // Get paginated results of visits with patient information
        $visits = Visit::with('patient')->orderBy('created_at', 'desc')->paginate(15);

        // Return view with data
        return view('livewire.visits.add', compact('visits'));
    }
}
