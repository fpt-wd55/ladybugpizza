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
        $banners = [
            [
                'image' => 'banner_1.jpeg',
                'url' => 'profile/promotion?tab=redeem-code',
                'is_local_page' => 1,
            ],
            [
                'image' => 'banner_2.jpeg',
                'url' => 'menu#pizza',
                'is_local_page' => 1,
            ],
            [
                'image' => 'banner_3.jpeg',
                'url' => 'menu#pizza',
                'is_local_page' => 1,
            ],
            [
                'image' => 'banner_4.jpeg',
                'url' => 'menu#pizza',
                'is_local_page' => 1,
            ],

        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
