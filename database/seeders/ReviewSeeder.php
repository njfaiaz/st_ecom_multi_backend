<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReviewImage;
use App\Models\Product;
use App\Models\Review;
use App\Models\Order;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i < 25; $i++) {

            $order = Order::inRandomOrder()->first();
            $product = Product::inRandomOrder()->first();

            $review = Review::create([
                'user_id' => $order->user->id,
                'order_id' => $order->id,
                'product_id' => $product->id,
                'rating' => $product->rating,
                'comment' => 'Lorem ipsum dolor!',
            ]);

            $this->reviewImage($review );
        }
    }

    private function reviewImage($review)
    {
        for ($i = 1; $i < 25; $i++) {
            ReviewImage::create([
                'review_id' => $review->id,
                'image' => 'reviews/' . rand(1, 6) . '.png'
            ]);
        }
    }
}
