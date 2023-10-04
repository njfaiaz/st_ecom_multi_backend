<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Shop;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $shops = Shop::pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();
        $subcategories = Subcategory::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();
        $prices = [500, 600, 700, 800, 900, 1000, 1100, 1200, 1300];
        $sale_price = [100, 200, 300, 400];
        $faker = Faker::create();

        for ($i = 1; $i <= 59; $i++) {

            $product_name = $faker->name;

            $product = Product::create([
                'shop_id' => $shops[array_rand($shops)],
                'category_id' => $categories[array_rand($categories)],
                'subcategory_id' => $subcategories[array_rand($subcategories)],
                'brand_id' => $brands[array_rand($brands)],
                'name' => fake()->name(),
                'slug' => $this->makeSlug($product_name),
                'description_short' => $faker->text(50),
                'description_long' => $faker->text(200),
                'regular_price'=> $prices[array_rand($prices)],
                'sale_price'=> $sale_price[array_rand($sale_price)],
                'stock_in' => 100,
                'stock_out' => rand(0, 99),
                'sale_total' => rand(0, 99),
                'is_active' => true,
                'rating' => rand(1, 5),
                'image' => 'products/' . rand(1, 59) . '.png'
            ]);

            $this->saveAttributes($product);
            $this->saveImages($product);
        }
    }

    private function saveImages($product)
    {
        for ($i = 1; $i < 30; $i++) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => 'products/' . rand(1, 50) . '.png'
            ]);
        }
    }

    private function saveAttributes($product)
    {
        $attributes = [
            ['name' => 'size', 'value' => 'small', 'additional_price' => 0],
            ['name' => 'size', 'value' => 'medium', 'additional_price' => 0],
            ['name' => 'size', 'value' => 'large', 'additional_price' => 0],
            ['name' => 'size', 'value' => 'xxl', 'additional_price' => 100],

            ['name' => 'color', 'value' => 'blue', 'additional_price' => 0],
            ['name' => 'color', 'value' => 'black', 'additional_price' => 100],
            ['name' => 'color', 'value' => 'white', 'additional_price' => 0],
            ['name' => 'color', 'value' => 'red', 'additional_price' => 100],
        ];

        foreach($attributes as $attribute) {
            $product->variants()->create([
                'name' => $attribute['name'],
                'value' => $attribute['value'],
                'additional_price' => $attribute['additional_price'],
            ]);
        }
    }

    private function makeSlug($string)
    {
        return strtolower(str_replace(' ', '_', $string));
    }
}
