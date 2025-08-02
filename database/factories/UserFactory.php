<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Assign a role to the user.
     */
    public function withRole(string $roleName): static
    {
        return $this->afterCreating(function ($user) use ($roleName) {
            $user->assignRole($roleName);
        });
    }

    /**
     * Create a super admin user.
     */
    public function superAdmin(): static
    {
        return $this->withRole('super-admin-role');
    }

    /**
     * Create a doctor user.
     */
    public function doctor(): static
    {
        return $this->withRole('doctor-role');
    }

    /**
     * Create a nurse user.
     */
    public function nurse(): static
    {
        return $this->withRole('nurse-role');
    }

    /**
     * Create a lab technician user.
     */
    public function labTechnician(): static
    {
        return $this->withRole('lab-role');
    }

    /**
     * Create a pharmacy user.
     */
    public function pharmacist(): static
    {
        return $this->withRole('pharmacy-role');
    }

    /**
     * Create a receptionist user.
     */
    public function receptionist(): static
    {
        return $this->withRole('reception-role');
    }

    /**
     * Create a finance officer user.
     */
    public function financeOfficer(): static
    {
        return $this->withRole('finance-role');
    }

    /**
     * Create an inventory manager user.
     */
    public function inventoryManager(): static
    {
        return $this->withRole('inventory-role');
    }

    /**
     * Create an HR officer user.
     */
    public function hrOfficer(): static
    {
        return $this->withRole('hr-officer');
    }
}
