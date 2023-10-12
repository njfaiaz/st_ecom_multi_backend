<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    private function makeSlug($string)
    {
        return strtolower(str_replace(' ', '_', $string));
    }

    public function run()
    {
        $categoryPath = 'images/categories/';
        $categories = ['Men', 'Women', 'Kids', 'Clothing', 'Electronic', 'Furniture', 'Phone', 'Glossary', 'Sport'];
        $subcategories = ['Pant', 'Shirt', 'Watch', 'Bag', 'Shoes', 'Samsung', 'Sony', 'Apple', 'Xiaomi'];

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
