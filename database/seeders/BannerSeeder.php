<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use App\Models\Banner; 

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        for ($i = 1; $i <= 4; $i++) {
            Banner::create([
                'image' => 'banner_' . $i . '.jpeg',
                'url' => null
            ]);
        }
    }
}
