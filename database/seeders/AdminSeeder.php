<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'Admin',
            'password' => bcrypt('citimed@gmail.com'),
            'email' => bcrypt('citimed@gmail.com'),
        ]);

        $user->assignRole('super-admin-role');



    }
}
