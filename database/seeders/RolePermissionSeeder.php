<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permission
        $permission = Permission::query()->firstOrCreate(['name' => 'view payments']);

        // Create Role
        $role = Role::query()->firstOrCreate(['name' => 'super-admin']);

        // Assign permission to a role
        $role->givePermissionTo($permission);


        $user = User::query()->find(1); // Replace it with your actual user ID
        $user->assignRole('super-admin');
    }
}
