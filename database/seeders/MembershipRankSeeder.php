<?php

namespace Database\Seeders;

use App\Models\MembershipRank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipRankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MembershipRank::insert([
            [
                'icon' => 'bronze.svg',
                'name' => 'Đồng',
                'min_points' => 0,
                'max_points' => 1000,
            ],
            [
                'icon' => 'silver.svg',
                'name' => 'Bạc',
                'min_points' => 1001,
                'max_points' => 3000,
            ],
            [
                'icon' => 'gold.svg',
                'name' => 'Vàng',
                'min_points' => 3001,
                'max_points' => 10000,
            ],
            [
                'icon' => 'diamond.svg',
                'name' => 'Kim Cương',
                'min_points' => 10001,
                'max_points' => null,
            ],
        ]);
    }
}
