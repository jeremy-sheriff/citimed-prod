<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define roles and their permissions

        $roles = [
            'super-admin-role' => [
                'manage users',
                'manage roles',
                'manage permissions',
                'view system logs',
                'manage settings',
            ],
            'doctor-role' => [
                'view assigned patients',
                'update diagnoses',
                'prescribe medication',
                'order lab tests',
                'view lab results',
                'schedule appointments',
            ],
            'nurse-role' => [
                'view assigned patients',
                'update vitals',
                'assist in procedures',
                'administer medication',
                'view lab results',
            ],
            'lab-role' => [
                'view lab orders',
                'update test results',
                'print reports',
                'view patient basic info',
            ],
            'pharmacy-role' => [
                'view prescriptions',
                'update dispensation records',
                'manage medicine inventory',
                'generate stock reports',
            ],
            'reception-role' => [
                'create patient profiles',
                'schedule appointments',
                'check-in patients',
                'view doctors availability',
            ],
            'finance-role' => [
                'view invoices',
                'update payments',
                'process insurance claims',
                'generate finance reports',
            ],
            'inventory-role' => [
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

        // Temporarily disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the tables
        Role::query()->truncate();
        Permission::query()->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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
            $user->assignRole('super-admin-role');
        }
    }
}
