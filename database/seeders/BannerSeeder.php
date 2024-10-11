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

        for ($i = 1; $i <= 10; $i++) {
            Banner::create([
                'image' => 'banner_' . $i . '.jpg',
                'url' => 'https://www.google.com',
                'is_local_page' => rand(1, 2),
                'status' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
