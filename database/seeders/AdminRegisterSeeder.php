<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AdminRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Admin',
            'first_name' => 'Junayed Rahman',
            'last_name' => 'Faiaz',
            'phone' => '01533434652',
            'email' => 'faiaz5678@gmail.com',
            'email_verified_at' => now(),
            'role' => 1,
            'password' => Hash::make('12345678'),
        ]);
    }
}
