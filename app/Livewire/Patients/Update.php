<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{

    #[Validate('required|string|max:255')]
    public string $name = '';

    public string $number = '';

    #[Validate('required|integer|min:0|max:120')]
    public string $age = '';

    #[Validate('required|in:male,female,other')]
    public string $gender = 'female';

    #[Validate('required|string|max:20|unique:patients,phone_number')]
    public string $phone_number = '';

    #[Validate('required|string|max:500')]
    public string $location = '';

    #[Validate('nullable|string|max:1000')]
    public string $additional_information = 'More information about patient';
    public bool $isSubmitting = false;
    public bool $showSuccessMessage = false;
    protected $listeners = [
        'update-patient' => 'updatePatient',
    ];


    public function updatePatient(Patient $patient){
        $this->phone_number = $patient->phone_number;
        $this->name = $patient->name;
        $this->age = $patient->age;
        $this->gender = $patient->gender;
        $this->location = $patient->residence;
        $this->additional_information = $patient->information;
        $this->number = $patient->number;
    }

    public function save(){
        try {
        DB::beginTransaction();
        Patient::query()->where(
            'number', $this->number
        )->update([
            'name' => $this->name,
            'age' => $this->age,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'residence' => $this->location,
            'information' => $this->additional_information,
        ]);

        DB::commit();

            // Hide a success message after 3 seconds
            $this->dispatch(['patient-updated']);
            $this->dispatch('hide-success-message');

            $this->showSuccessMessage = true;
        } catch (Exception $e) {
            DB::rollBack();
            $this->addError('general', 'An error occurred while updating patient information. Please try again.');
        }
    }


    public function hideSuccessMessage()
    {
        $this->showSuccessMessage = false;
    }
    public function render()
    {
        return view('livewire.patients.update');
    }
}
