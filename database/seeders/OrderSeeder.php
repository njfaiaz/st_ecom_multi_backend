<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OrderItemAttribute;
use Illuminate\Database\Seeder;
use App\Models\PaymentOption;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;

class OrderSeeder extends Seeder
{
    private $prices = [500, 600, 700, 800, 900, 1000, 1100, 1200, 1300];
    private $discounts = [50, 100, 200];

    public function run()
    {
        $shops = Shop::pluck('id')->toArray();
        $paymentOptions = PaymentOption::pluck('id')->toArray();

        $users = User::customer()->with('addresses')->get();

        foreach($users as $user) {

            for ($i = 1; $i <= 2000; $i++) {

                $totalPrice = $this->prices[array_rand($this->prices)];
                $discount = $this->discounts[array_rand($this->discounts)];
                $payable = $totalPrice - $discount;

                $order = Order::create([
                    'order_id' => 'Inv' . rand(1000, 9999),
                    'shop_id' => $shops[array_rand($shops)],
                    'user_address_id' => $user->addresses->first()->id,
                    'user_id' => $user->id,
                    'payment_option_id' => $paymentOptions[array_rand($paymentOptions)],
                    'payment_type' =>rand(0, 1),
                    'total_price'=> $totalPrice,
                    'discount'=> $discount,
                    'payable'=> $payable,
                    'paid' => $payable,
                    'due' => 0,
                    'status' =>rand(0, 8),
                ]);

                $this->saveItems($order);
            }
        }
    }

    private function saveItems($order)
    {
        for ($i = 1; $i < 3; $i++) {

            $product = Product::inRandomOrder()->first();
            $quantity = rand(1,5);

            $item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'regular_price'=> $product->regular_price,
                'sale_price'=> $product->sale_price,
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->sale_price,
            ]);

            $this->saveAttributes($item);
        }
    }

    private function saveAttributes($orderItem)
    {
        $attribute = $orderItem->product->variants()->first();

        OrderItemAttribute::create([
            'order_item_id' => $orderItem->id,
            'product_id' => $orderItem->product_id,
            'product_attribute_id' => $attribute->id,
            'name' => $attribute->name,
            'value' => $attribute->value,
            'additional_price' => $attribute->additional_price
        ]);
    }
}
