<?php

namespace App\Livewire\Patients;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class Add extends Component
{
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|integer|min:0|max:120')]
    public $age = '';

    #[Validate('required|in:male,female,other')]
    public $gender = 'female';

    #[Validate('required|string|max:20')]
    public $phone_number = '';

    #[Validate('required|string|max:500')]
    public $location = '';

    #[Validate('nullable|string|max:1000')]
    public $additional_information = '';

    public $isSubmitting = false;
    public $showSuccessMessage = false;

    protected $messages = [
        'name.required' => 'Patient name is required.',
        'age.required' => 'Patient age is required.',
        'age.integer' => 'Age must be a valid number.',
        'age.min' => 'Age must be at least 0.',
        'age.max' => 'Age must be less than 120.',
        'gender.required' => 'Please select a gender.',
        'phone_number.required' => 'Phone number is required.',
        'location.required' => 'Location is required.',
    ];

    public function save()
    {
        $this->isSubmitting = true;

        $this->validate();

        try {
            DB::beginTransaction();

            Patient::create([
                'name' => $this->name,
                'age' => $this->age,
                'gender' => $this->gender,
                'phone_number' => $this->phone_number,
                'location' => $this->location,
                'additional_information' => $this->additional_information,
            ]);

            DB::commit();

            // Reset form
            $this->reset(['name', 'age', 'gender', 'phone_number', 'location', 'additional_information']);
            $this->gender = 'female'; // Reset to default

            $this->showSuccessMessage = true;

            // Hide success message after 3 seconds
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
