<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'asemmohsen911@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('asemmohsen911@gmail.com'),
            ]
        );
    }
}

