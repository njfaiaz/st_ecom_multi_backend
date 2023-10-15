<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Shop;
use App\Models\User;
use App\Enums\OrderStatus;
use App\Models\UserAddress;
use App\Models\PaymentOption;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->foreignIdFor(Shop::class);
            $table->foreignIdFor(UserAddress::class);
            $table->foreignIdFor(User::class);
            $table->integer('payment_type'); //online or COD
            $table->foreignIdFor(PaymentOption::class)->nullable();
            $table->integer('total_price');
            $table->integer('discount');
            $table->integer('delivery_fee')->default(0);
            $table->integer('payable');
            $table->integer('paid')->default(0);
            $table->integer('due')->default(0);
            $table->integer('status')->default(OrderStatus::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
