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
            'cake' => [
                'Bánh Mỳ Bơ Tỏi',
                'Bánh Phô Mai Việt Quất',
                'Bánh Sừng Bò Bơ Nguyên Chất',
                'Bánh Sừng Bò Chocolate',
                'Bánh Sừng Bò Hạnh Nhân',
                'Pain Suisse Thuỵ Sĩ',
                'Tart Chocolate',
                'Tiramisu',
            ],
            'salad' => [
                'Salad Phô Mai Sữa Trâu',
                'Salad Phô Mai Sữa Dê',
                'Beetroot Salad',
                'Burrata Salad',
            ],
            'pizza' => [
                'Pizza Hải sản Pesto Xanh',
                'Pizza Chay',
                'Pizza Carbonara',
                'Pizza Raffaello',
                'Pizza Pesto Burrata',
                'Pizza Margherita',
                'Pizza Burrata Cay',
                'Pizza Cà Tím',
                'Pizza Gập Calzone',
                'Pizza 4 Cheese',
                'Pizza Nấm Truffle',
                'Pizza Emilio',
                'Pizza Thịt Ba Chỉ Xông Khói',
                'Pizza Xúc Xích Đức',
                'Pizza Capricciosa',
                'Pizza Dăm Bông Parma',
                'Pizza Napoli Loại 1',
                'Pizza Napoli Loại 2',
                'Pizza Margherita DOP',
                'Pizza Pháp',
                'Pizza Nấm Truffle Hảo Hạng',
                'Pizza Marinara',
                'Pizza 5 Cheese',
                'Pizza Sicilian',
                'Pizza Mật Ong Nóng',
            ],
            'pasta' => [
                'Pasta Bolognese',
                'Pasta Carbonara',
                'Pasta Xốt Pesto Genovese',
                'Pasta Xốt Pesto',
                'Pasta Nấm Hương Shiitake',
                'Pasta Tôm Cay',
            ],
            'soft' => [
                'Coca Classic Lon 320ml',
                'Coca Light Lon 330ml',
                'Coca Plus Fiber Lon 320ml',
                'Coca Zero Lon 320ml',
                'Fanta Hương Cam Lon 320ml',
                'Fanta Hương Nho Lon 320ml',
                'Fanta Hương Soda Kem Lon 320ml',
                'Fanta Hương Xá Xị Lon 320ml',
                'Fuzetea Trà Bí Đao Lon 320ml',
                'Pepsi Nitro Draft Coca Lon 320ml',
                'Pepsi Nitro Draft Vanilla Lon 320ml',
                'Schweppes Soda Lon 320ml',
                'Schweppes Tonic Lon 320ml',
            ],
            'chicken' => [
                'Cánh gà nướng',
                'Gà không xương sốt cay',
                'Gà không xương mắm tỏi',
                'Cánh gà sốt cay',
                'Gà phủ phô mai',
                'Đùi gà chiên giòn',
                'Gà nướng mật ong',
            ],
            'combo' => [
                'Combo 2 Pizza + Pepsi - Ăn thả ga - Giá siêu rẻ',
                'Combo Sương Sương',
                'Ăn Hết Menu Không Lo Mập Ú',
                'Dành Cho Người Ăn Kiêng',
                'Ăn Một Mình Nhưng Phải Đủ Món',
                'Pizza Slay',
                'Combo Siêu To Khổng Lồ',
                'Gia Đình Vui Vẻ - Cả Nhà Cùng Vui',
                'Cặp Đôi Yêu Thương - Ăn Là Phải Có Đôi',
                'Năng Lượng Ngập Tràn - Đầy Đủ Chất',
                'Ăn Vặt Cuối Tuần - Nhâm Nhi Cả Ngày',
                'Mua 1 Tặng 1 - Tiết Kiệm Nhân Đôi'
            ]
        ];

        // Create Product
        $categories = Category::all();

        foreach ($categories as $category) {
            $products = $dataProduct[$category->slug] ?? [];

            foreach ($products as $product) {
                $price = rand(100000, 500000);

                // Create Product
                $createdProduct = Product::create([
                    'name' => $product,
                    'slug' => Str::slug($product),
                    'image' => Str::slug($product) . '.jpeg',
                    'description' => "Description of $product",
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
