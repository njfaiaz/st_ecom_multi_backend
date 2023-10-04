<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    private function makeSlug($string)
    {
        return strtolower(str_replace(' ', '_', $string));
    }

    public function run()
    {
        $brands = ['Nike', 'Sony', 'Apple', 'Easy', 'Anjan’s', 'Dorjibari', 'Yellow', 'Richman', 'Apex', 'Sailor' ,'Freeland', 'Grameencheck', 'RFL', 'Walton', 'Ecstasy'];
        $brandPath = 'images/brands/';

        foreach($brands as $brandName) {
            Brand::create([
                'name' => $brandName,
                'slug' => $this->makeSlug($brandName),
                'image' => $brandPath . strtolower($brandName) . '.png'
            ]);
        }
    }
}
