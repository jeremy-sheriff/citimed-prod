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
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => bcrypt('admin@gmail.com'),
        ]);

        $user->assignRole('super-admin-role');



    }
}
