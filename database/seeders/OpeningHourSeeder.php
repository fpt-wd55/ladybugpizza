<?php

namespace Database\Seeders;

use App\Models\OpeningHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpeningHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $openingHours = [
            ['day_of_week' => 'monday', 'name' => 'Thứ Hai', 'open_time' => '10:00:00', 'close_time' => '20:00:00', 'is_open' => true],
            ['day_of_week' => 'tuesday', 'name' => 'Thứ Ba', 'open_time' => '10:00:00', 'close_time' => '20:00:00', 'is_open' => true],
            ['day_of_week' => 'wednesday', 'name' => 'Thứ Tư', 'open_time' => '10:00:00', 'close_time' => '20:00:00', 'is_open' => true],
            ['day_of_week' => 'thursday', 'name' => 'Thứ Năm', 'open_time' => '10:00:00', 'close_time' => '20:00:00', 'is_open' => true],
            ['day_of_week' => 'friday', 'name' => 'Thứ Sáu', 'open_time' => '12:00:00', 'close_time' => '23:00:00', 'is_open' => true],
            ['day_of_week' => 'saturday', 'name' => 'Thứ Bảy', 'open_time' => '11:00:00', 'close_time' => '21:00:00', 'is_open' => true],
            ['day_of_week' => 'sunday', 'name' => 'Chủ Nhật', 'open_time' => '11:00:00', 'close_time' => '22:00:00', 'is_open' => true],
        ];

        foreach ($openingHours as $hour) {
            OpeningHour::create($hour);
        }
    }
}
