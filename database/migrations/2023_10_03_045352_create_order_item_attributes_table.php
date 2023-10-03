<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProductAttribute;
use App\Models\OrderItem;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OrderItem::class);
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(ProductAttribute::class);
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
        Schema::dropIfExists('order_item_attributes');
    }
};
