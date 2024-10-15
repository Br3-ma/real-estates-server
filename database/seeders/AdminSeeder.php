<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash for password encryption
use App\Models\User; // Import your User or Admin model

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'fname' => 'Square',
            'lname' => 'Twalitso',
            'name' => 'Twalitso - Square',
            'email' => 'admin@twalitso.com',
            'password' => Hash::make('Square24!'), // Make sure to hash the password
            'bio' => 'Administrator of the platform',
            'work' => 'Administrator',
            'location' => 'Zambia, Lusaka',
            'website' => 'https://square.twalitso.com/',
            'gender' => 'Male',
            'otp' => null,
            'is_verified_otp' => true, // Assuming admin has verified their OTP
            'google_id' => null,
            'google_pic' => null,
            'phone' => '1234567890',
            'current_team_id' => 1, // Assuming team ID is 1
            'role' => 'admin', // Assuming team ID is 1
        ]);
    }
}
