<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) { 
            $title = $faker->sentence;
            $description = $faker->sentence;
            $image = 'banner-' . $faker->numberBetween(1, 10) . '.jpg';
            $button_text = $faker->word;
            $button_link = $faker->url;
            $status = 1;
            $created_at = now();
            $updated_at = now();

            DB::table('banners')->insert([
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'button_text' => $button_text,
                'button_link' => $button_link,
                'status' => $status,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
} 