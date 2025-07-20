<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define roles and their permissions

        $roles = [
            'super-admin' => [
                'manage users',
                'manage roles',
                'manage permissions',
                'view system logs',
                'manage settings',
            ],
            'doctor' => [
                'view assigned patients',
                'update diagnoses',
                'prescribe medication',
                'order lab tests',
                'view lab results',
                'schedule appointments',
            ],
            'nurse' => [
                'view assigned patients',
                'update vitals',
                'assist in procedures',
                'administer medication',
                'view lab results',
            ],
            'lab-technician' => [
                'view lab orders',
                'update test results',
                'print reports',
                'view patient basic info',
            ],
            'pharmacist' => [
                'view prescriptions',
                'update dispensation records',
                'manage medicine inventory',
                'generate stock reports',
            ],
            'receptionist' => [
                'create patient profiles',
                'schedule appointments',
                'check-in patients',
                'view doctors availability',
            ],
            'billing-officer' => [
                'view invoices',
                'update payments',
                'process insurance claims',
                'generate finance reports',
            ],
            'inventory-manager' => [
                'view stock levels',
                'reorder supplies',
                'manage suppliers',
                'log deliveries',
            ],
            'hr-officer' => [
                'manage employee profiles',
                'assign shifts',
                'process payroll',
                'generate attendance reports',
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $permissions) {
            $role = Role::query()->firstOrCreate(['name' => $roleName]);

            foreach ($permissions as $permName) {
                $permission = Permission::query()->firstOrCreate(['name' => $permName]);
                $role->givePermissionTo($permission);
            }
        }

        // Optionally assign a super-admin role to the first user
        $user = User::query()->find(1);
        if ($user) {
            $user->assignRole('super-admin');
        }
    }
}
