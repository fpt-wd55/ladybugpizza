<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Pizza
        $attibutes = [
            'Loại đế' => [
                'Dày',
                'Mỏng',
            ],
            'Kích thước' => [
                'S: 7 inch (18cm) - 4 miếng - 1 người',
                'M: 9 inch (24cm) - 6 miếng - 2 người',
                'L: 12 inch (30cm) - 8 miếng - 2-3 người',
                'XL: 15 inch (38cm) - 8 miếng - 3-4 người',
            ],
            'Sốt' => [
                'Kem béo Alfredo',
                'Kem Carbonara',
                'Cà chua Marinara',
                'Nấm',
                'Húng quế Pesto',
            ]
        ];

        foreach ($attibutes as $name => $values) {
            $attribute = DB::table('attributes')->insertGetId([
                'name' => $name,
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);

            foreach ($values as $value) {
                DB::table('attribute_values')->insert([
                    'attribute_id' => $attribute,
                    'value' => $value,
                    'quantity' => $faker->numberBetween(0, 100),
                    'created_at' => $faker->dateTimeThisYear(),
                    'updated_at' => $faker->dateTimeThisYear(),
                ]);
            }
        }
    }
}
