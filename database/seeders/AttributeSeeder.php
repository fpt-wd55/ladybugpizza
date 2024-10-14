<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $categories = Category::all();
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
            $attribute = Attribute::create([
                'name' => $name,
                'status' => 1,
                'category_id' => $categories->random()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($values as $value) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'value' => $value,
                    'quantity' => rand(0, 100),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
