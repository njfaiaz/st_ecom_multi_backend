<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use App\Enums\UserRole;
use App\Models\City;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'phone' => '01111111111',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'role' => UserRole::ADMIN->value,
            'password' => Hash::make('12345678'),
        ]);

        $customer = User::create([
            'username' => 'User',
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '02222222222',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'role' => UserRole::CUSTOMER->value,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $this->saveAddresses($customer);

        //User::factory(100)->create();


        $sellers = ['Samsung', 'Walton', 'Unilever', 'Pureit', 'Symphony', 'Pran', 'Nestle', 'Teer', 'Delphi', 'Happy Mart', 'Nokia', 'ACI', 'Vivo', 'e-Fashion', 'InFistyle', 'Proud', 'Apple'];

        foreach($sellers as $seller) {
            User::create([
                'username' => strtolower($seller),
                'first_name' => $seller,
                'last_name' => 'Vendor',
                'phone' => fake()->phoneNumber(),
                'email' => strtolower($seller).'@gmail.com',
                'email_verified_at' => now(),
                'role' => UserRole::SELLER->value,
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }
    }

    public function saveAddresses($user)
    {
        $addresses = ['Banasree', 'Mirpur', 'Khilgaon', 'Badda'];
        $cities = City::pluck('id')->toArray();

        foreach($addresses as $address) {
            UserAddress::create([
                'city_id' => $cities[array_rand($cities)],
                'user_id' => $user->id,
                'address' => $address,
                'phone' => $user->phone
            ]);
        }
    }
}
