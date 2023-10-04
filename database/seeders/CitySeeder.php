<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    private function makeSlug($string)
    {
        return strtolower(str_replace(' ', '_', $string));
    }

    public function run()
    {
        $cities = ['Dhaka', 'Faridpur', 'Gazipur', 'Gopalganj', 'Jamalpur', 'Kishoreganj', 'Madaripur','Manikganj','Munshiganj', 'Mymensingh', 'Narayanganj', 'Narsingdi', 'Netrokona', 'Rajbari', 'Shariatpur','Sherpur', 'Tangail', 'Bogra', 'Joypurhat', 'Naogaon', 'Natore', 'Nawabganj', 'Pabna','Rajshahi','Sirajgonj', 'Dinajpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat', 'Nilphamari', 'Panchagarh','Rangpur', 'Thakurgaon', 'Barguna', 'Barisal', 'Bhola', 'Jhalokati', 'Patuakhali', 'Pirojpur','Bandarban','Brahmanbaria', 'Chandpur', 'Chittagong', 'Comilla', 'Cox`s Bazar', 'Feni', 'Khagrachari','Lakshmipur', 'Noakhali', 'Rangamati', 'Habiganj', 'Maulvibazar', 'Sunamganj', 'Sylhet', 'Bagerhat','Chuadanga','Jessore', 'Jhenaidah', 'Khulna', 'Kushtia', 'Magura', 'Meherpur', 'Narail','Satkhira'];

        foreach($cities as $cityName) {

            City::create([
                'name' => $cityName,
                'slug' => $this->makeSlug($cityName),
            ]);
        }
    }
}
