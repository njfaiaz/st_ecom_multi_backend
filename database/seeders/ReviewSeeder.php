<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReviewImage;
use App\Models\Review;
use App\Models\Order;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            'So nice!',
            'Best product so far!',
            'Delivery was late.',
            'Bad experience',
            'Thanks for sending me the best one!',
            'Appreciate it',
            'I am going to order again soon'
        ];

        $orders = Order::with('items')->get();

        foreach($orders as $order) {
            foreach($order->items as $item) {
                $review = Review::create([
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'rating' => rand(1,5),
                    'comment' => $comments[array_rand($comments)],
                ]);

                $this->reviewImage($review);
            }
        }
    }

    private function reviewImage($review)
    {
        for ($i = 1; $i < 3; $i++) {
            ReviewImage::create([
                'review_id' => $review->id,
                'image' => 'images/reviews/' . rand(38, 60) . '.png'
            ]);
        }
    }
}
