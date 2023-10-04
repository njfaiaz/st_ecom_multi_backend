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
        $imagePath = 'images/shop/';
        $sellers = User::where('role', UserRole::SELLER->value)->get();

        foreach($sellers as $seller) {
            Shop::create([
                'city_id' => $cities[array_rand($cities)],
                'user_id' => $seller->id,
                'phone' => $seller->phone,
                'address' => fake()->address(),
                'delivery_fee_inside' =>50,
                'delivery_fee_outside' => 100,
                'is_active' => true,
                'image' => $imagePath.$seller->username.'.png',
                'cover_image' => $imagePath.$seller->username.'_cover.png',
            ]);
        }
    }
}
