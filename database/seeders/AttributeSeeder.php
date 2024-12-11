<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $attibutes = [
            'Loại đế' => [
                'Đế mỏng',
                'Đế dày',  
                'Viền phô mai',
                'Viền phô mai xúc xích',
            ],
            'Kích thước' => [
                'Size S',
                'Size M',
                'Size L',
            ],
            'Sốt' => [
                'Sốt truyền thống',
                'Sốt kem béo Alfredo',
                'Sốt kem Carbonara',
                'Sốt cà chua Marinara',
                'Sốt nấm',
                'Sốt húng quế Pesto',
                'Không sốt',
            ]
        ];

        foreach ($attibutes as $name => $values) {
            $attribute = Attribute::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 1, 
                'category_id' => $name == 'Sốt' ? 6 : 1,  
            ]);


            foreach ($values as $value) {
                $name == 'Kích thước' ? $price_type = 2 : $price_type = 1;

                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'value' => $value,
                    'daily_quantity' => rand(0, 100),
                    'quantity' => rand(0, 100),
                    'price' => ($price_type == 1) ? rand(5, 10) * 1000 : rand(5, 10),
                    'price_type' => $price_type, 
                ]);
            }
        }
    }
}
