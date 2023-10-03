<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    private function makeSlug($string)
    {
        return strtolower(str_replace(' ', '_', $string));
    }

    public function run()
    {
        $brands = ['Samsung', 'Sony', 'Apple', 'Easy', 'Artisan', 'Olloy'];
        $brandPath = 'images/categories/';
        foreach($brands as $brandName) {

            $category = Brand::create([
                'name' => $brandName,
                'slug' => $this->makeSlug($brandName),
                'image' => $brandPath . strtolower($brandName) . '.png'
            ]);
        }
    }
}
