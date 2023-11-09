<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OrderItemAttribute;
use Illuminate\Database\Seeder;
use App\Models\PaymentOption;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserAddress;

class OrderSeeder extends Seeder
{
    private $prices = [500, 600, 700, 800, 900, 1000, 1100, 1200, 1300];
    private $discounts = [50, 100, 200];
    private $delivery_fee = [50, 100];
    public function run()
    {
        $shops = Shop::pluck('id')->toArray();
        $paymentOptions = PaymentOption::pluck('id')->toArray();

        $users = User::customer()->with('addresses')->get();

        foreach($users as $user) {

            for ($i = 1; $i <= 50; $i++) {


                $totalPrice = $this->prices[array_rand($this->prices)];
                $discount = $this->discounts[array_rand($this->discounts)];
                $delivery = $this->delivery_fee[array_rand($this->delivery_fee)];
                $payable = ($totalPrice - $discount) + $delivery;

                $order = Order::create([
                    'invoice_no' => 'Inv' . rand(1000, 9999),
                    'shop_id' => $shops[array_rand($shops)],
                    'user_address_id' => $user->addresses->first()->id,
                    'user_id' => $user->id,
                    'payment_option_id' => $paymentOptions[array_rand($paymentOptions)],
                    'payment_type' =>rand(0, 1),
                    'total_price'=> $totalPrice,
                    'discount'=> $discount,
                    'payable'=> $payable,
                    'delivery_fee' => $delivery,
                    'paid' => $payable,
                    'due' => 0,
                    'status' =>rand(1, 8),
                ]);

                $this->saveItems($order);
                $this->orderDetails($order);
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

    private function orderDetails($order)
    {
        $first_name = ['Junayed', 'Atik', 'Sayed', 'Sajal', 'Turjo'];
        $last_name = ['Faiaz', 'Rahman', 'Islam', 'Bhuiya', 'Shekh'];
        $phone = [012222222222, 0222222222, 222222330000, 525555665555];

        $address = UserAddress::pluck('id')->toArray();

        OrderDetails::create([
            'order_id' => $order->id,
            'user_address_id' => $address[array_rand($address)],
            'first_name'=> $first_name[array_rand($first_name)],
            'last_name'=> $last_name[array_rand($last_name)],
            'phone'=> $phone[array_rand($phone)],
        ]);

    }

}
