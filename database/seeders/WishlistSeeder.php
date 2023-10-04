<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    public function run()
    {
        $product = Product::pluck('id')->toArray();
        $user = User::pluck('id')->toArray();

        for ($i = 1; $i < 10; $i++) {

            Wishlist::create([
                'product_id' => $product[array_rand($product)],
                'user_id' => $user[array_rand($user)],
            ]);
        }
    }
}
