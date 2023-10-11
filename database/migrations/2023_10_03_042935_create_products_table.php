<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Shop;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Shop::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Subcategory::class)->nullable();
            $table->foreignIdFor(Brand::class)->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('description_short')->nullable();
            $table->text('description_long')->nullable();
            $table->string('image');
            $table->integer('regular_price');
            $table->integer('sale_price');
            $table->integer('stock_in');
            $table->integer('stock_out')->default(0);
            $table->integer('sale_total')->default(0);
            $table->integer('rating')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('products');
    }
};
