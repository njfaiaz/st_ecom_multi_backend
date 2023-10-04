<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PaymentOption;
use Illuminate\Database\Seeder;

class PaymentOptionSeeder extends Seeder
{
    public function run()
    {
        $paymentOptions = ['Bkash', 'Nagad', 'Rocket'];
        $paymentPath = 'images/payments/';

        foreach($paymentOptions as $option) {
            PaymentOption::create([
                'name' => $option,
                'acc_number' => 4242424242424242,
                'description' => 'This is a Merchant '. $option . ' account. Go to the App and select Payment option for this',
                'image' => $paymentPath . strtolower($option) . '.png'
            ]);
        }
    }
}
