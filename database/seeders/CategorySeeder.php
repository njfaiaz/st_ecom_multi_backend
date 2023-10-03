<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private function makeSlug($string)
    {
        return strtolower(str_replace(' ', '_', $string));
    }

    public function run()
    {
        $categoryPath = 'images/categories/';
        $categories = ['Men', 'Women', 'Kids', 'Clothing', 'Electronic', 'Furniture', 'Phone'];
        $subcategories = ['Pant', 'Shirt', 'Watch', 'Bag', 'saree', 'Shoes', 'Samsung', 'Sony', 'Apple', 'Xiaomi'];

        foreach($categories as $categoryName) {

            $category = Category::create([
                'name' => $categoryName,
                'slug' => $this->makeSlug($categoryName),
                'image' => $categoryPath . strtolower($categoryName) . '.png'
            ]);

            foreach ($subcategories as $subcategoryName) {

                $category->subcategories()->create([
                    'name' => $subcategoryName,
                    'slug' => $this->makeSlug($subcategoryName),
                    'image' => $categoryPath . strtolower($subcategoryName) . '.png'
                ]);
            }
        }
    }
}
