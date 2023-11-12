<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'inside_dhaka' => 50,
            'outside_dhaka' => 100,
            'logo' => 'images/default.png',
            'app_title' => 'E-commerce'
        ]);
    }
}
