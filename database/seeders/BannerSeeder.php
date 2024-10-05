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
        Banner::create([
            'image' => 'banner1.jpg',
            'url' => 'menu',
            'is_local_page' => 1,
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
