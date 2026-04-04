<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User untuk kamu (Super Admin)
        User::create([
            'username' => 'haby',
            'password' => Hash::make('123456'),
            'role' => 'super admin',
        ]);

        // User untuk staff (Admin)
        User::create([
            'username' => 'habi',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);
    }
}