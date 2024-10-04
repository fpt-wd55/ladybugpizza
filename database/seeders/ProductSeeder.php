<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\Product;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

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
                'Pizza Chay',
                'Pizza Carbonara',
                'Pizza Raffaello',
                'Pizza Pesto Burrata',
                'Pizza Margherita',
                'Pizza Burrata Cay',
                'Pizza Phô Mai Nóng',
                'Pizza Cà Tím',
                'Pizza Calzone',
                'Pizza Bốn Loại Phô Mai',
                'Pizza Nấm Truffle',
                'Pizza Emilio',
                'Pizza Thịt Xông Khói',
                'Pizza Alice',
                'Pizza Capricciosa',
                'Pizza Arugula Parma',
                'Pizza Napoletana',
                'Pizza Margherita DOP',
                'Pizza Pháp',
                'Pizza Nấm Truffle Hảo Hạng',
                'Pizza Marinara',
                'Pizza Năm Loại Phô Mai',
                'Pizza Sicilian',
                'Pizza Mật Ong Nóng',
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
        $categories = Category::all();

        foreach ($categories as $category) {
            $products = $dataProduct[$category->slug] ?? [];
            foreach ($products as $product) {
                $slug = Str::slug($product);
                $price = rand(100000, 500000);
                
                // Create Product
                $createdProduct = Product::create([
                    'name' => $product,
                    'slug' => $slug,
                    'image' => $slug . '.jpg',
                    'description' => 'Description of ' . $product,
                    'category_id' => $category->id,
                    'price' => $price,
                    'discount_price' => $price - rand(50000, 10000),
                    'quantity' => rand(10, 100),
                    'sku' => Str::random(10),
                    'status' => 1,
                    'is_featured' => rand(0, 1),
                    'avg_rating' => rand(0, 5),
                    'total_rating' => rand(0, 100),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // Get Attribute Values
                $attributeValues = AttributeValue::all();

                foreach ($attributeValues as $attributeValue) {
                    $price = rand(10000, 50000);
                    ProductAttribute::create([
                        'product_id' => $createdProduct->id,
                        'attribute_value_id' => $attributeValue->id,
                        'price' => $price,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
