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

    #[Validate('required|string|max:1000')]
    public $complaints = '';

    #[Validate('nullable|string|max:2000')]
    public $history_of_presenting_illness = '';

    #[Validate('nullable|string|max:500')]
    public $allergies = '';

    #[Validate('nullable|string|max:2000')]
    public $physical_examination = '';

    #[Validate('nullable|string|max:1000')]
    public $lab_test = '';

    #[Validate('nullable|string|max:1000')]
    public $imaging = '';

    #[Validate('required|string|max:1000')]
    public $diagnosis = '';

    #[Validate('required|in:chronic,infection,short_term')]
    public $type_of_diagnosis = '';

    #[Validate('nullable|string|max:2000')]
    public $prescriptions = '';

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

    // Remove the $patients property since we'll use render() method
    // public $patients = [];

    public function mount()
    {
        // Remove this since we don't need to load patients in mount anymore
        // $this->loadPatients();
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

    public function save()
    {
        $this->validate();

        try {
            // Create the visit
            $visit = Visit::create([
                'patient_id' => $this->patient_id,
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
                // Mark previous balance as carried forward if exists
                if ($this->previous_balance > 0 && $this->previous_balance_id) {
                    Balance::find($this->previous_balance_id)->update([
                        'status' => 'carried_foward'
                    ]);
                }

                // Create new balance record
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

        $patients = $query->orderBy('name')->paginate(8);

        return view('livewire.visits.add', compact('patients'));
    }
}
