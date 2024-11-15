<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash; // Import Hash for password encryption
use Illuminate\Database\Seeder;

class GuestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fname' => 'Guest',
            'lname' => 'Account',
            'name' => 'Twalitso - Square Guest User',
            'email' => 'guest@twalitso.com',
            'password' => Hash::make('guest246'), // Make sure to hash the password
            'bio' => 'Square guest account',
            'work' => 'Guest',
            'location' => 'World, wide',
            'website' => 'https://square.twalitso.com/',
            'gender' => 'Other',
            'otp' => null,
            'is_verified_otp' => true, // Assuming admin has verified their OTP
            'google_id' => null,
            'google_pic' => null,
            'phone' => '100000001',
            'current_team_id' => 1, // Assuming team ID is 1
            'role' => 'user', // Assuming team ID is 1
        ]);
    }
}
