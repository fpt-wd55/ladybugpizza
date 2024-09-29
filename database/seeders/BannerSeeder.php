<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Banner;
use Carbon\Carbon;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $faker = Faker::create();
        
        for ($i = 0; $i < 10; $i++) {
            // Tạo các thuộc tính cho Banner
            $bannerData = [
                'title' => $faker->sentence,
                'description' => $faker->sentence,
                'image' => 'banner-' . rand(1, 10) . '.jpg',
                'button_text' => $faker->word,
                'button_link' => $faker->url,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            // Sử dụng Eloquent Model để tạo Banner
            Banner::create($bannerData);
        }
    }
}
