<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a doctor user
        User::factory()->doctor()->create([
            'name' => 'Doctor User',
            'email' => 'doctor@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create a nurse user
        User::factory()->nurse()->create([
            'name' => 'Nurse User',
            'email' => 'nurse@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create a lab technician user
        User::factory()->labTechnician()->create([
            'name' => 'Lab Technician',
            'email' => 'lab@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create a pharmacist user
        User::factory()->pharmacist()->create([
            'name' => 'Pharmacist User',
            'email' => 'pharmacy@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create a receptionist user
        User::factory()->receptionist()->create([
            'name' => 'Receptionist User',
            'email' => 'reception@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create a finance officer user
        User::factory()->financeOfficer()->create([
            'name' => 'Finance Officer',
            'email' => 'finance@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create an inventory manager user
        User::factory()->inventoryManager()->create([
            'name' => 'Inventory Manager',
            'email' => 'inventory@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create an HR officer user
        User::factory()->hrOfficer()->create([
            'name' => 'HR Officer',
            'email' => 'hr@citimed.com',
            'password' => Hash::make('password'),
        ]);

        // Create additional random users with various roles
        User::factory()->count(3)->doctor()->create();
        User::factory()->count(5)->nurse()->create();
        User::factory()->count(2)->labTechnician()->create();
        User::factory()->count(2)->pharmacist()->create();
        User::factory()->count(3)->receptionist()->create();
    }
}
