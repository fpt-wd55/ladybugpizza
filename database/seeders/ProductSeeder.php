<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $dataProduct = [
            'banh-ngot' => [
                'Blueberry cheesecake',
                'Tiramisu',
                'Croissant pur beurre',
                'Pain au Chocolat',
                'Pain Suisse',
                'Almond Croissant',
                'Pizza Nutella',
                'Chocolate Tar',
            ],
            'salad' => [
                'Bufala Caprese Salad',
                'Goat cheese Salad',
                'Beetroot Salad',
                'Burrata Salad',
                'Garlic bread platter',
            ],
            'pizza' => [
                'Pizza Pesto Napoli',
                'Pizza Vegetariana',
                'Pizza Carbonara',
                'Pizza Raffaello',
                'Pizza Pesto Burrata',
                'Pizza Margherita',
                'Pizza Spicy Burrata',
                'Pizza Chèvre Chaud',
                'Pizza Eggplant',
                'Pizza Calzone',
                'Pizza 4 Formaggi',
                'Pizza Tartufo',
                'Pizza Emilio',
                'Pizza Pancetta',
                'Pizza Alice',
                'Pizza Capricciosa',
                'Pizza Rucola Parma',
                'Pizza Napoletana',
                'Pizza Margherita DOP',
                'Pizza Française',
                'Pizza Tartufissimo',
                'Pizza Marinara',
                'Pizza 5 Formaggi',
                'Pizza Sicilian',
                'Pizza Hot Honey',
            ],
            'my' => [
                'Mỳ Ý Pesto',
                'Mỳ Ý Cay Hải Sản',
                'Mỳ Ý Bò Bằm',
                'Mỳ Ý Gà Cay',
                'Mỳ Ý Tôm Sốt Kem',
                'Mỳ Ý Dăm Bông',
            ],
            'nuoc-ngot' => [
                'Coca Classic',
                'Coca Zero',
                'Coca Light',
                'Pepsi',
                'Fanta',
                'Soda Schweppes',
                'Mountain Dew',
            ],
            'ga' => [
                'Cánh gà nướng',
                'Gà không xương sốt cay',
                'Gà không xương mắm tỏi',
                'Cánh gà sốt cay',
                'Gà phủ phô mai',
                'Đùi gà chiên giòn',
                'Gà nướng mật ong',
            ],
            'combo' => [
                'Combo 1',
                'Combo 2',
                'Combo 3',
                'Combo 4',
                'Combo 5',
                'Combo 6',
                'Combo 7',
                'Combo 8',
                'Combo 9',
                'Combo 10',
            ]
        ];

        // Create Product
        $categories = DB::table('categories')->get();

        foreach ($categories as $category) {
            $products = $dataProduct[$category->slug];
            foreach ($products as $product) {   
                $slug = Str::slug($product);
                $price = rand(100000, 500000);
                DB::table('products')->insert([
                    'name' => $product,
                    'slug' => $slug,
                    'image' => $slug . '.jpg',
                    'description' => 'Description of ' . $product,
                    'category_id' => $category->id,
                    'price' => $price,
                    'discount_price' => rand(0, 1) ? $price - rand(50000, 10000) : null,
                    'quantity' => rand(10, 100),
                    'sku' => Str::random(10),
                    'status' => 1,
                    'is_featured' => 2,
                    'avg_rating' => rand(0, 5),
                    'total_rating' => rand(0, 100),
                    'created_at' => $faker->dateTimeThisYear(),
                    'updated_at' => $faker->dateTimeThisYear(),
                ]);

                $product_id = DB::table('products')->where('slug', $slug)->first()->id;
                $attributeValues = DB::table('attribute_values')->get();
                
                foreach ($attributeValues as $attributeValue) {
                    $price = rand(10000, 50000);
                    DB::table('product_attributes')->insert([
                        'product_id' => $product_id,
                        'attribute_value_id' => $attributeValue->id,
                        'price' => $price,
                        'created_at' => $faker->dateTimeThisYear(),
                        'updated_at' => $faker->dateTimeThisYear(),
                    ]);
                }
            }
        }
    }
}
