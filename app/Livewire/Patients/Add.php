<?php

namespace App\Livewire\Patients;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class Add extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|integer|min:0|max:120')]
    public string $age = '';

    #[Validate('required|in:Male,Female,Other')]
    public string $gender = 'female';

    #[Validate('required|string|max:20|unique:patients,phone_number')]
    public string $phone_number = '';

    #[Validate('required|string|max:500')]
    public string $location = '';

    #[Validate('nullable|string|max:1000')]
    public string $additional_information = '';

    public bool $isSubmitting = false;
    public bool $showSuccessMessage = false;

    protected array $messages = [
        'name.required' => 'Patient name is required.',
        'age.required' => 'Patient age is required.',
        'age.integer' => 'Age must be a valid number.',
        'age.min' => 'Age must be at least 0.',
        'age.max' => 'Age must be less than 120.',
        'gender.required' => 'Please select a gender.',
        'phone_number.required' => 'Phone number is required.',
        'location.required' => 'Location is required.',
    ];

    protected function generatePatientNumber(): int
    {
        $patient_number = 0;
        if (Patient::query()->count() === 0) {
            $patient_number = 100;
        } else {
            $patient = Patient::query()->latest('created_at')->first();
            $patient_number = $patient->number += 1;
        }
        return $patient_number;
    }


    // Capitalize the name when the user types
    public function capitalizeName()
    {
        // Capitalize the first letter of each word in the name
        $this->name = ucwords(strtolower($this->name));
        $this->location = ucwords(strtolower($this->location));
    }

    public function save()
    {
        $this->isSubmitting = true;

        $this->validate();

        try {
            DB::beginTransaction();

            $patient_number = $this->generatePatientNumber();
            Patient::query()->create([
                'name' => $this->name,
                'age' => $this->age,
                'gender' => $this->gender,
                'number' => $patient_number,
                'phone_number' => $this->phone_number,
                'residence' => $this->location,
                'information' => $this->additional_information,
            ]);

            DB::commit();

            // Reset form
            $this->reset(['name', 'age', 'gender', 'phone_number', 'location', 'additional_information']);
            $this->gender = 'female'; // Reset to default

            $this->showSuccessMessage = true;

            // Hide a success message after 3 seconds
            $this->dispatch(['patient-created']);
            $this->dispatch('hide-success-message');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'An error occurred while saving patient information. Please try again.');
        }

        $this->isSubmitting = false;
    }

    public function hideSuccessMessage()
    {
        $this->showSuccessMessage = false;
    }

    public function render()
    {
        return view('livewire.patients.add');
    }
}
