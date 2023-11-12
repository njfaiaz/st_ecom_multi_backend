<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CitySeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            PaymentOptionSeeder::class,
            ShopSeeder::class,
            ProductSeeder::class,
            WishlistSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
