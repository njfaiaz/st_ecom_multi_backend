<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserRole;
use App\Models\City;
use App\Models\Shop;
use App\Models\User;

class ShopSeeder extends Seeder
{
    public function run()
    {
        $cities = City::pluck('id')->toArray();
        $username = ['Nike', 'Sony', 'Apple', 'Easy', 'Anjan’s', 'Dorjibari', 'Yellow', 'Richman', 'Apex', 'Sailor' ,'Freeland', 'Grameencheck', 'RFL', 'Walton', 'Ecstasy'];
        $imagePath = 'images/shops/';
        $sellers = User::where('role', UserRole::SELLER->value)->get();

        foreach($sellers as $seller) {
            Shop::create([
                'city_id' => $cities[array_rand($cities)],
                'user_id' => $seller->id,
                'phone' => $seller->phone,
                'address' => fake()->address(),
                'username' => $username[array_rand($username)]. ' '.'Bangladesh',
                'delivery_fee_inside' =>50,
                'delivery_fee_outside' => 100,
                'rating' => rand(1, 5),
                'is_active' => true,
                'image' => $imagePath.$seller->username.'.png',
                'cover_image' => $imagePath.$seller->username.'_cover.png',
            ]);
        }
    }
}
