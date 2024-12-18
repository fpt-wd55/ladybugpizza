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
        for ($i = 1; $i <= 8; $i++) {
            Banner::create([
                'image' => 'banner_' . $i . '.webp',
                'url' => null
            ]);
        }
    }
}
